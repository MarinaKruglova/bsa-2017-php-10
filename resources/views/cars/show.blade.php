@extends('cars.layout.base')

@section('title', $car['model'])

@section('content')
    <div class="row">
        <div class="col-md-12 main">
            <div class="card mb-3">
                <div class="card-block">
                    <h4 class="card-title">{{ $car['model'] }}</h4>
                    <p class="card-text">
                        <ul>
                            <li>Model: {{ $car['model'] }}</li>
                            <li>Year: {{ $car['year'] }}</li>
                            <li>Registration number: {{ $car['registration_number'] }}</li>
                            <li>Color: {{ $car['color'] }}</li>
                            <li>Price: {{ $car['price'] }}</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-success edit-button" href="{{ route('car-edit', ['id' => $car['id']]) }}">Edit</a>
                    <a href="{{ route('cars-list') }}" class="btn btn-danger delete-button">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection