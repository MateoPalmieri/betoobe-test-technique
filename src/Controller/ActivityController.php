<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activities", name="activity_list")
     */
    #[Route('/activities', 'activity_list')]
    public function list(PersistenceManagerRegistry $doctrine): Response
    {
        $activities = $doctrine->getRepository(Activity::class)->findAll();

        return $this->render('activity/activities.html.twig', [
            'activities' => $activities,
        ]);
    }

    #[Route('/activity/register/{id}', 'activity_register')]
    public function register(PersistenceManagerRegistry $doctrine, $id): Response
    {

        // Get the current user
        $user = $this->getUser();

        // Get the activity id
        $activity = $doctrine->getRepository(Activity::class)->find($id);

        // Get the available places
        $maxUser = $activity->getMaxUser();

        // Verify if the activity exist
        if (!$activity) {
            throw $this->createNotFoundException('Activité non trouvée.');
        }

        // Verify if the activity still have available places
        if ($maxUser == 0) {
            return $this->redirectToRoute('activity_limit_reach');
        }

        // Associate user to activity
        $user->setActivity($activity);

        // Activity max_user decrease if someone join
        $activity->setMaxUser($maxUser - 1);

        // Save the informations
        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('activity_list');
    }

    #[Route('/activity/cancel-registration/{id}', 'activity_cancel_registration')]
    public function cancelRegistration(PersistenceManagerRegistry $doctrine, $id): Response
    {
        // Get the current user
        $user = $this->getUser();

        // Get the activity id
        $activity = $doctrine->getRepository(Activity::class)->find($id);

        $activity->removeUser($user);

        // Activity max_user increase if someone quit
        $maxUser = $activity->getMaxUser();
        $activity->setMaxUser($maxUser + 1);

        // Save the informations
        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('activity_list');
    }

    #[Route('/activity/limit', 'activity_limit_reach')]
    public function activityLimitReach(): Response
    {
        return $this->render('activity/limit_reach.html.twig');
    }
}
