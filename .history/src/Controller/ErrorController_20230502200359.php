<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="error")
     */
    public function showError(Request $request)
    {
        $statusCode = $this->getStatusCode($request);
        $resource = $this->getResource($request);

        return $this->render('bundles/TwigBundle/Exception/error.html.twig', [
            'status_code' => $statusCode,
            'resource' => $resource,
            'exception' => null,
        ], new Response('', $statusCode));
    }

    private function getStatusCode(Request $request)
    {
        $exception = $request->attributes->get('exception');

        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    private function getResource(Request $request)
    {
        return $request->getRequestUri();
    }
}
