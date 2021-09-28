@foreach ($watchlists as $watchlist)
    {{$watchlist->name}}<br>
    <ul>
        @foreach ($watchlist->products as $product)
            <li>{{ $product->name }} . {{ $product->manufacturer_sku }}</li>
            Sold at:
                <ul>
                    @foreach($product->retailers as $retailer)
                        <li>{{ $retailer->name }}</li>
                    @endforeach
                </ul>
        @endforeach
    </ul>
@endforeach