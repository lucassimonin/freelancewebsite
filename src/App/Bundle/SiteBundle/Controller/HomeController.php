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
    protected $coreHelper;

    /**
     * Homepage action
     * @param $locationId
     * @param $viewType
     * @param bool $layout
     * @param array $params
     * @return mixed
     */
    public function indexAction($locationId, $viewType, $layout = false, array $params = array())
    {
        $this->coreHelper = $this->container->get('app.core_helper');
        $worksItemContentTypeIdentifier = $this->container->getParameter('app.work.content_type.identifier');
        $worksLocationId = $this->container->getParameter('app.works.locationid');

        $params['works'] = $this->coreHelper->getChildrenObject([$worksItemContentTypeIdentifier], $worksLocationId);
        $response = $this->get('ez_content')->viewLocation(
            $locationId,
            $viewType,
            $layout,
            $params
        );

        $response->headers->set('X-Location-Id', $locationId);
        $response->setEtag(md5(json_encode($params)));
        $response->setPublic();
        $response->setSharedMaxAge($this->container->getParameter('app.cache.high.ttl'));

        return $response;
    }
}
