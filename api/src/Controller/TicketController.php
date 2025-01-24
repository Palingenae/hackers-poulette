<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class TicketController extends AbstractController
{
    public function createTicket(Request $request, SerializerInterface $serializer) {
        $errors = [];

        if ('json' !== $request->getContentTypeFormat()) {
            return new JsonResponse([
                'errors' => $errors,
                Response::HTTP_BAD_REQUEST
        ]);
    }

        $jsonContent = $request->getContent();
        $ticket = $serializer->deserialize($jsonContent, Ticket::class, 'json');
    }
}