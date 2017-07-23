<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;

use App\Entity\Car;
use App\Entity\User;
use App\Manager\CarManager;
use App\Manager\UserManager;
use App\Request\SaveCarFormRequest;
use App\Request\SaveCarRequest;

class CarController extends Controller
{

    private $carManager;

    public function __construct(CarManager $carManager)
    {
        $this->carManager = $carManager;
    }

    public function showItemsIndex()
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

    public function showItem(int $id) {
        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            return response()->json($car);
        } else {
            return response()->json(['error' => "No car with id $id"], 404);
        }
    }

    public function index()
    {
        if (Gate::allows('viewAPI', 'App\Entity\Car')) {
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
        } else {
            return response()->json(['error' => "No admin access you have"], 403);
        }
    }

    public function show(int $id)
    {
        $car = $this->carManager->findById($id);
        if (Gate::allows('viewAPI', $car)) {

            if (!is_null($car)) {

                return response()->json($car);
            } else {

                return response()->json(['error' => "No car with id $id"], 404);
            }
        } else {

            return response()->json(['error' => "No admin access you have"], 403);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('edit', 'App\Entity\Car')) {
            $car = new Car();
            $carData = new SaveCarRequest($request);

            return response()->json($this->carManager->saveCar($carData));

        } else {

            return response()->json(['error' => "No admin access you have"], 403);
        }
    }

    public function update(Request $request, int $id)
    {
        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            if (Gate::allows('edit', $car)) {
                $carData = new SaveCarRequest($request);
                $carData->setCar($car);
                $this->carManager->saveCar($carData);

                return response()->json($car);
            } else {
                return response()->json(['error' => "No admin access you have"], 403);
            }
        } else {
            return response()->json(['error' => "No car with id $id"], 404);
        }
    }

    public function destroy(int $id)
    {
        $car = $this->carManager->findById($id);

        if (Gate::allows('delete', $car)) {
            if (!is_null($car)) {
                $this->carManager->deleteCar($id);
                return response()->json(['status' => "Car with id $id was distroed"], 200);
            } else {
                return response()->json(['error' => "No car with id $id"], 404);
            }
        } else {
            return response()->json(['error' => "No admin access you have"], 403);
        }
    }
}
