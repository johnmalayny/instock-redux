@foreach ($watchlists as $watchlist)
    {{$watchlist->name}}<br>
    <ul>
        @foreach ($watchlist->products as $product)
            <li>{{ $product->name }} . {{ $product->manufacturer_sku }}</li>
        @endforeach
    </ul>
@endforeach