@extends('cars.layout.base')

@section('title', 'Edit '.$car['model'])

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('car-update', ['id' => $car['id']]) }}" novalidate>
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                    <label for="model" class="col-md-4 control-label">Model</label>

                    <div class="col-md-6">
                        <input id="model" type="text" class="form-control" name="model" value="{{ old('model') ?? $car['model'] }}" required autofocus>

                        @if ($errors->has('model'))
                            <span class="help-block">{{ $errors->first('model') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                    <label for="year" class="col-md-4 control-label">Year</label>

                    <div class="col-md-6">
                        <input id="year" type="text" class="form-control" name="year" value="{{ old('year') ?? $car['year'] }}" required autofocus>

                        @if ($errors->has('year'))
                            <span class="help-block">{{ $errors->first('year') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('registration_number') ? ' has-error' : '' }}">
                    <label for="registration_number" class="col-md-4 control-label">Registration number</label>

                    <div class="col-md-6">
                        <input id="registration_number" type="text" class="form-control" name="registration_number" value="{{ old('registration_number') ?? $car['registration_number'] }}" required autofocus>

                        @if ($errors->has('registration_number'))
                            <span class="help-block">{{ $errors->first('registration_number') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                    <label for="color" class="col-md-4 control-label">Color</label>

                    <div class="col-md-6">
                        <input id="color" type="text" class="form-control" name="color" value="{{ old('color') ?? $car['color'] }}" required autofocus>

                        @if ($errors->has('color'))
                            <span class="help-block">{{ $errors->first('color') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Price</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price') ?? $car['price'] }}" required autofocus>

                        @if ($errors->has('price'))
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection