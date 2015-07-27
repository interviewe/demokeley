<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Form\NoteType;
use Acme\DemoBundle\Model\Note;
use Acme\DemoBundle\Model\NoteCollection;

use FOS\RestBundle\Util\Codes;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\RouteRedirectView;

use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Rest controller for notes
 *
 * @package Acme\DemoBundle\Controller
 * @author Gordon Franke <info@nevalon.de>
 */
class NoteController extends FOSRestController
{
}
