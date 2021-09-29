<div class="product-page">
    <section class="second-header p-4 mb-3">
        <h3 class="text-center">Welcome to our store</h3>
    </section>
    <div class="container text-white">
        <nav aria-label="breadcrumb" class="">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-8">
                <img width='600' src="{{ asset($product->image) }}" alt="item image">
            </div>

            <div class="col-md-4">
                <h5>{{ $product->name }}</h5>
                <h6>£{{ $product->price }}</h6>
                <div>Quantity : <input type="number" value="1" wire:model="qty"></div>
                @if(in_array($product->id, Cart::instance('cart')->content()->pluck('id')->toArray()))
                    <button wire:click="addToCart" type="button" class='btn btn-outline-danger form-control w-75 mt-3'>
                        Add More
                    </button>
                    <a href="{{ route('cart') }}" wire:click="addToCart" class='btn btn-outline-danger form-control w-75 mt-2'>
                        Go to Checkout
                    </a>
                @else
                    <button wire:click="addToCart" type="button" class='btn btn-outline-danger form-control w-75 mt-3'>
                        Add to Bag
                    </button>
                @endif


                <h5 class='mt-5'>Description</h5>
                <p class='info-small'>{!! $product->desc !!}</p>

                <h5 class='mt-5'>Details</h5>
                {{--            {!! $product->details !!}--}}
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> Intel Atom z8350 Quad-Core CPU</i>
                </div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> 8GB RAM</i></div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> Intel HD Graphic</i></div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> 128GB Storage</i></div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> 2.4GHz/5GHz Dual-Band
                        Wifi+Bluetooth</i>
                </div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> USB 3.0 - USB 2.0 - MicroSD Slot</i>
                </div>
                <div><i class="mt-2 info-small text-secondary far fa-dot-circle"> stickOS System: Easy to use system
                        with
                        user friendly interface</i></div>


                <div class="mt-3 brown">Share this product with your friends</div>

                <a class='' href="#"><i class="fab fa-facebook"> Share</i></a>
                <a class='' class='' href="#"><i class="ms-3 fab fa-twitter-square"> Tweet</i></a>
                <a class='' href="#"><i class="ms-3 fab fa-pinterest-square"> Pin it</i></a>


            </div>
        </div>
        <div class="mt-5">
            @livewire('partials.products-may-also-like', ['product' => $product])
        </div>
        <div class="mt-5">
            @livewire('partials.cart-count')
        </div>
    </div>
</div>
