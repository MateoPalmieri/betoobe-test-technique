<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class AdminController extends AbstractController
{
    #[Route('/admin/users', 'admin_users', methods: ['GET'])]
    public function users(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        // Get all pending user registrations
        $userRepository = $doctrine->getRepository(User::class);
        $pendingUsers = $userRepository->findByStatus(0);

        $allUsers = $doctrine->getRepository(User::class)->findAll();

        // $activities = $doctrine->getRepository(Activity::class)->findAll();

        // Render the list of pending users
        return $this->render('admin/users.html.twig', [
            'pendingUsers' => $pendingUsers,
            'allUsers'     => $allUsers,
            // 'activities' => $activities,
        ]);
    }

    #[Route('/admin/approve/{id}', 'admin_approve')]
    public function approve(User $user, PersistenceManagerRegistry $doctrine, $id): Response
    {
        $userRepository = $doctrine->getRepository(User::class);

        $user = $userRepository->find($id);

        // Set the user status to approved
        $user->setStatus(1);

        // Save the updated user to the database
        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Redirect back to the list of pending users
        return $this->redirectToRoute('admin_users');
    }
}
