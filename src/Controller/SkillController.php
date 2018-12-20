<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Skill;
use App\Repository\SkillRepository;

class SkillController extends AbstractController
{
    /**
     * @Route("/skills", name="skills")
     */
    public function index(SkillRepository $repo)
    {
    	$skills = $repo->findByMost();

        return $this->render('skill/index.html.twig', [
            'controller_name' => 'SkillController',
            'skills' => $skills
        ]);
    }
}
