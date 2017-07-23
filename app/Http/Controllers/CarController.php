<?php
namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Gate;

use App\Entity\Car;
use App\Entity\User;
use App\Manager\CarManager;
use App\Request\Contract\SaveCarRequest;


class CarController extends Controller
{

    private $carManager;

    public function __construct(CarManager $carManager)
    {
        $this->carManager = $carManager;
    }

    /**
     * Show list of items from repository
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        return view('cars/index', ['cars' => $carsFiltered]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cars/create');
    }

    /**
     * Show specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            $response = view('cars/show', ['car' => $car->toArray()]);
        } else {
            $response = view('errors/404');
        }

        return $response;
    }

    /**
     * edit specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $car = $this->carManager->findById($id);

        return view('cars/edit', ['car' => $car->toArray()]);
    }

    /**
     * Update item values
     *
     * @param ValidateCarRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function update(SaveCarRequest $request, int $id)
    {
        $this->validate($request, [
            'model' => 'required|max:255',
            'year' => 'required|integer|between:1000,'.date('Y'),
            'registration_number' => 'required|alpha_num|size:6',
            'color' => 'required|alpha|max:255',
            'price' => 'required|numeric|min:1'
        ]);

        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            $this->carManager->saveCar($request);

            return view('cars/show', ['car' => $car]);
        } else {
            return view('errors/404');
        }
    }

    /**
     * Update item values
     *
     * @param ValidateCarRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(SaveCarRequest $request)
    {
        $requiredFields = $request->only([
            'model', 'year', 'registration_number', 'color', 'price'
        ]);
        
        $newCar = new Car($requiredFields);
        $this->carManager->store($newCar);

        $cars = $this->carManager->getAll();

        return view('cars/index', ['cars' => $cars->toArray()]);
    }

    /**
     * destroy specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(int $id)
    {
        $car = $this->carManager->findById($id);
        $collection = $this->carManager->delete($id);
        if (!is_null($car)) {
            $response = view('cars/index', ['cars' => $cars->toArray()]);
        } else {
            $response = view('errors/404');
        }

        return $response;
    }
}
