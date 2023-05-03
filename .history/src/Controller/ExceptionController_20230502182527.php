<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionController extends AbstractController
{
    /**
     * @Route("/error")
     */
    public function showException(): Response
    {
        return $this->render('not_found.html.twig', [], new Response('', 404));
    }
}
