<?php

namespace App\Bundle\SiteBundle\Controller;

use App\Bundle\SiteBundle\Helper\CoreHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Bundle\SiteBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    /** @var  CoreHelper */
    private $coreHelper;

    /**
     * Homepage action
     * @param View $view
     * @return View
     */
    public function indexAction(View $view)
    {
        $this->coreHelper = $this->container->get('app.core_helper');
        $worksItemContentTypeIdentifier = $this->container->getParameter('app.work.content_type.identifier');
        $worksLocationId = $this->container->getParameter('app.works.locationid');

        $params['works'] = $this->coreHelper->getChildrenObject([$worksItemContentTypeIdentifier], $worksLocationId);
        $response = new Response();
        $response->setPrivate();
        $response->setSharedMaxAge($this->container->getParameter('app.cache.high.ttl'));
        $response->setLastModified($view->getContent()->versionInfo->modificationDate);
        $view->setResponse($response);
        $view->addParameters([
            'params' => $params
        ]);

        return $view;
    }
}
