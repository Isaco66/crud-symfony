<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="error")
     */
    public function showError(Request $request)
    {
        $content = $this->renderView('exceptions/404.html.twig', ['resource' => $request->getRequestUri()]);
        $response = new Response($content);
        $response->setStatusCode(Response::HTTP_NOT_FOUND);
        return $response;
    }
}
