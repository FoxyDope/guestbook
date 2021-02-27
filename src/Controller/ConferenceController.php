<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    #[Route('/{name}', name: 'homepage')]
    public function index(string $name = ''): Response
    {
        if ($name) {
            echo sprintf('<h1>Hello %s!', htmlspecialchars($name));
        }

        return new Response(<<<EOF
        <html>
            <body>
                <img src="/images/vladik.png" />
            </body>
        </html>
        EOF
        );
    }
}
