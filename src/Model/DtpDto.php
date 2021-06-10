<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serialization;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema(
 *     title="DtpDto",
 *     description="DtpDto"
 * )
 *
 * Class DtpDto
 */
class DtpDto
{
    /**
     * @OA\Property(
     *     format="string",
     *     title="date_dtp",
     *     description="date_dtp",
     *     example="2021-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_dtp;

    /**
     * @OA\Property(
     *     format="string",
     *     title="description",
     *     description="description",
     *     example="Произошло столкновение двух автомобилей",
     * )
     *
     * @Serialization\Type("string")
     */
    public $description;

    /**
     * @OA\Property(
     *     format="string",
     *     title="adress_dtp",
     *     description="adress_dtp",
     *     example="г Москва",
     * )
     *
     * @Serialization\Type("string")
     */
    public $adress_dtp;

    /**
     * @OA\Property(
     *     format="string",
     *     title="degree",
     *     description="degree",
     *     example="легкая",
     * )
     *
     * @Serialization\Type("string")
     */
    public $degree;

    /**
     * @OA\Property(
     *     format="string",
     *     title="initiator",
     *     description="initiator",
     *     example="1",
     * )
     *
     * @Serialization\Type("string")
     */
    public $initiator;

    /**
     * @OA\Property(
     *     format="string",
     *     title="autos",
     *     description="auto vin",
     *     example="11111",
     * )
     *
     * @Serialization\Type("string")
     */
    public $autos;

    /**
     * @OA\Property(
     *     format="string",
     *     title="users",
     *     description="users number driver",
     *     example="12345",
     * )
     *
     * @Serialization\Type("string")
     */
    public $users;
}
