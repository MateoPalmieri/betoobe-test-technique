<?php

namespace App\Controller;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activities", name="activity_list")
     */
    #[Route('/activities', 'activities_list')]
    public function list(PersistenceManagerRegistry $doctrine): Response
    {
        $activities = $doctrine->getRepository(Activity::class)->findAll();

        return $this->render('activity/activities.html.twig', [
            'activities' => $activities,
        ]);
    }

    /**
     * @Route("/activity/register/{id}", name="activity_register")
     */
    // public function register(Activity $activity): Response
    // {
    //     // TODO: Handle the registration logic here

    //     return $this->redirectToRoute('activity_list');
    // }

    /**
     * @Route("/activity/cancel-registration/{id}", name="activity_cancel_registration")
     */
    // public function cancelRegistration(Activity $activity): Response
    // {
    //     // TODO: Handle the cancellation logic here

    //     return $this->redirectToRoute('activity_list');
    // }
}
