<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

class HomeController extends AbstractController
{
    #[Route('/test', 'app_home')]
    public function homeIndex(): Response
    {
        return $this->render("home/home.html.twig");
    }
}