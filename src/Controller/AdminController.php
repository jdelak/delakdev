<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Experience;
use App\Repository\ExperienceRepository;
use App\Entity\Skill;
use App\Repository\SkillRepository;
use App\Entity\School;
use App\Repository\SchoolRepository;
use App\Entity\Realisation;
use App\Repository\RealisationRepository;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="dashboard")
     */
    public function admin()
    {
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/experiences", name="admin_experiences")
     */
    public function admin_experiences(ExperienceRepository $repo)
    {
        $experiences = $repo->findAllDesc();
        return $this->render('admin/experience.html.twig', [
            'controller_name' => 'AdminController',
            'experiences' => $experiences
        ]);
    }

    /**
     * @Route("/admin/realisations", name="admin_realisations")
     */
    public function admin_realisations(RealisationRepository $repo)
    {
        $realisations = $repo->findAllDescYear();
        return $this->render('admin/realisation.html.twig', [
            'controller_name' => 'AdminController',
            'realisations' => $realisations
        ]);
    }

    /**
     * @Route("/admin/skills", name="admin_skills")
     */
    public function admin_skills(SkillRepository $repo)
    {
        $skills = $repo->findByMost();

        return $this->render('admin/skill.html.twig', [
            'controller_name' => 'AdminController',
            'skills' => $skills
        ]);
    }

    /**
     * @Route("/admin/cursus", name="admin_cursus")
     */
    public function admin_cursus(SchoolRepository $repo)
    {

        $schools = $repo->findAllDesc();
        return $this->render('admin/school.html.twig', [
            'controller_name' => 'AdminController',
            'schools' => $schools
        ]);
    }

}