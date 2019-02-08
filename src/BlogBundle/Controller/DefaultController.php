<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


//hérité class Controller de Symfony
class DefaultController extends Controller
{
    //url avec variables
    /**
     * @Route("/coucou-{name}-{age}", name="index", requirements={"name": "[a-zA-Z]+", "age": "[0-9]+"})
     */
    public function indexAction( $name, $age )
    {
        return $this->render('BlogBundle:Default:index.html.twig', array( 'name' => $name, 'age' => $age, 'tableau' => array(
            'test1',
            'test2',
            'test2'
        ) ) );
        //return new Response('<h1>Coucou '. $name .'</h1>');
    }


    //url avec variables
    /**
     * @Route("/test-link", name="test-link")
     */
    public function testLinkAction()
    {
        return $this->render('BlogBundle:Default:test-link.html.twig');
    }

    //url de redirection vers google.com
    /**
     * @Route("/test-redirect")
     */
    
    public function testRedirectAction()
    {
        return $this->redirect( 'https://google.com' );
        
    }


    //url de redirection interne avec variables
    /**
     * @Route("/test-redirect-interne")
     */
    public function testRedirectInterneAction()
    {
        return $this->redirectToRoute( 'index', array( 'name' => 'jean', 'age' => 42) );
        
    }


    //url error
    /**
     * @Route("/test-error")
     */
    public function testErrorAction()
    {
        //throw new \Exception("ERROR");
        //throw $this->createNotFoundException("Cette page n'existe pas");
        
        //page erreur avec message
        $response = new Response( 'Une erreur est survenue' );
        $response->setStatusCode(500);
        return $response;
    }


    //url req  (superglobal: $post, $get, $cookie)
    //req pour récup sessions
    /**
     * @Route("/test-request", requirements={"name": "[a-zA-Z]+", "age": "[0-9]+"})
     */
    public function testRequest( Request $request )
    {
        //return $this->render('BlogBundle:Default:index.html.twig');

        //return new Response( $request->get( 'page' ) );
        // url ...web/app_dev.php/test-request?page=vanessa (affiche vanessa)

        //$request->getSession()->set( 'id', 42 ); 
        // enregistre en "mémoire"

        //return new Response ( $request->getSession()->get( 'id' ) );
        // affiche id en mémoire

        //return new Response( $request->cookies->get( 'PHPSESSID' ) );
        // 2rudc8cad4154cla7fcq64prjl     id session php

        //return new Response( $request->server->get( 'REMOTE_ADDR' ) );
        // ::1    adress ip (localhost)


        //return new Response( $request->headers->get( 'User_Agent' ) );
        // Mozilla ... Chrome ...     navigateurs 

        return new Response( $request->getMethod() );
        // méthode http récupérée

    } 



    public function menuAction()
    {
        $requestStack = $this->get( 'request_stack' );
        $masterRequest = $requestStack->getMasterRequest();
        
        $route = null;
        if( $masterRequest )
        {
            $route = $masterRequest->attributes->get( '_route' );
        } 
        return $this->render( 'BlogBundle:Default:menu.html.twig', array( 'activeRoute' => $route ) );
    }

  
}
