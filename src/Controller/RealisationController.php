<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Realisation;
use App\Repository\RealisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\RealisationType;
use App\Form\EditRealisationType;

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

            $this->addFlash('success', 'Réalisation ajoutée !');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('realisation/add.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param Realisation $realisation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/realisations/edit/{id}", name="edit_realisations")
     */
    public function edit(Request $request, ObjectManager $manager, Realisation $realisation)
    {


        $form = $this->createForm(EditRealisationType::class, $realisation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $manager->flush();

            $this->addFlash('success', 'Réalisation modifiée');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('realisation/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
