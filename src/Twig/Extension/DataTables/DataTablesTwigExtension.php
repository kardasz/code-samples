<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Twig\Extension\DataTables;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class DataTablesTwigExtension
 * @package Kardasz\Twig\Extension\DataTables
 */
class DataTablesTwigExtension extends AbstractExtension
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * OrderLinkExtension constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('dt_order_link', [$this, 'order']),
            new TwigFunction('dt_order_icon', [$this, 'icon']),
            new TwigFunction('dt_column_title', [$this, 'title']),
        ];
    }

    /**
     * @param $field
     * @param Request|null $request
     * @param null $_route
     * @return string
     */
    public function title($title, $field, Request $request = null, $_route = null)
    {
        $url = $this->order($field, $request, $_route);
        $icon = $this->icon($field, $request);

        return sprintf('<a href="%s">%s%s</a>', $url, $title, $icon);
    }

    /**
     * @param $field
     * @param Request|null $request
     * @param null $_route
     * @return string
     */
    public function order($field, Request $request = null, $_route = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }
        $params = $request->query->all();
        foreach ($request->attributes->all() as $name => $value) {
            if (substr($name, 0, 1) !== '_') {
                if (is_object($value) && method_exists($value, 'getId')) {
                    $value = $value->getId();
                }
                $params[$name] = (string)$value;
            }
        }

        if (isset($params['_sort']) && $params['_sort'] == $field) {
            $params['_dir'] = (isset($params['_dir']) && $params['_dir'] == 'asc') ? 'desc' : 'asc';
        } else {
            $params['_sort'] = $field;
            $params['_dir'] = 'asc';
        }

        if (null == $_route) {
            $_route = $request->attributes->get('_route');
        }

        return $this->router->generate($_route, $params);
    }

    /**
     * @param $field
     * @param Request|null $request
     * @return string
     */
    public function icon($field, Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }
        $params = $request->query->all();
        if (isset($params['_sort']) && $params['_sort'] == $field) {
            $dir = (isset($params['_dir']) && $params['_dir'] == 'desc') ? 'desc' : 'asc';
            return sprintf(' <span class="fa fa-sort-alpha-%s" aria-hidden="true"></span>', $dir);
        }
    }
}
