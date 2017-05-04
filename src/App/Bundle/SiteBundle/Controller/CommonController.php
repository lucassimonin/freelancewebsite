<?php


namespace App\Bundle\SiteBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use eZ\Publish\Core\MVC\Symfony\Routing\RouteReference;
use Symfony\Component\HttpFoundation\Request;

/**
 * CommonController Class.
 *
 * @author simoninl
 */
class CommonController extends Controller
{
    /**
     * languagesAction
     *
     * @param Request        $request
     * @param RouteReference $routeRef
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function languagesAction(Request $request, RouteReference $routeRef )
    {
        // get cuurent eZ language
        $currentSFLanguage = $request->get( '_locale');
        $currentEzLanguage = array_search(
                $currentSFLanguage ,
                $this->container->getParameter( 'ezpublish.locale.conversion_map' )
                );

        return $this->render( '@AppSite/content/parts/languages.html.twig',
                array('currentLanguage' => $currentEzLanguage, 'routeRef' => $routeRef)
                );
    }

    /**
     * hrefLanguagesAction
     *
     * @param Request        $request
     * @param RouteReference $routeRef
     * @param integer        $locationId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function hrefLanguagesAction(Request $request, RouteReference $routeRef, $locationId )
    {
        // get cuurent eZ language
        $currentSFLanguage = $request->get( '_locale');
        $currentEzLanguage = array_search(
                $currentSFLanguage ,
                $this->container->getParameter( 'ezpublish.locale.conversion_map' )
                );

        return $this->render( '@AppSite/content/parts/hreflang.html.twig',
                array('currentLanguage' => $currentEzLanguage, 'routeRef' => $routeRef, 'locationId' => $locationId)
                );
    }
}