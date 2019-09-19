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
    	$skills = $repo->findByCatAsc();

        return $this->render('skill/index.html.twig', [
            'controller_name' => 'SkillController',
            'skills' => $skills
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
