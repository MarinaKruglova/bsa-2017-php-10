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
use App\Manager\UserManager;
use App\Request\SaveCarFormRequest;
use App\Request\SaveCarRequest;

class CarController extends Controller
{

    private $carManager;
    private $userManager;

    public function __construct(CarManager $carManager, UserManager $userManager)
    {
        $this->carManager = $carManager;
        $this->userManager = $userManager;
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
        $car = new Car();

        if (Gate::allows('create', $car)) {
            return view('cars/create');
        } else {
            return redirect('/');
        }
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

            return view('cars/show', ['car' => $car]);
        } else {

            return view('errors/404');
        }
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

        if (Gate::allows('edit', $car)) {

            return view('cars/edit', ['car' => $car]);
        } else {

            return redirect('/');
        }
    }

    /**
     * Update item values
     *
     * @param SaveCarFormRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function update(SaveCarFormRequest $request, int $id)
    {
        $car = $this->carManager->findById($id);

        if (!is_null($car)) {
            if (Gate::allows('edit', $car)) {
                $carData = new SaveCarRequest($request);
                $carData->setCar($car);
                $this->carManager->saveCar($carData);

                return view('cars/show', ['car' => $car]);
            } else {
                return redirect('/');
            }
        } else {
            return view('errors/404');
        }
    }

    /**
     * Update item values
     *
     * @param SaveCarFormRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(SaveCarFormRequest $request)
    {

        $car = new Car();
        $carData = new SaveCarRequest($request);
        $this->carManager->saveCar($carData);

        $cars = $this->carManager->findAll();

        return view('cars/index', ['cars' => $this->carManager->findAll()]);
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

        if (!is_null($car)) {
            if (Gate::allows('delete', $car)) {
                $this->carManager->deleteCar($id);

                return redirect()->route('cars-list');
            } else {

                return redirect('/');
            }
        } else {

            return view('errors/404');
        }
    }
}
