<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Vote;
use App\Entity\Teacher;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CategoryType;
use App\Form\Type\VoteType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/", name="category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/category/new", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/category/{id}/edit", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    // /**
    //  * @Route("/", name="vote")
    //  */

    // public function newVote (Request $request)
    // {
    //     $vote = new Vote();

    //     $categories = $this->getDoctrine()
    //     ->getRepository(Category::class)
    //     ->findAll();

    //     // $count = count($categories);

    //     $form = $this->createForm(VoteType::class, $vote, array(
    //         'categories' => $categories
    //     ));

    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // $form->getData() holds the submitted values
    //         // but, the original `$task` variable has also been updated
    //         $vote = $form->getData();
    
    //         // ... perform some action, such as saving the task to the database
    //         // for example, if Task is a Doctrine entity, save it!
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($vote);
    //         $entityManager->flush();
    
    //         return $this->redirectToRoute('vote');
    //     }

    //     return $this->render('vote/new.html.twig', [
    //         'form' => $form->createView(),
    //         'categories' => $categories
    //     ]);
    // }
}
