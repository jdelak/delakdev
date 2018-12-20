<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Experience;
use App\Repository\ExperienceRepository;
use App\Form\ExperienceType;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(ExperienceRepository $repo)
    {
    	$experiences = $repo->findAllDesc();
        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
            'experiences' => $experiences
        ]);
    }

    /**
     * @Route("/admin/experiences/add", name="add_experiences")
     */
    public function add(Request $request, ObjectManager $manager){
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($experience);
            $manager->flush();
        }

        return $this->render('experience/add.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
