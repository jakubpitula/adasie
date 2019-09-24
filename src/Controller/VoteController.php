<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vote;
use App\Form\Type\VoteType;
use App\Entity\Category;
use App\Entity\Minivote;
use App\Entity\Teacher;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CategoryType;
use App\Form\TeacherType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\VoteRepository;
use App\Repository\TeacherRepository;
use App\Repository\MinivoteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class VoteController extends AbstractController
{
    /**
     * @Route("/", name="vote")
     */

    public function new (Request $request)
    {
        $vote = new Vote();

        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();

        foreach($categories as $cat){
            $minivote = new Minivote();
            $minivote->setCategory($cat);
            $minivote->setVote($vote);
            $vote->getMinivotes()->add($minivote);
        }

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
    
            return $this->redirectToRoute('completed');
        }

        return $this->render('vote/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/votes", name="vote_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(MinivoteRepository $minivoteRepository, VoteRepository $voteRepository, CategoryRepository $categoryRepository, TeacherRepository $teacherRepository): Response
    {

        return $this->render('vote/index.html.twig', [
            'votes' => $voteRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/votes/{id}", name="vote_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Vote $vote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vote_index');
    }

    /**
     * @Route("/votes/{id}/edit", name="vote_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Vote $vote): Response
    {
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vote_index');
        }

        return $this->render('vote/edit.html.twig', [
            'vote' => $vote,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/completed", name="completed", methods={"GET"})
    */
    public function completed()
    {
        return $this->render('vote/finished.html.twig');
    }
}
