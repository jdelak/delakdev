<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Skill;
use App\Repository\SkillRepository;
use App\Form\SkillType;

class SkillController extends AbstractController
{
    /**
     * @Route("/skills", name="skills")
     */
    public function index(SkillRepository $repo)
    {
    	$frontSkills = $repo->findByCatAsc(1);
        $phpSkills = $repo->findByCatAsc(2);
        $javaSkills = $repo->findByCatAsc(3);
        $bddSkills = $repo->findByCatAsc(4);
        $graphSkills = $repo->findByCatAsc(5);
        $gitSkills = $repo->findByCatAsc(6);
        $otherSkills = $repo->findByCatAsc(7);

        return $this->render('skill/index.html.twig', [
            'controller_name' => 'SkillController',
            'frontSkills' => $frontSkills,
            'phpSkills' => $phpSkills,
            'javaSkills' => $javaSkills,
            'bddSkills' => $bddSkills,
            'graphSkills' => $graphSkills,
            'gitSkills' => $gitSkills,
            'otherSkills' => $otherSkills
            
        ]);
    }

    /**
     * @Route("/admin/skills/add", name="add_skills")
     */
    public function add(Request $request, ObjectManager $manager){
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($skill);
            $manager->flush();
        }

        return $this->render('experience/add.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
