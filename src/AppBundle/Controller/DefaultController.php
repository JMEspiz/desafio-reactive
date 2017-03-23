<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/list", name="list")
     */
    public function listAction()
    {
        return $this->render('default/list.html.twig');
    }

    /**
     * @Route("/create", name="create-pool")
     */
    public function createAction()
    {
        return $this->render('default/create.html.twig');
    }
}
