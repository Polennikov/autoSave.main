<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\BookKT;
use App\Entity\RelationDriver;
use App\Entity\Contract;
use App\Entity\BookTB;
use App\Entity\BookKBC;
use App\Entity\BookKC;
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
     * @OA\Post(
     *     path="/api/v1/amount/{id}",
     *     tags={"Amount"},
     *     summary="Get Amount",
     *     description="Get Amount",
     *     operationId="amount",
     *
     *     @OA\Response(
     *      response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *              @OA\Property(
     *                  property="Amount",
     *                  type="string"
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
     * @Route("/amount/{id}", name="amount", methods={"POST"})
     * @param   SerializerInterface  $serializer
     * @return Response
     */
    public function index(string $id,Request $request,SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $response = new Response();

            try {
                $contractRepository = $entityManager->getRepository(Contract::class);
                $contract           = $contractRepository->findOneBy(['id' => $id]);

                $autoRepository = $entityManager->getRepository(Auto::class);
                $auto           = $autoRepository->findOneBy(['vin' => $contract->getAuto()->getVin()]);

                $bookTBRepository = $entityManager->getRepository(BookTB::class);
                $indexTB           = $bookTBRepository->findOneBy(['category' => $auto->getCategory()]);

                $date1 = new \DateTime();
                $date2 = $auto->getUsers()->getDateDriver();
                $age   = $date1->diff($date2);
                $age   = $age->format("%Y");
                $bookKBCRepository = $entityManager->getRepository(BookKBC::class);
                $indexKBC1          = $bookKBCRepository->findIndex( $age);

                $indexKBC=$indexKBC1[0];
                if($auto->getUsers()->getExpDriver()<1){
                    $KBC=$indexKBC->getYearOneMin();
                }
                if($auto->getUsers()->getExpDriver()==1){
                    $KBC=$indexKBC->getYearOne();
                }
                if($auto->getUsers()->getExpDriver()==2){
                    $KBC=$indexKBC->getYearTwo();
                }
                if($auto->getUsers()->getExpDriver()<=4 &&
                $auto->getUsers()->getExpDriver()>=3){
                    $KBC=$indexKBC->getYearThree();
                }
                if($auto->getUsers()->getExpDriver()<=6 &&
                    $auto->getUsers()->getExpDriver()>=5){
                    $KBC=$indexKBC->getYearFive();
                }
                if($auto->getUsers()->getExpDriver()<=9 &&
                    $auto->getUsers()->getExpDriver()>=7){
                    $KBC=$indexKBC->getYearSeven();
                }
                if($auto->getUsers()->getExpDriver()<=14 &&
                    $auto->getUsers()->getExpDriver()>=10){
                    $KBC=$indexKBC->getYearTen();
                }
                if($auto->getUsers()->getExpDriver()>=15){
                    $KBC=$indexKBC->getYearFivten();
                }
                //limited
                if($contract->getNonLimited()==true){
                    $lim=1.87;
                }else{
                    $lim=1;
                            }
                //trailer
                if($contract->getTrailer()==true){
                    $trailer=1.4;
                }else{
                    $trailer=1;
                }
                //power
                if($auto->getPower()<50){
                    $power=0.6;
                }
                if($auto->getPower()<=100 &&
                    $auto->getPower()>=51){
                    $power=1;
                }
                if($auto->getPower()<=120 &&
                    $auto->getPower()>=101){
                    $power=1.2;
                }
                if($auto->getPower()<=150 &&
                    $auto->getPower()>=121){
                    $power=1.4;
                }
                if($auto->getPower()>=151){
                    $power=1.6;
                }
//
                $date1 = $contract->getDateStart();
                $date2 = $contract->getDateEnd();
                $date  = $date1->diff($date2);
                $date   = $date->format("%m");
                //
                $bookKCRepository = $entityManager->getRepository(BookKC::class);
                $indexKC          = $bookKCRepository->findIndex( $date);
                $indexKC=$indexKC[0]->getIndex();
                //
                $bookKTRepository = $entityManager->getRepository(BookKT::class);
                $indexKT          = $bookKTRepository->findIndex($auto->getUsers()->getAdressDriver());

                if(count($indexKT)==0){
                    $indexKT=2;
                }

                // Расчет страховки
                $amount=$indexTB->getIndex()*$auto->getUsers()->getKBM()*$KBC*$lim*$trailer*$power*$indexKT*$indexKC;

                // Формируем ответ сервера
                $data = [
                    'amount' => $amount,
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


        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

}
