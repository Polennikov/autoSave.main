<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Contract;
use App\Entity\RelationDriver;
use App\Model\UserDto;
use App\Repository\AutoRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1")
 */
class RelationDriverController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/v1/relation/{id}",
     *     tags={"Driver"},
     *     summary="Get Driver",
     *     description="Get Driver",
     *     operationId="driver",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *              @OA\Property(
     *                  property="surname",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="midName",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="number",
     *                  type="string"
     *              )
     *
     *          )
     *   ),
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
     * @Route("/relation/{id}", name="relation_driver", methods={"GET"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function index(string $id, SerializerInterface $serializer): Response
    {
        $response = new Response();
        try {
            $entityManager      = $this->getDoctrine()->getManager();
            $contractRepository = $entityManager->getRepository(Contract::class);
            $contract           = $contractRepository->findOneBy(['id' => $id]);

            $relationRepository = $entityManager->getRepository(RelationDriver::class);
            $relationAll        = $relationRepository->findBy(['contracts' => $contract]);

            foreach ($relationAll as $relation) {
                $userRepository = $entityManager->getRepository(User::class);
                $user           = $userRepository->findOneBy(['id' => $relation->getUsers()]);
                $result[]       = [
                    'surname'  => $user->getSurname(),
                    'name'    => $user->getName(),
                    'midName' => $user->getMidName(),
                    'number'=>$user->getNumberDriver(),

                ];
            }
            if ($relationAll == null) {
                $result = [
                    'code'    => Response::HTTP_BAD_REQUEST,
                    'message' => 'Ошибка запроса!',
                ];
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
            // Формируем ответ сервера
            $result = [
                'code'    => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ];
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        // Устанавливаем статус ответа
        $response->setStatusCode(Response::HTTP_OK);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($result, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }
}
