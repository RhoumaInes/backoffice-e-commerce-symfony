<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ErrorController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    /**
     * @Route("/error", name="error_generic")
     */
    public function errorGeneric(): Response
    {
        // Get the current request
        $request = $this->requestStack->getCurrentRequest();

        // Default error message and status
        $errorMessage = 'An error occurred';
        $statusCode = 500;

        // If it's an HttpException, get the status code and message
        $exception = $request->attributes->get('exception');
        // If an exception exists, retrieve status code and message
        if ($exception instanceof \Throwable) {
            $statusCode = $exception->getCode();
            $errorMessage = $exception->getMessage();
            // Check if it's a 404 error
            if ($exception instanceof HttpExceptionInterface && $exception->getStatusCode() === 404) {
                // Handle 404 error specifically
                $statusCode = $exception->getStatusCode();
                return $this->render('bundles/TwigBundle/Exception/error404.html.twig', [
                    'errorMessage' => $errorMessage,
                    'statusCode' => $exception->getStatusCode(),
                ]);
            }
        }
        
        // Render the error500.html.twig template with the error message and status
        return $this->render('bundles/TwigBundle/Exception/error.html.twig', [
            'errorMessage' => $errorMessage,
            'statusCode' => $statusCode,
        ]);
    }

}
