<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serialization;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema(
 *     title="UserDto",
 *     description="UserDto"
 * )
 *
 * Class UserDto
 */
class UserDto
{
    /**
     * @OA\Property(
     *     format="email",
     *     title="Email",
     *     description="Email",
     * )
     *
     * @Serialization\Type("string")
     * @Assert\Email()
     */
    public $email;

    /**
     * @OA\Property(
     *     format="string",
     *     title="Password",
     *     description="Password",
     * )
     *
     * @Serialization\Type("string")
     * @Assert\Length(min=6)
     */
    public $password;

    /**
     * @OA\Property(
     *     format="string",
     *     title="number_driver",
     *     description="number_driver",
     * )
     *
     * @Serialization\Type("string")
     */
    public $number_driver;

    /**
     * @OA\Property(
     *     format="string",
     *     title="name",
     *     description="name",
     * )
     *
     * @Serialization\Type("string")
     */
    public $name;

    /**
     * @OA\Property(
     *     format="string",
     *     title="surname",
     *     description="surname",
     * )
     *
     * @Serialization\Type("string")
     */
    public $surname;

    /**
     * @OA\Property(
     *     format="string",
     *     title="midName",
     *     description="midName",
     * )
     *
     * @Serialization\Type("string")
     */
    public $midName;

    /**
     * @OA\Property(
     *     format="string",
     *     title="dateDriver",
     *     description="dateDriver",
     * )
     *
     * @Serialization\Type("string")
     */
    public $dateDriver;

    /**
     * @OA\Property(
     *     format="string",
     *     title="adressDriver",
     *     description="adressDriver",
     * )
     *
     * @Serialization\Type("string")
     */
    public $adressDriver;

    /**
     * @OA\Property(
     *     format="integer",
     *     title="expDriver",
     *     description="expDriver",
     * )
     *
     * @Serialization\Type("integer")
     */
    public $expDriver;

    /**
     * @OA\Property(
     *     format="boolean",
     *     title="genderDriver",
     *     description="genderDriver",
     * )
     *
     * @Serialization\Type("boolean")
     */
    public $genderDriver;

    /**
     * @OA\Property(
     *     format="float",
     *     title="KBM",
     *     description="KBM",
     * )
     *
     * @Serialization\Type("float")
     */
    public $KBM;
}
