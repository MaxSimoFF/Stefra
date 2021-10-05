<div class="row">
    <h3 class='text-secondary mb-5'>You May Also Like</h3>
    <div class="col-10 m-auto">
        <div class="row text-center may-likes-items">
            @foreach($mayLikesItems as $item)
                @if($products)
                    @if(!in_array($item->id, $products->toArray()))
                        <div class="col-md-3">
                            <a href="{{ route('product', $item->slug) }}">
                                <img width="100" height="100" src="{{ asset($item->image) }}" alt="item image">
                                <div>
                                    <div>{{ $item->name }}</div>
                                    <div>£{{ $item->price }}</div>
                                </div>
                            </a>
                        </div>
                    @endif
                @else
                    @if($item->id !== $product->id)
                        <div class="col">
                            <a href="{{ route('product', $item->slug) }}">
                                <img width='100' src="{{ asset($item->image) }}" alt="item image">
                                <div>
                                    <div>{{ $item->name }}</div>
                                    <div>£{{ $item->price }}</div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
