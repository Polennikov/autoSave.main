<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serialization;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\Schema(
 *     title="ContractDto",
 *     description="ContractDto"
 * )
 *
 * Class ContractDto
 */
class ContractDto
{
    
    /**
     * @OA\Property(
     *     format="string",
     *     title="date_start",
     *     description="date_start",
     *     example="2021-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_start;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_end",
     *     description="date_end",
     *     example="2022-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_end;

    /**
     * @OA\Property(
     *     format="string",
     *     title="amount",
     *     description="amount",
     *     example="12500",
     * )
     *
     * @Serialization\Type("string")
     */
    public $amount;

    /**
     * @OA\Property(
     *     format="string",
     *     title="diagnostic_card",
     *     description="diagnostic_card",
     *     example="11111122222",
     * )
     *
     * @Serialization\Type("string")
     */
    public $diagnostic_card;

    /**
     * @OA\Property(
     *     format="string",
     *     title="purpose",
     *     description="purpose",
     *     example="Личное пользование",
     * )
     *
     * @Serialization\Type("string")
     */
    public $purpose;

    /**
     * @OA\Property(
     *     format="string",
     *     title="non_limited",
     *     description="non_limited",
     *     example="1",
     * )
     *
     * @Serialization\Type("string")
     */
    public $non_limited;

    /**
     * @OA\Property(
     *     format="string",
     *     title="trailer",
     *     description="trailer",
     *     example="1",
     * )
     *
     * @Serialization\Type("string")
     */
    public $trailer;

    /**
     * @OA\Property(
     *     format="string",
     *     title="status",
     *     description="status",
     *     example="1",
     * )
     *
     * @Serialization\Type("string")
     */
    public $status;

    /**
     * @OA\Property(
     *     format="string",
     *     title="autoVin",
     *     description="autoVin",
     *     example="11111",
     * )
     *
     * @Serialization\Type("string")
     */
    public $autoVin;

    /**
     * @OA\Property(
     *     format="string",
     *     title="agent_id",
     *     description="agent_id",
     *     example="",
     * )
     *
     * @Serialization\Type("string")
     */
    public $agent_id;

    /**
     * @OA\Property(
     *     format="string",
     *     title="marks",
     *     description="marks",
     *     example="Увеличенная цена полиса за счет показателей системы",
     * )
     *
     * @Serialization\Type("string")
     */
    public $marks;



    /**
     * @OA\Property(
     *     format="string",
     *     title="driver_one",
     *     description="driver_one",
     *     example="12345",
     * )
     *
     * @Serialization\Type("string")
     */
    public $driver_one;

    /**
     * @OA\Property(
     *     format="string",
     *     title="driver_two",
     *     description="driver_two",
     *     example="123456",
     * )
     *
     * @Serialization\Type("string")
     */
    public $driver_two;

    /**
     * @OA\Property(
     *     format="string",
     *     title="driver_three",
     *     description="driver_three",
     *     example="",
     * )
     *
     * @Serialization\Type("string")
     */
    public $driver_three;

    /**
     * @OA\Property(
     *     format="string",
     *     title="driver_four",
     *     description="driver_four",
     *     example="",
     * )
     *
     * @Serialization\Type("string")
     */
    public $driver_four;


    /**
     * @OA\Property(
     *     format="string",
     *     title="date_start_one",
     *     description="date_start_one",
     *     example="2021-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_start_one;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_end_one",
     *     description="date_end_one",
     *     example="2022-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_end_one;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_start_two",
     *     description="date_start_two",
     *     example="2021-04-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_start_two;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_end_two",
     *     description="date_end_two",
     *     example="2021-10-13 00:00:00",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_end_two;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_start_three",
     *     description="date_start_three",
     *     example="null",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_start_three;

    /**
     * @OA\Property(
     *     format="string",
     *     title="date_end_three",
     *     description="date_end_three",
     *     example="null",
     * )
     *
     * @Serialization\Type("string")
     */
    public $date_end_three;
}
