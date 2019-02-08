<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Teacher;
use BlogBundle\Entity\Student;

class SchoolController extends Controller
{

    /**
     * @Route("/school/list")
     */
    public function schoolList()
    {   
        $teachers = $this->getDoctrine()->getRepository( 'BlogBundle:Teacher' )->findTeachers();
        return $this->render( 'BlogBundle:School:school.html.twig', array( 'teachers' => $teachers ) );
    }



    /**
     * @Route("/school/teachers/{name}", name="teacher")
     */
    public function createTeacher( $name )
    {
        $teacher = new Teacher();
        $teacher->setName( $name );

        $em = $this->getDoctrine()->getManager();  // pour gérer le crud
        $em->persist( $teacher ); // pour enregistrer une bdd
        $em->flush(); // pour enregistrer bis
        return $this->render('BlogBundle:School:createTeacher.html.twig', array(
            'name' => $name
        ));
    }


    /**
     * @Route("school/teachers/delete/{id}")
     */
    public function deleteTeacher( Teacher $teacher )
    {   
        $em = $this->getDoctrine()->getManager();
        $em->remove( $teacher );
        $em->flush();
        return $this->render( 'BlogBundle:School:deleteTeacher.html.twig' );
    }



     /**
     * @Route("/school/students/{name}", name="student")
     */
    public function createStudent( $name )
    {
        $student = new Student();
        $student->setName( $name );

        $em = $this->getDoctrine()->getManager();  // pour gérer le crud
        $em->persist( $student ); // pour enregistrer une bdd
        $em->flush(); // pour enregistrer bis
        return $this->render('BlogBundle:School:createStudent.html.twig', array(
            'name' => $name
        ));
    }


    /**
     * @Route("school/students/delete/{id}")
     */
    public function deleteStudent( Student $student )
    {   
        $em = $this->getDoctrine()->getManager();
        $em->remove( $student );
        $em->flush();
        return $this->render( 'BlogBundle:School:deleteStudent.html.twig' );
    }



    //  /**
    //  * @Route("school/{nameTeacher}:{nameStudent}")
    //  */
    // public function addTeacherStudent( $nameTeacher, $nameStudent )
    // {   
    //     $teacher= new Teacher();
    //     $teacher->setName( $nameTeacher );

    //     $student= new Student();
    //     $student->setName( $nameStudent );


    //     $student->addStudent($teacher);

    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($teacher);
    //     $em->persist($student);
    //     $em->flush();
    //     return $this->render( 'BlogBundle:School:addTeacherStudent.html.twig', array(
    //         'teacher' => $teacher, 'student' => $student
    //     ) );
    // }







}
