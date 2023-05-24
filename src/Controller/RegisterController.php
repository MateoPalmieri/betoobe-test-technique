<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class RegisterController extends AbstractController
{
    #[Route('/register', 'registration')]
    public function register(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        // // Create a new user object
        $user = new User();

        // Create form for registration
        $userForm = $this->createForm(RegisterFormType::class, $user);

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // $userForm->getData() holds the submitted values
            // but, the original `$user` variable has also been updated

            // Save the user to the database
            $user = $userForm->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('register_success');
        }

        // Render the registration form
        return $this->render('register/register.html.twig', [
            'userForm' => $userForm,
        ]);
    }

    #[Route('/register_success', 'register_success')]
    public function registerSuccess(): Response
    {
        return $this->render('register/register_success.html.twig');
    }
}
