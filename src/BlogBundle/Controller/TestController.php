<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('BlogBundle:Test:test.html.twig', array(
            // ...
        ));
    }

}
