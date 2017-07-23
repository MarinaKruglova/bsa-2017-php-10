<li class="media my-4">
    <div class="media-body">
        <h5 class="mt-0 mb-1"><a href="{{ route('car-show', ['id' => $car['id']]) }}">{{ $car['model'] }}</a></h5>
        <p>Color: {{ $car['color'] }}</p>
        <p>Price: {{ $car['price'] }}</p>
    </div>
</li>