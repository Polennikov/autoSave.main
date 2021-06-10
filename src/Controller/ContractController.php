<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Contract;
use App\Entity\RelationDriver;
use App\Model\ContractDto;
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
class ContractController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/api/v1/contract",
     *     tags={"Contract"},
     *     summary="Get Contract",
     *     description="Get Contract",
     *     operationId="contract",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/ContractDto")
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
     * @Route("/contract", name="contract", methods={"GET"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function index(SerializerInterface $serializer): Response
    {
        $response = new Response();
        try {
            $entityManager  = $this->getDoctrine()->getManager();
            $userRepository = $entityManager->getRepository(User::class);
            $user           = $userRepository->findOneBy(['numberDriver' => $this->getUser()->getNumberDriver()]);

            $relationRepository = $entityManager->getRepository(RelationDriver::class);
            $relationAll        = $relationRepository->findBy(['users' => $user]);

            foreach ($relationAll as $relation) {
                $contractRepository = $entityManager->getRepository(Contract::class);
                $contract           = $contractRepository->findOneBy(['id' => $relation->getContracts()]);
                $result[]           = [
                    'id'               => $contract->getId(),
                    'date_start'       => $contract->getDateStart(),
                    'date_end'         => $contract->getDateEnd(),
                    'amount'           => $contract->getAmount(),
                    'diagnostic_card'  => $contract->getDiagnosticCard(),
                    'purpose'          => $contract->getPurpose(),
                    'non_limited'      => $contract->getNonLimited(),
                    'status'           => $contract->getStatus(),
                    'auto_vin'         => $contract->getAuto()->getVin(),
                    'agent_id'         => $contract->getAgentId(),
                    'date_start_one'   => $contract->getDateStartOne(),
                    'date_end_one'     => $contract->getDateEndOne(),
                    'date_start_two'   => $contract->getDateStartTwo(),
                    'date_end_two'     => $contract->getDateEndTwo(),
                    'date_start_three' => $contract->getDateStartThree(),
                    'date_end_three'   => $contract->getDateStartThree(),

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

        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode(Response::HTTP_OK);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($result, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/contract/new",
     *     tags={"Contract"},
     *     summary="Create contract",
     *     description="Create contract",
     *     operationId="contract.new",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ContractDto")
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
     * @Route("/contract/new", name="contract_new", methods={"POST"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function new(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {

        // Десериализация запроса в Dto
        $contractDto = $serializer->deserialize($request->getContent(), ContractDto::class, 'json');
        // Проверка ошибок валидации
        $errors   = $validator->validate($contractDto);
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

                $entityManager  = $this->getDoctrine()->getManager();
                $autoRepository = $entityManager->getRepository(Auto::class);
                $auto           = $autoRepository->findOneBy(['vin' => $contractDto->autoVin]);

                // Создаем курс из Dto
                $contract      = Contract::fromDto($contractDto, $auto);
                $entityManager = $this->getDoctrine()->getManager();
                // Сохраняем в базе данных
                $entityManager->persist($contract);
                //$entityManager->flush();
                if ($contractDto->driver_one) {
                    // Создаем курс из Dto
                    $userRepository = $entityManager->getRepository(User::class);
                    $user           = $userRepository->findOneBy(['numberDriver' => $contractDto->driver_one]);
                    $relationDriver = RelationDriver::fromDto($user, $contract);
                    $entityManager  = $this->getDoctrine()->getManager();
                    // Сохраняем в базе данных
                    $entityManager->persist($relationDriver);
                    //$entityManager->flush();
                }
                if ($contractDto->driver_two) {
                    $userRepository = $entityManager->getRepository(User::class);
                    $user           = $userRepository->findOneBy(['numberDriver' => $contractDto->driver_two]);
                    if ($user) {
                        $relationDriver = RelationDriver::fromDto($user, $contract);
                        $entityManager  = $this->getDoctrine()->getManager();
                        // Сохраняем в базе данных
                        $entityManager->persist($relationDriver);
                        //$entityManager->flush();
                    }
                }
                if ($contractDto->driver_three) {
                    $userRepository = $entityManager->getRepository(User::class);
                    $user           = $userRepository->findOneBy(['numberDriver' => $contractDto->driver_three]);
                    if ($user) {
                        $relationDriver = RelationDriver::fromDto($user, $contract);
                        $entityManager  = $this->getDoctrine()->getManager();
                        // Сохраняем в базе данных
                        $entityManager->persist($relationDriver);
                        //$entityManager->flush();
                    }
                }
                if ($contractDto->driver_four) {
                    $userRepository = $entityManager->getRepository(User::class);
                    $user           = $userRepository->findOneBy(['numberDriver' => $contractDto->driver_four]);
                    if ($user) {
                        $relationDriver = RelationDriver::fromDto($user, $contract);
                        $entityManager  = $this->getDoctrine()->getManager();
                        // Сохраняем в базе данных
                        $entityManager->persist($relationDriver);

                    }
                }

                $entityManager->flush();
                // Формируем ответ сервера
                $data = [
                    'success' => true,
                    'id'      => $contract->getId(),
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
     *     path="/api/v1/contract/agent",
     *     tags={"Contract"},
     *     summary="Get Contract agent",
     *     description="Get Contract agent",
     *     operationId="contract.agent",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/ContractDto")
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
     * @Route("/contract/agent", name="contract_agent", methods={"GET"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function getContractAgent(SerializerInterface $serializer): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contractRepository = $entityManager->getRepository(Contract::class);
        $contractAll        = $contractRepository->findAll();

        foreach ($contractAll as $contract) {

            $relationRepository = $entityManager->getRepository(RelationDriver::class);
            $relationAll        = $relationRepository->findBy(['contracts' => $contract]);

            if ($contract->getStatus() == 1) {


                $result[] = [
                    'id'               => $contract->getId(),
                    'date_start'       => $contract->getDateStart(),
                    'date_end'         => $contract->getDateEnd(),
                    'amount'           => $contract->getAmount(),
                    'diagnostic_card'  => $contract->getDiagnosticCard(),
                    'purpose'          => $contract->getPurpose(),
                    'non_limited'      => $contract->getNonLimited(),
                    'status'           => $contract->getStatus(),
                    'auto_vin'         => $contract->getAuto()->getVin(),
                    'agent_id'         => $contract->getAgentId(),
                    'date_start_one'   => $contract->getDateStartOne(),
                    'date_end_one'     => $contract->getDateEndOne(),
                    'date_start_two'   => $contract->getDateStartTwo(),
                    'date_end_two'     => $contract->getDateEndTwo(),
                    'date_start_three' => $contract->getDateStartThree(),
                    'date_end_three'   => $contract->getDateStartThree(),

                ];
            }
        }

        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode(Response::HTTP_OK);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($result, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/contract/{id}",
     *     tags={"Contract"},
     *     summary="Show Contract",
     *     description="Show Contract",
     *     operationId="contract.show",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\JsonContent(ref="#/components/schemas/ContractDto")
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
     * @Route("/contract/{id}", name="contract_show", methods={"GET"})
     * @param   string               $id
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function show(string $id, SerializerInterface $serializer): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Repository    = $entityManager->getRepository(Contract::class);

        // Поиск
        $contract = $Repository->findOneBy(['id' => $id]);
        if (!isset($contract)) {
            $result     = [
                'code'    => Response::HTTP_NOT_FOUND,
                'message' => 'Данный авто не найден!',
            ];
            $statusCode = Response::HTTP_NOT_FOUND;
        } else {
            $relationRepository = $entityManager->getRepository(RelationDriver::class);
            $relations          = $relationRepository->findBy(['contracts' => $contract]);

            foreach ($relations as $relation) {
                $usersContract [] = [
                    'id'   => $relation->getId(),
                    'user' => $relation->getUsers(),
                ];
            }
            $result     = [
                'id'              => $contract->getId(),
                'date_start'      => $contract->getDateStart(),
                'date_end'        => $contract->getDateEnd(),
                'amount'          => $contract->getAmount(),
                'diagnostic_card' => $contract->getDiagnosticCard(),
                'purpose'         => $contract->getPurpose(),
                'non_limited'     => $contract->getNonLimited(),
                'status'          => $contract->getStatus(),
                'auto_vin'        => $contract->getAuto()->getVin(),
                'agent_id'        => $contract->getAgentId(),

                'drivers' => $usersContract,

                'date_start_one'   => $contract->getDateStartOne(),
                'date_end_one'     => $contract->getDateEndOne(),
                'date_start_two'   => $contract->getDateStartTwo(),
                'date_end_two'     => $contract->getDateEndTwo(),
                'date_start_three' => $contract->getDateStartThree(),
                'date_end_three'   => $contract->getDateStartThree(),
            ];
            $statusCode = Response::HTTP_OK;
        }

        $response = new Response();
        // Устанавливаем статус ответа
        $response->setStatusCode($statusCode);
        // Устанавливаем содержание ответа
        $response->setContent($serializer->serialize($result, 'json'));
        // Устанавливаем заголовок
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/contract/{id}/edit",
     *     tags={"Contract"},
     *     summary="Edit Contract",
     *     description="Edit Contract",
     *     operationId="contract.edit",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ContractDto")
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
     * @Route("/contract/{id}/edit", name="contract_edit", methods={"POST"})
     *
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function edit(
        string $id,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ): Response {
        // Десериализация запроса в Dto
        $contractDto = $serializer->deserialize($request->getContent(), ContractDto::class, 'json');
        // Проверка ошибок валидации
        $errors = $validator->validate($contractDto);

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
            // Получаем существующий курс
            $Repository         = $this->getDoctrine()->getManager();
            $contractRepository = $Repository->getRepository(Contract ::class);
            $contract           = $contractRepository->findOneBy(['id' => $id]);
            // Если курс существует
            if ($contract) {

                $contract->setDateStart(new \DateTime($contractDto->date_start));
                $contract->setDateEnd(new \DateTime($contractDto->date_end));

                $contract->setAmount($contractDto->amount);
                $contract->setDiagnosticCard($contractDto->diagnostic_card);
                $contract->setPurpose($contractDto->purpose);
                $contract->setNonLimited($contractDto->non_limited);

                $contract->setStatus($contractDto->status);
                $contract->setDiagnosticCard($contractDto->diagnostic_card);
                $contract->setPurpose($contractDto->purpose);
                $contract->setNonLimited($contractDto->non_limited);

                $contract->setAgentId($contractDto->agent_id);
                /*  $contract->setDriverOne($contractDto->driver_one);
                  $contract->setDriver_two($contractDto->driver_two);
                  $contract->setDriver_three($contractDto->driver_three);
                  $contract->setDriver_four($contractDto->driver_four);*/

                $contract->setDateStartOne(new \DateTime($contractDto->date_start_one));
                $contract->setDateEndOne(new \DateTime($contractDto->date_end_one));

                if ($contractDto->date_start_two != 'null') {
                    $contract->setDateStartTwo(new \DateTime($contractDto->date_start_two));
                    $contract->setDateEndTwo(new \DateTime($contractDto->date_end_two));
                }
                if ($contractDto->date_start_three != 'null') {
                    $contract->setDateStartThree(new \DateTime($contractDto->date_start_three));
                    $contract->setDateEndThree(new \DateTime($contractDto->date_end_three));
                }


                $entityManager = $this->getDoctrine()->getManager();

                // Сохраняем курс в базе данных
                $entityManager->persist($contract);
                $entityManager->flush();

                // Формируем ответ сервера
                $data = [
                    'success' => true,
                ];
                $response->setStatusCode(Response::HTTP_OK);
            } else {
                // Формируем ответ сервера
                $data = [
                    'code'    => Response::HTTP_BAD_REQUEST,
                    'message' => 'Произошла ошибка.',
                ];
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        }
        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

}

