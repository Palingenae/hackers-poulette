<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Ticket;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TicketController extends AbstractController
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    #[Route('/tickets/create', name: 'tickets_create', methods: ['POST'])]
    public function createTicket(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        try {
            if ('json' !== $request->getContentTypeFormat()) {
                return new JsonResponse([['errors' => ['Pas du JSON']], Response::HTTP_BAD_REQUEST]);
            }

            $data = $request->getContent();
            $ticket = $serializer->deserialize($data, Ticket::class, 'json');

            $errors = $validator->validate($ticket);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;

                return new JsonResponse([['errors' => $errorsString], Response::HTTP_BAD_REQUEST]);
            }

            $this->ticketRepository->add($ticket);

            return new JsonResponse(['message' => 'OK, new ticket created'], Response::HTTP_CREATED);
        } catch (AccessDeniedException) {
            return new JsonResponse(
                ['error' => ["Vous n\'avez pas la permission de faire cette action"]],
                Response::HTTP_UNAUTHORIZED
            );
        } catch (\Throwable) {
            return new JsonResponse(
                ['errors' => ['Nope, ça faisait longtemps hein ?']],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
