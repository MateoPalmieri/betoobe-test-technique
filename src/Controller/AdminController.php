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
        $pendingUsers = $userRepository->findAll();

        // Render the list of pending users
        return $this->render('admin/users.html.twig', [
            'pendingUsers' => $pendingUsers,
        ]);
    }

    /**
     * @Route("/admin/approve/{id}", name="admin_approve")
     */
    // public function approve(Request $request, User $user): Response
    // {
    //     // Set the user status to approved
    //     $user->setStatus('approved');

    //     // Save the updated user to the database
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $entityManager->persist($user);
    //     $entityManager->flush();

    //     // Redirect back to the list of pending users
    //     return $this->redirectToRoute('admin_users');
    // }
}
