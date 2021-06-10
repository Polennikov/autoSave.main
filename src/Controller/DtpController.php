<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Dtp;
use App\Model\CourseDto;
use App\Model\AutoDto;
use App\Model\DtpDto;
use App\Service\Client;
use App\Service\ServicePy;
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
class DtpController extends AbstractController
{

    /**
     * @OA\Post(
     *     path="/api/v1/dtp/new",
     *     tags={"Dtp"},
     *     summary="Create Dtp",
     *     description="Create Dtp",
     *     operationId="dtp.new",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/DtpDto")
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
     * @Route("/dtp/new", name="dtp_new", methods={"POST"})
     * @param   SerializerInterface  $serializer
     *
     * @return Response
     */
    public function new(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        // Десериализация запроса в Dto
        $dtpDto = $serializer->deserialize($request->getContent(), DtpDto::class, 'json');
        // Проверка ошибок валидации
        $errors   = $validator->validate($dtpDto);
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
                $entityManager = $this->getDoctrine()->getManager();

                $autoRepository = $entityManager->getRepository(Auto::class);
                $autos          = $autoRepository->findOneBy(['vin' => $dtpDto->autos]);

                $userRepository = $entityManager->getRepository(User::class);
                $users          = $userRepository->findOneBy(['numberDriver' => $dtpDto->users]);

                $dtp           = Dtp::fromDto($dtpDto, $users, $autos);
                $entityManager = $this->getDoctrine()->getManager();
                // Сохраняем в базе данных
                $entityManager->persist($dtp);
                $entityManager->flush();

                // Формируем ответ сервера
                $data = [
                    'success' => true,
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
     *
     * @OA\Post(
     *     path="/api/v1/file/create",
     *     tags={"Dtp"},
     *     summary="Create file Dtp",
     *     description="Create file Dtp",
     *     operationId="file",
     *     @OA\Response(
     *          response="201",
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="string",
     *                  example="200"
     *              ),
     *               @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="File create success!"
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
     * )
     *
     * @Route("/file/create", name="file", methods={"POST"})
     * @param   Request              $request
     * @param   SerializerInterface  $serializer
     * @param   ValidatorInterface   $validator
     *
     * @return Response
     */
    public function fileCreate(
        SerializerInterface $serializer
    ): Response {

        $entityManager = $this->getDoctrine()->getManager();
        $dtpRepository = $entityManager->getRepository(Dtp::class);

        $dtpAll         = $dtpRepository->findAll();
        $create_data [] = [
            'age',
            'gender',
            'exp',
            'region',
            'marka',
            'year',
            'power',
            'kbm',
            'rise',

        ];
        foreach ($dtpAll as $dtp) {

            if ($dtp->getUsers()->getGenderDriver() == true) {
                $gender = 1;
            } else {
                $gender = 0;
            }
            if ($dtp->getInitiator() == true) {
                $initiator = 1;
            } else {
                $initiator = 0;
            }
            $date1 = new \DateTime();
            $date2 = $dtp->getUsers()->getDateDriver();
            $age   = $date1->diff($date2);
            $age   = $age->format("%Y");

            $create_data [] = [
                $age,
                $gender,
                $dtp->getUsers()->getExpDriver(),
                3,
                $dtp->getAutos()->getMarka(),
                $dtp->getAutos()->getYear(),
                $dtp->getAutos()->getPower(),
                $dtp->getUsers()->getKBM(),
                $initiator,

            ];
        }
        $col_delimiter = ',';
        $row_delimiter = "\n";

        $file = 'files/csv_file_dtp.csv';
        if (!is_array($create_data)) {
            return false;
        }

        if ($file && !is_dir(dirname($file))) {
            return false;
        }

        // строка, которая будет записана в csv файл
        $CSV_str = '';

        // перебираем все данные
        foreach ($create_data as $row) {
            $cols = array();

            foreach ($row as $col_val) {
                $cols[] = $col_val; // добавляем колонку в данные
            }
            $CSV_str .= implode($col_delimiter, $cols).$row_delimiter; // добавляем строку в данные
        }

        $CSV_str = rtrim($CSV_str, $row_delimiter);

        // задаем кодировку windows-1251 для строки
        if ($file) {
            $CSV_str = iconv("UTF-8", "cp1251", $CSV_str);

            // создаем csv файл и записываем в него строку
            file_put_contents($file, $CSV_str);

        }
        $response = new Response();

        /* $tmp=$servicePy->getPredictionKNN();*/

        $data = [
            'code'    => Response::HTTP_OK,
            'message' => 'File create success!',
        ];

        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }


    /**
     *
     * @OA\Post(
     *     path="/api/v1/predict/create",
     *     tags={"Dtp"},
     *     summary="Create predict Dtp",
     *     description="Create predict Dtp",
     *     operationId="predict",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="age",
     *                  type="string",
     *                  example="45"
     *              ),
     *              @OA\Property(
     *                  property="gender",
     *                  type="string",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="exp",
     *                  type="string",
     *                  example="12"
     *              ),
     *              @OA\Property(
     *                  property="region",
     *                  type="string",
     *                  example="48"
     *              ),
     *              @OA\Property(
     *                  property="marka",
     *                  type="string",
     *                  example="mazda"
     *              ),
     *              @OA\Property(
     *                  property="year",
     *                  type="string",
     *                  example="2005"
     *              ),
     *              @OA\Property(
     *                  property="engine",
     *                  type="string",
     *                  example="150"
     *              ),
     *              @OA\Property(
     *                  property="kbm",
     *                  type="string",
     *                  example="0.6"
     *              )
     *
     *
     *          )
     *
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
     * )
     *
     * @Route("/predict/create", name="predict", methods={"POST"})
     * @param   Request              $request
     * @param   SerializerInterface  $serializer
     * @param   ValidatorInterface   $validator
     *
     * @return Response
     */
    public function createPredict(
        SerializerInterface $serializer,
        ServicePy $servicePy,
        Request $request
    ): Response {

        $age  = $request->toArray()['age'];
        $data = [
            'age'    => $request->toArray()['age'],
            'gender' => $request->toArray()['gender'],
            'exp'    => $request->toArray()['exp'],
            'region' => $request->toArray()['region'],
            'marka'  => $request->toArray()['marka'],
            'year'   => $request->toArray()['year'],
            'engine' => $request->toArray()['engine'],
            'kbm'    => $request->toArray()['kbm'],
        ];
        $tmp  = $servicePy->getPredictionKNN($data);

        $response = new Response();

        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent($serializer->serialize($tmp, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }
}
