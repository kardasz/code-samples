<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Controller;

use Broadway\CommandHandling\CommandBus;
use Kardasz\CQRS\Command\CreateReportCommand;
use Kardasz\Form\IndividualReportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndividualReportController
 * @package Kardasz\Controller
 */
class IndividualReportController extends Controller
{
    use ControllerTrait;

    /**
     * @Route("/api/individual-reports", name="api_individual_reports_create", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, CommandBus $commandBus)
    {
        $form = $this->createForm(IndividualReportType::class);
        $form->submit($this->getJson($request));

        if (!$form->isValid()) {
            return $this->createInvalidFormResponse($form);
        }

        $file = $form['file']->getData();
        $filename = sprintf('%s.%s', sha1_file($file->getPathname()), $file->getClientOriginalExtension());
        $file->move($this->getParameter('env(UPLOAD_PATH)'), $filename);
        $filepath = sprintf('%s/%s', $this->getParameter('env(UPLOAD_DIR)'), $filename);

        $commandBus->dispatch(new CreateReportCommand(
            $form->get('category')->getData(),
            $form->get('name')->getData(),
            $form->get('author')->getData(),
            $filepath,
            $form->get('date')->getData()
        ));

        return new JsonResponse(['message' => 'Report created'], Response::HTTP_CREATED);
    }
}
