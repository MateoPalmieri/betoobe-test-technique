<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Bundle\SecurityBundle\Security;

class UserController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/user', 'user_profile')]
    public function profile(): Response
    {
        $user = $this->security->getUser();

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
