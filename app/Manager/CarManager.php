<?php

namespace App\Manager;

use App\Entity\Car;
use Illuminate\Support\Collection;
use App\Request\Contract\SaveCarRequest;
use App\Manager\Contract\CarManager as CarManagerContract;

class CarManager implements CarManagerContract
{
    public function findAll(): Collection
    {
        return Car::all();
    }

    public function findById(int $id)
    {
        return Car::find($id) ?? null;
    }


    public function findCarsFromActiveUsers(): Collection
    {
        return Car::whereHas('user', function ($query)
        {
            $query->where('is_active', true);
        })->get();
    }

    public function saveCar(SaveCarRequest $request): Car
    {
        $car = $request->getCar();

        $car->color = $request->getColor();
        $car->model = $request->getModel();
        $car->registration_number = $request->getRegistrationNumber();
        $car->year = $request->getYear();
        $car->mileage = $request->getMileage();
        $car->price = $request->getPrice();
        $car->user_id = $request->getUser()->id;
        $car->save();

        return $car;
    }

    public function deleteCar(int $id)
    {
        $car = $this->findById($id);
        if ($car !== null) {
            $car->delete();
        } else {
            return false;
        }
    }
}