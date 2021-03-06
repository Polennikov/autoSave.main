<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserDto;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Gesdinet\JWTRefreshTokenBundle\Service\RefreshToken;
use JMS\Serializer\SerializerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1")
 */
class AuthController extends AbstractController
{
    /**
     * @OA\Post(
     *     path="/api/v1/auth",
     *     tags={"User"},
     *     summary="Authorize",
     *     description="Authorize",
     *     operationId="auth",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="username",
     *                  type="string",
     *                  example="artem@mail.ru"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="Artem48"
     *              )
     *          )
     *     )
     * ),
     * @OA\Response(
     *      response=200,
     *       description="Success",
     *       @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="refresh_token",
     *                  type="string"
     *              )
     *          )
     *   ),
     * @OA\Response(
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
     *                  example="Invalid credentials"
     *              )
     *          )
     *     ),
     * @OA\Response(
     *      response=404,
     *      description="not found",
     *      @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="string",
     *                  example="404"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="not found"
     *              )
     *          )
     *   ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="string",
     *                  example="400"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Bad Request"
     *              )
     *          )
     *   ),
     * @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="string",
     *                  example="403"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Forbidden"
     *              )
     *          )
     *      )
     *
     * @Route("/auth", name="auth", methods={"POST"})
     */
    public function auth(): Response
    {
        
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     tags={"User"},
     *     summary="Registration",
     *     description="Registration ",
     *     operationId="register",
     *       @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="userEmail@mail.ru"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="user_password"
     *              ),
     *              @OA\Property(
     *                  property="numberDriver",
     *                  type="string",
     *                  example="56743892"
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Artem"
     *              ),
     *              @OA\Property(
     *                  property="surname",
     *                  type="string",
     *                  example="Polennikov"
     *              ),
     *              @OA\Property(
     *                  property="midName",
     *                  type="string",
     *                  example="Andreevich"
     *              ),
     *              @OA\Property(
     *                  property="expDriver",
     *                  type="string",
     *                  example="3"
     *              ),
     *              @OA\Property(
     *                  property="dateDriver",
     *                  type="string",
     *                  example="06.06.1999"
     *              ),
     *              @OA\Property(
     *                  property="adressDriver",
     *                  type="string",
     *                  example="adressDriver"
     *              ),
     *              @OA\Property(
     *                  property="genderDriver",
     *                  type="string",
     *                  example="true"
     *              ),
     *              @OA\Property(
     *                  property="KBM",
     *                  type="string",
     *                  example="0.65"
     *              ),
     *
     *          )
     *     )
     * ),
     * @OA\Response(
     *          response="201",
     *          description="Register successful",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="refresh_token",
     *                  type="string"
     *              )
     *          )
     *     ),
     * @OA\Response(
     *          response="500",
     *          description="The server is not available"
     *     ),
     * @OA\Response(
     *          response="400",
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string"
     *                  )
     *              )
     *          )
     *     ),
     * @OA\Response(
     *          response="403",
     *          description="User already exist",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *     )
     *
     * @Route("/register", name="register", methods={"POST"})
     *
     * @param   Request                       $request
     * @param   SerializerInterface           $serializer
     * @param   ValidatorInterface            $validator
     * @param   UserPasswordEncoderInterface  $passwordEncoder
     * @param   JWTTokenManagerInterface      $JWTManager

     *
     * @return Response
     */
    public function register(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $JWTManager,
        RefreshTokenManagerInterface $refreshTokenManager
    ): Response {
        $entityManager = $this->getDoctrine()->getManager();
        $userRepository = $entityManager->getRepository(User::class);

        $response = new Response();

        // ???????????????????????????? ?????????????? ?? Dto
        $userDto = $serializer->deserialize($request->getContent(), UserDto::class, 'json');
        $userDto->KBM=$request->toArray()['KBM'];
        $userDto->numberDriver=$request->toArray()['numberDriver'];
        $userDto->midName=$request->toArray()['midName'];
        $userDto->dateDriver=$request->toArray()['dateDriver'];
        $userDto->adressDriver=$request->toArray()['adressDriver'];
        $userDto->expDriver=$request->toArray()['expDriver'];
        $userDto->genderDriver=$request->toArray()['genderDriver'];
        //var_dump($userDto->KBM);
        // ???????????????? ???????????? ??????????????????
        $errors = $validator->validate($userDto);
        // ?????????????????? ???????????????????? ???? ???????????????????????? ?? ??????????????
        if ($userRepository->findOneBy(['email' => $userDto->email])) {
            // ?????????????????? ?????????? ??????????????
            $data = [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => '???????????????????????? ?? ?????????? ?????????????? ?????? ????????????????????!',
            ];
            // ?????????????????????????? ???????????? ????????????
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
        } elseif (count($errors) > 0) {
            // ?????????????????? ?????????? ??????????????
            $data = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $errors,
            ];
            // ?????????????????????????? ???????????? ????????????
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        } else {
            // ?????????????? ???????????????????????? ???? Dto
            $user = User::fromDto($userDto);
            // ???????????????? ????????????
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
            ));
            // ?????????????????? ???????????????????????? ?? ???????? ????????????
            $entityManager->persist($user);
            $entityManager->flush();

            // ?????????????????????????? ?????????? ????????????????????
            $refreshToken = $refreshTokenManager->create();
            $refreshToken->setUsername($user->getEmail());
            $refreshToken->setRefreshToken();
            $refreshToken->setValid((new \DateTime())->modify('+1 month'));
            $refreshTokenManager->save($refreshToken);

            // ?????????????????? ?????????? ??????????????
            $data = [
                // ?????????????? JWT token
                'token' => $JWTManager->create($user),
                'refresh_token' => $refreshToken->getRefreshToken(),
            ];
            // ?????????????????????????? ???????????? ????????????
            $response->setStatusCode(Response::HTTP_CREATED);
        }

        $response->setContent($serializer->serialize($data, 'json'));
        $response->headers->add(['Content-Type' => 'application/json']);

        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/token/refresh",
     *     tags={"User"},
     *     summary="Refresh token",
     *     operationId="token.refresh",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="refresh_token",
     *                  type="string"
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Operation successful",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="refresh_token",
     *                  type="string"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="code",
     *                  type="integer",
     *                  example="401"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An authentication exception occurred."
     *              )
     *          )
     *     )
     * )
     *
     * @Route("/token/refresh", name="refresh", methods={"POST"})
     */
    public function refresh(Request $request, RefreshToken $refreshService)
    {
        return $refreshService->refresh($request);
    }

}