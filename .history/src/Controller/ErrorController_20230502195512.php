<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="error")
     */
    public function showError(Request $request)
    {
        $resourceUrl = $request->getRequestUri();
        throw new NotFoundHttpException('La página que buscas no existe.', null, 404, [
            'resource' => $resourceUrl
        ]);
    }
}
