<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Minivote;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MinivoteRepository;
use App\Repository\CategoryRepository;
use App\Repository\TeacherRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class MinivoteController extends AbstractController
{
    /**
     * @Route("/minivote", name="minivote")
     */
    public function index(MinivoteRepository $minivoterepository, CategoryRepository $categoryrepository, TeacherRepository $teacherrepository): Response
    {
        $minivotes = $minivoterepository->findAll();
        $categories = $categoryrepository->findAll();
        $teachers = $teacherrepository->findAllBut('brak');

        $countedMinivotes = array(array());

        foreach($categories as $category){
            foreach($teachers as $teacher){
                $countedMinivotes[$category->getName()][$teacher->getName()] = $minivoterepository->findNumberOfMinivotes($teacher, $category);
            }
        }

        $maxInCategory = array();
        foreach($categories as $category){
            $maxInCategory[$category->getName()] = max($countedMinivotes[$category->getName()]);
        }

        return $this->render('minivote/index.html.twig', [
            'minivotes' => $minivotes,
            'categories' => $categories,
            'teachers' => $teachers,
            'counted' => $countedMinivotes,
            'maxes' => $maxInCategory,
        ]);
    }
}
