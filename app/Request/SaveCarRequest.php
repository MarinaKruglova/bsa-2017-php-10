<?php

namespace App\Request;

use App\Entity\Car;
use App\Entity\User;
use App\Request\Contract\SaveCarRequest as SaveCarRequestContract;
use Illuminate\Http\Request;

class SaveCarRequest implements SaveCarRequestContract
{
    protected $car = null;
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car ?: new Car();
    }

    /**
     * @param Car $car
     */
    public function setCar(Car $car)
    {
        $this->car = $car;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->request->color;
    }

    /**
     * @return string|null
     */
    public function getModel()
    {
        return $this->request->model;
    }

    /**
     * @return string|null
     */
    public function getRegistrationNumber()
    {
        return $this->request->registration_number;
    }

    /**
     * @return int|null
     */
    public function getYear()
    {
        return $this->request->year;
    }

    /**
     * @return float|null
     */
    public function getMileage()
    {
        return $this->request->mileage;
    }

    /**
     * @return float|null
     */
    public function getPrice()
    {
        return $this->request->price;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        $id = (int)$this->request->user;
        return User::find($id) ?: new User;
    }
}