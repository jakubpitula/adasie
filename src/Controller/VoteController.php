<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vote;
use App\Form\Type\VoteType;
use App\Entity\Category;
use App\Entity\Teacher;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CategoryType;
use App\Form\TeacherType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class VoteController extends AbstractController
{
    /**
     * @Route("/", name="vote")
     */

    public function new (Request $request)
    {
        $vote = new Vote();
        // $cat1 = new Category();
        // $cat1->setName('tag1');
        // $vote->getCategories()->add($cat1);
        // $cat2 = new Category();
        // $cat2->setName('tag2');
        // $vote->getCategories()->add($cat2);
        // $teach1 = new Teacher();
        // $teach1->setName('someteacher');
        // $vote->getTeachers()->add($teach1);
        // $teach2 = new Teacher();
        // $teach2->setName('someteacdher');
        // $vote->getTeachers()->add($teach2);

        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();
        
        /* TODO:
        *  POPRAWIĆ CAŁĄ FUNKCJONALNOŚĆ 
        *  COŚ W STYLU VOTES->MINIVOTES->[PO JEDNYM (USTALONA CATEGORY, TEACHER ENTITYTYPE)]
        */

        foreach($categories as $cat){
            $vote->getCategories()->add($cat);
        }

        $teachers = $this->getDoctrine()
        ->getRepository(Teacher::class)
        ->findAll();

        foreach($teachers as $teacher){
            $vote->getTeachers()->add($teacher);
        }
        // $count = count($categories);

        $form = $this->createForm(VoteType::class, $vote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $vote = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vote);
            $entityManager->flush();
    
            return $this->redirectToRoute('vote');
        }

        return $this->render('vote/new.html.twig', [
            'form' => $form->createView(),
            // 'categories' => $categories
        ]);
    }
}
