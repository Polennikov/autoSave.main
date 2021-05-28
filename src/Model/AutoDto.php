<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serialization;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema(
 *     title="AutoDto",
 *     description="AutoDto"
 * )
 *
 * Class AutoDto
 */
class AutoDto
{
    /**
     * @OA\Property(
     *     format="string",
     *     title="Vin",
     *     description="6787786563d",
     *     example="6787786563d",
     * )
     *
     * @Serialization\Type("string")
     */
    public $vin;

    /**
     * @OA\Property(
     *     format="string",
     *     title="Marka",
     *     description="lada",
     *     example="lada",
     * )
     *
     * @Serialization\Type("string")
     */
    public $marka;

    /**
     * @OA\Property(
     *     format="stringe",
     *     title="Model",
     *     description="nevesta",
     *     example="nevesta",
     * )
     *
     * @Serialization\Type("string")
     */
    public $model;

    /**
     * @OA\Property(
     *     format="string",
     *     title="Number",
     *     description="о543тр62",
     *     example="о543тр62",
     * )
     *
     * @Serialization\Type("string")
     */
    public $number;

    /**
     * @OA\Property(
     *     format="string",
     *     title="Color",
     *     description="синий",
     *     example="синий",
     * )
     *
     * @Serialization\Type("string")
     */
    public $color;

    /**
     * @OA\Property(
     *     format="integer",
     *     title="Year",
     *     description="2019",
     *     example="2019",
     * )
     *
     * @Serialization\Type("integer")
     */
    public $year;

    /**
     * @OA\Property(
     *     format="integer",
     *     title="Power",
     *     description="109",
     *     example="109",
     * )
     *
     * @Serialization\Type("integer")
     */
    public $power;

    /**
     * @OA\Property(
     *     format="integer",
     *     title="mileage",
     *     description="mileage",
     *     example="200000",
     * )
     *
     * @Serialization\Type("integer")
     */
    public $mileage;

    /**
     * @OA\Property(
     *     format="string",
     *     title="Category",
     *     description="B",
     *     example="B",
     * )
     *
     * @Serialization\Type("string")
     */
    public $category;

}
