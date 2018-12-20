<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\School;
use App\Repository\SchoolRepository;

class SchoolController extends AbstractController
{
    /**
     * @Route("/cursus", name="cursus")
     */
    public function index(SchoolRepository $repo)
    {
    	$schools = $repo->findAllDesc();
        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
            'schools' => $schools
        ]);
    }
}
