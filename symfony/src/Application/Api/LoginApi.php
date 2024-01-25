<?php

declare(strict_types=1);

namespace App\Application\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginApi
{
    #[Route('/api/login', name: 'api_login')]
    public function execute(Request $request): Response
    {
        $token = $request->headers->get('cookie');

        return new JsonResponse(['token' => $token]);
    }
}
