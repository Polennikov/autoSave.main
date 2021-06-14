<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\Course;
use App\Model\CourseDto;
use App\Model\AutoDto;
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
class AutoController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/v1/auto",
     *     tags={"Auto"},
     *     summary="Get Auto",
     *     description="Get Auto",
     *     operationId="auto",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *              @OA\Property(
     *                  property="username",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="roles",
     *                  type="string"
     *              )
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
     * @Route("/auto", name="auto", methods={"GET"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function index(SerializerInterface $serializer): Response
    {
        $entityManager  = $this->getDoctrine()->getManager();
        $autoRepository = $entityManager->getRepository(Auto::class);

        // Получаем все курсы
        $autoAll = $autoRepository->findAll();
        foreach ($autoAll as $auto) {
            $resultAuto[] = [
                'id'       => $auto->getId(),
                'vin'      => $auto->getVin(),
                'marka'    => $auto->getMarka(),
                'model'    => $auto->getModel(),
                'number'   => $auto->getNumber(),
                'color'    => $auto->getColor(),
                'year'     => $auto->getYear(),
                'power'    => $auto->getPower(),
                'mileage'  => $auto->getMileage(),
                'category' => $auto->getCategory(),
                'users'    => $auto->getUsers()->getUsername(),
            ];
        }

        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode(Response::HTTP_OK);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($resultAuto, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auto/new",
     *     tags={"Auto"},
     *     summary="Create Auto",
     *     description="Create Auto",
     *     operationId="auto.new",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AutoDto")
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="bool",
     *                  example="true"
     *              )
     *          )
     *     ),
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
     *                  example="Invalid credentials."
     *              )
     *          )
     *     )
     *)
     * @Route("/auto/new", name="auto_new", methods={"POST"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function new(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        // Десериализация запроса в Dto
        $autoDto = $serializer->deserialize($request->getContent(), AutoDto::class, 'json');
        // Проверка ошибок валидации
        $errors   = $validator->validate($autoDto);
        $response = new Response();

        if (count($errors) > 0) {
            // Формируем ответ сервера
            $data = [
                'code'    => Response::HTTP_BAD_REQUEST,
                'message' => $errors,
            ];
            // Устанавливаем статус ответа
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        } else {
            try {
                // Создаем курс из Dto
                $auto          = Auto::fromDto($autoDto, $this->getUser());
                $auto->setMileage($autoDto->mileage);
                $auto->setNumberSts($autoDto->number_sts);
                $entityManager = $this->getDoctrine()->getManager();
                // Сохраняем курс в базе данных
                $entityManager->persist($auto);
                $entityManager->flush();

                // Формируем ответ сервера
                $data = [
                    'success' => true,
                    'user'=>$this->getUser()->getId(),
                ];
                $response->setStatusCode(Response::HTTP_CREATED);
            } catch (\Exception $e) {
                // Формируем ответ сервера
                $data = [
                    'code'    => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ];
                $response->setStatusCode(Response::HTTP_CREATED);
            }
        }

        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auto/{vin}",
     *     tags={"Auto"},
     *     summary="Show Auto",
     *     description="Show Auto",
     *     operationId="auto.show",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/AutoDto")
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
     * @Route("/auto/{vin}", name="auto_show", methods={"GET"})
     * @param   string               $vin
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function show(string $vin, SerializerInterface $serializer): Response
    {
        $entityManager  = $this->getDoctrine()->getManager();
        $autoRepository = $entityManager->getRepository(Auto::class);

        // Поиск курса
        $auto = $autoRepository->findOneBy(['vin' => $vin]);
        if (!isset($auto)) {
            $autoData   = [
                'code'    => Response::HTTP_NOT_FOUND,
                'message' => 'Данный авто не найден!',
            ];
            $statusCode = Response::HTTP_NOT_FOUND;
        } else {
            $autoData   = [
                'id'       => $auto->getId(),
                'vin'      => $auto->getVin(),
                'marka'    => $auto->getMarka(),
                'model'    => $auto->getModel(),
                'number'   => $auto->getNumber(),
                'number_sts'=>$auto->getNumberSts(),
                'color'    => $auto->getColor(),
                'year'     => $auto->getYear(),
                'power'    => $auto->getPower(),
                'mileage'    => $auto->getMileage(),
                'category' => $auto->getCategory(),
                'users'    => $auto->getUsers()->getUsername(),
                'contracts'    => $auto->getContracts(),
            ];
            $statusCode = Response::HTTP_OK;
        }

        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode($statusCode);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($autoData, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auto/{vin}/edit",
     *     tags={"Auto"},
     *     summary="Edit Auto",
     *     description="Edit Auto",
     *     operationId="auto.edit",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AutoDto")
     *     ),
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="bool",
     *                  example="true"
     *              )
     *          )
     *
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
     * @Route("/auto/{vin}/edit", name="auto_edit", methods={"POST"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function edit(string $vin,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        AutoRepository $autoRepository): Response
    {
        // Десериализация запроса в Dto
        $autoDto = $serializer->deserialize($request->getContent(), AutoDto::class, 'json');
        // Проверка ошибок валидации
        $errors = $validator->validate($autoDto);

        $response = new Response();

        if (count($errors) > 0) {
            // Формируем ответ сервера
            $data = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $errors,
            ];
            // Устанавливаем статус ответа
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        } else {
            // Получаем существующий курс
            $auto = $autoRepository->findOneBy(['vin' => $vin]);
            // Если курс существует
            if ($auto) {
                $auto->setMarka($autoDto->marka);
                $auto->setModel($autoDto->model);
                $auto->setYear($autoDto->year);
                $auto->setMileage($autoDto->mileage);
                $auto->setColor($autoDto->color);
                $auto->setPower($autoDto->power);

                $entityManager = $this->getDoctrine()->getManager();

                // Сохраняем курс в базе данных
                $entityManager->persist($auto);
                $entityManager->flush();

                // Формируем ответ сервера
                $data = [
                    'success' => true,
                ];
                $response->setStatusCode(Response::HTTP_OK);
            } else {
                // Формируем ответ сервера
                $data = [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Произошла ошибка.',
                ];
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        }
        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auto/{vin}/delete",
     *     tags={"Auto"},
     *     summary="Delete Auto",
     *     description="Delete Auto",
     *     operationId="auto.delete",
     *
     *      @OA\Response(
     *          response="201",
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="bool",
     *                  example="true"
     *              )
     *          )
     *     ),
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
     * @Route("/auto/{vin}/delete", name="auto_delete", methods={"POST"})
     * @param   SerializerInterface  $serializer
     * @return Response
     */
    public function delete(string $vin, SerializerInterface $serializer): Response
    {
        $response = new Response();
        $entityManager  = $this->getDoctrine()->getManager();
        $autoRepository = $entityManager->getRepository(Auto::class);
        $auto = $autoRepository->findOneBy(['vin' => $vin]);
        //var_dump($auto->getId());
        if($auto) {
            $entityManager->remove($auto);
            $entityManager->flush();

            $data = [
                'success' => true,
            ];
            $response->setStatusCode(Response::HTTP_CREATED);
        }else{
            $data = [
                'code'    => Response::HTTP_BAD_REQUEST,
                'message' => 'Операция невозможна!',
            ];
            $response->setStatusCode(Response::HTTP_CREATED);
        }
        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;

    }
}
