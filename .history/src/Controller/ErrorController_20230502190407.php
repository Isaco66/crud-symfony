<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error/{code}", name="error")
     */
    public function showError($code)
    {
        return $this->render('404.html.twig', ['code' => $code]);
    }
}
