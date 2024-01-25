<?php

declare(strict_types=1);

namespace App\Application\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutPage extends AbstractController
{
    #[Route('/logout', name: 'app_logout_page', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('app_login_page');
    }
}
