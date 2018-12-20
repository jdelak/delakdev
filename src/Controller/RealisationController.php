<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Realisation;
use App\Repository\RealisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\RealisationType;


class RealisationController extends AbstractController
{
    /**
     * @Route("/realisations", name="realisations")
     */
    public function index(RealisationRepository $repo)
    {
    	$realisations = $repo->findAllDescYear();
        return $this->render('realisation/index.html.twig', [
            'controller_name' => 'RealisationController',
            'realisations' => $realisations
        ]);
    }

     /**
     * @Route("/admin/realisations/add", name="add_realisations")
     */
    public function add(Request $request, ObjectManager $manager){
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($realisation);
            $manager->flush();
        }

        return $this->render('realisation/add.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
