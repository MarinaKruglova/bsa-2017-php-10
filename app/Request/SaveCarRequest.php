<?php

namespace App\Request;

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Request\Contract\SaveCarRequest as SaveCarRequestContract;

class SaveCarRequest extends FormRequest implements SaveCarRequestContract
{
    protected $car = null;
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model' => 'required|max:255',
            'year' => 'required|integer|between:1000,'.date('Y'),
            'registration_number' => 'required|alpha_num|size:6',
            'color' => 'required|alpha|max:255',
            'price' => 'required|numeric|min:1'
        ];
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
        $userId = (int)$this->request->user;
        return User::find($userId) ?: new User;
    }
}