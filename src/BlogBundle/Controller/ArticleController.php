<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use BlogBundle\Entity\Article;
use BlogBundle\Entity\Comment;
use BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("articles/create")
     */
    public function createAction(Request $request)
    {   
        // $article = new Article();
        // $article->setTitle( 'Mon premier article' );
        // $article->setContent( 'Blablabla' );
        // $article->setCreatedAt( new \DateTime() );

        // $em = $this->getDoctrine()->getManager();  // pour gérer le crud
        // $em->persist( $article ); // pour enregistrer une bdd
        // $em->flush(); // pour enregistrer bis
        // return $this->render('BlogBundle:Article:create.html.twig', array(
        //     // ...
        // ));

            //form
        $article = new Article();

        $form = $this->createFormBuilder( $article )
            ->add( 'title', TextType::class, array( 'label' => 'Titre', 'required' => false ) )
            ->add ( 'content', TextareaType::class, array ( 'label' => 'Contenu', 'required' => false ) )
            ->add ( 'save', SubmitType::class, array ( 'label' => 'Enregister') )
            ->getForm();

        return $this->render('BlogBundle:Article:create.html.twig', array(
            'form' => $form->createView()
        ));


    }


    /**
     * @Route("articles/list")
     */
    public function listAction()
    {   
        //$articles = $this->getDoctrine()->getRepository( 'BlogBundle:article' )->findAll();
        $articles = $this->getDoctrine()->getRepository( 'BlogBundle:Article' )->findSortedByDate();
        return $this->render( 'BlogBundle:Article:list.html.twig', array( 'articles' => $articles ) );
        
    }



    //récupérer entité via repository
    //
    // /**
    //  * @Route("articles/{id}")
    //  */
    // public function showAction( $id)
    // {   
    //     $article = $this->getDoctrine()->getRepository( 'BlogBundle:Article' )->find( $id );
    //     if ( !$article )
    //     {
    //         throw $this->createNotFoundException();
    //     }
    //     return $this->render( 'BlogBundle:Article:show.html.twig', array( 'article' => $article ) );
    // }


    //récupérer entité paramconverter 
    /**
     * @Route("articles/{id}", name="showArticle")
     */
    public function showAction( Article $article, Request $request )
    {   
        $comment = new Comment();

        $form = $this->createForm( CommentType::class, $comment );
        $form->handleRequest( $request );
        if( $form->isSubmitted() )
        {
            if( $form->isValid() )
            {
                $comment->setCreatedAt( new \DateTime() );
                $comment->setArticle( $article );

                $em = $this->getDoctrine()->getManager();
                $em->persist( $comment );
                $em->flush();
            }
        }
        return $this->render( 'BlogBundle:Article:show.html.twig', array( 'article' => $article, 'form' => $form->createView() ) );
    }





    /**
     * @Route("articles/delete/{id}")
     */
    public function deleteAction( Article $article )
    {   
        $em = $this->getDoctrine()->getManager();
        $em->remove( $article );
        $em->flush();

        return $this->render( 'BlogBundle:Article:delete.html.twig' );
      
    }


    /**
     * @Route("articles/comment/{id}")
     */
    public function commentAction( Article $article )
    {   
        $comment = new Comment();
        $comment->setContent( 'Premier com' );
        $comment->setCreatedAt( new \DateTime() );

        $comment->setArticle( $article );

        // enregistrement en bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist( $comment );
        $em->flush();

        return $this->redirectToRoute( 'showArticle', array( 'id' =>$article->getid() ) );
      
    }




}
