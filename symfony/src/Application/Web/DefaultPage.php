<?php

namespace App\Application\Web;

use App\Domain\UseCases\ListGenres;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultPage extends AbstractController
{
    private ListGenres $listGenres;

    public function __construct(ListGenres $listGenres)
    {
        $this->listGenres = $listGenres;
    }


    #[Route('/', name: 'app_default_page', methods: ['GET'])]
    public function index(): Response
    {
        if (null === $this->getUser()) {
            return $this->redirectToRoute('app_login_page');
        }

        $genres = $this->listGenres->execute();

        return $this->render('default_page.html.twig', [
            'genres' => $genres,
        ]);
    }
}
