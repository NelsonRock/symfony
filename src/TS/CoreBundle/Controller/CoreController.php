<?php

namespace TS\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoreController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('TSCoreBundle:Core:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()->add('infoContact', 'Message flash: La page de contact n\'est pas encore disponible, merci de revenir plus tard');
        return $this->redirectToRoute('ts_core_homepage');
    }
}
