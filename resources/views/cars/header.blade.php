<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('cars-list') }}">Cars list</a>
            </li>
            @can('create', App\Entity\Car::class)
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('car-form') }}">Add car</a>
            </li>
            @endcan
        </ul>
    </div>
</nav>
