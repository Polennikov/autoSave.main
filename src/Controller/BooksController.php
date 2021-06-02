<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\BookKT;
use App\Entity\RelationDriver;
use App\Model\ContractDto;
use App\Repository\AutoRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1")
 */
class BooksController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/v1/books/kt",
     *     tags={"Books"},
     *     summary="Get index KT",
     *     description="Get index KT",
     *     operationId="books.kt",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *              @OA\Property(
     *                  property="region",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="index",
     *                  type="float"
     *              )
     *
     *          )
     * ),
     *     @OA\Response(
     *          response="401",
     *          description="Invalid credentials",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="string",
     *                  example="401"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Invalid JWT Token"
     *              )
     *          )
     *     )
     *)
     * @Route("/books/kt", name="books_kt", methods={"GET"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function index(SerializerInterface $serializer): Response
    {
        $entityManager  = $this->getDoctrine()->getManager();
        $Repository = $entityManager->getRepository(BookKT::class);
        $index           = $Repository->findAll();


        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode(Response::HTTP_OK);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($index, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

}
