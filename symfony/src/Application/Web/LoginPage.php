<?php

declare(strict_types=1);

namespace App\Application\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginPage extends AbstractController
{
    #[Route('/login', name: 'app_login_page', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('login.html.twig');
    }
}
