<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vote;
use App\Form\Type\VoteType;


class VoteController extends AbstractController
{
    /**
     * @Route("/", name="vote")
     */

    public function new (Request $request)
    {
        $vote = new Vote();

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
        ]);
    }
}
