<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Controller;

use Kardasz\DTO\ApiProblem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Trait ControllerTrait
 * @package Kardasz\Controller
 */
trait ControllerTrait
{
    /**
     * @param FormInterface $form
     * @return array
     */
    protected function getFormErrors(FormInterface $form) : array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getFormErrors($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }

    /**
     * @param ConstraintViolationListInterface $violationList
     * @return array
     */
    protected function getViolationErrors(ConstraintViolationListInterface $violationList) : array
    {
        $errors = [];
        foreach ($violationList as $violation) {
            $errors[trim($violation->getPropertyPath(), '[]')][] = $violation->getMessage();
        }

        return $errors;
    }

    /**
     * @param FormInterface $form
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function createInvalidFormResponse(FormInterface $form, $status = 422, array $headers = []) : JsonResponse
    {
        return new JsonResponse(
            new ApiProblem([
                'title' => 'Validation error',
                'errors' => $this->getFormErrors($form),
                'status' => $status
            ]),
            $status,
            $headers
        );
    }

    /**
     * @param ConstraintViolationListInterface $violationList
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function createViolationResponse(ConstraintViolationListInterface $violationList, $status = 422, array $headers = []) : JsonResponse
    {
        return new JsonResponse(
            new ApiProblem([
                'title' => 'Validation error',
                'errors' => $this->getViolationErrors($violationList),
                'status' => $status
            ]),
            $status,
            $headers
        );
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function createApiProblemResponse(array $data, $status = 400, array $headers = []) : JsonResponse
    {
        return new JsonResponse(
            new ApiProblem($data),
            $status,
            $headers
        );
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws BadRequestHttpException
     */
    protected function getJson(Request $request)
    {
        $body = $request->getContent();
        if (empty($body)) {
            throw new BadRequestHttpException('Empty body');
        }

        $data = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new BadRequestHttpException(sprintf('Invalid JSON body: %s', json_last_error_msg()));
        }

        return $data;
    }
}
