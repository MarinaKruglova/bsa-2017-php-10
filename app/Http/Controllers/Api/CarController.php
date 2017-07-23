<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Manager\CarManager;

class CarController extends Controller
{

    private $carManager;

    public function __construct(CarManager $carManager)
    {
        $this->carManager = $carManager;
    }

    public function index()
    {
        $cars = $this->carManager->findAll();
        $carsFiltered = array();

        foreach ($cars as $car) {
            array_push($carsFiltered, [
                'color' => $car->color,
                'id' => $car->id,
                'model' => $car->model,
                'year' => $car->year,
                'price' => $car->price
            ]);
        }

        return response()->json($carsFiltered);
    }

    public function store(SaveCarRequest $request)
    {
        $newCar = new Car($request->all());
        return response()->json($this->carManager->store($newCar));
    }

    public function show(int $id)
    {
        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            return response()->json($car);
        } else {
            return response()->json(['error' => "No car with id $id"], 404);
        }
    }

    public function update(SaveCarRequest $request, int $id)
    {
        $car = $this->carManager->getById($id);
        if ($car) {
            $car->fromArray($request->all());
        }
        
        if (!is_null($car)) {
            return response()->json($car);
        } else {
            return response()->json(['error' => "No car with id $id"], 404);
        }
    }

    public function destroy(int $id)
    {
        $car = $this->carManager->getById($id);
        $collection = $this->carManager->delete($id);
        if (!is_null($car)) {
            return $collection;
        } else {
            return response()->json(['error' => "No car with id $id"], 404);
        }
    }
}
