<div class="container text-white mt-5">
    <div class="row">
        <div class="col-6">
            <div>
                <h3>Account</h3>
                <p>
                    <span>Store</span>
                    <span> / Account</span>
                </p>

                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-user-circle fa-2x"></i>

                    </div>
                    <div class="col-5">
                        <div>{{ Auth::user()->name }}</div>
                        <span>{{ Auth::user()->email }}</span>
                        <span class='text-warning'>Edit</span>
                    </div>
                </div>
            </div>
            <hr class='w-75'>


            <h5 class='text-white'>Shopping Cart</h5>

            <div class="row">
                @if(Cart::instance('cart')->count() > 0)
                @foreach(Cart::instance('cart')->content() as $product)
                    <div class="col-md-12 cart-items">
                        <div class="card text-white bg-dark mb-2" style="max-width: 400px;height: 90px">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <a href="{{ route('product', $product->model->slug) }}">
                                    <img src="{{ $product->model->image }}" class="img-fluid rounded-start"
                                         alt="item image" width="90" height="90">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <a wire:click.prevent="removeFromCart('{{ $product->rowId }}')"
                                           class="btn btn-sm btn-outline-danger float-end"><i
                                                class="fa fa-times fa-sm"></i></a>
                                        <h5 class="card-title"><a href="{{ route('product', $product->model->slug) }}">
                                            {{ $product->name }}
                                            </a></h5>
                                        <div class="card-text">
                                            <small class="float-end">
                                                £{{ $product->subtotal() }}
                                            </small>
                                            <div class="row">
                                                <span class="col">{{ $product->qty }}</span>
                                                <small class="col-md-9 text-truncate">
                                                    {{ $product->model->desc }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <small class="ps-md-4">Your cart is empty? <strong><a href="{{ route('store') }}"> Shop Now</a></strong></small>
                @endif
            </div>


            <div class='fs-5 mt-3'>Legal</div>

            <div class='info-microX2 brown'>Terms and Conditions</div>
            <div class='info-microX2 brown'>Return Policy</div>
            <div class='info-microX2 brown'>Shipping & Payment Info</div>
            <div class='info-microX2 brown'>Privacy Policy</div>

            <hr class='w-75'>


        </div>

        <div class="col-6">
            <h3>Orders</h3>
            <div class='info-microX2'>You don't have any orders yet. Once you've placed one, you'll find it here.
                <span><strong><a class='brown' href="{{ route('store') }}">Start Shopping</a></strong></span>
            </div>

            <h5 class='mt-5'>Have questions? Contact us</h5>

            <div class='info-microX2'>Phone: 07889060031</div>
            <div><span class='info-mini'>Email:</span> <span class='info-mini brown'>info@stickos.co.uk</span></div>
        </div>
    </div>
{{--    <div class="row justify-content-center mt-5 text-light">--}}
{{--        <div class="col-2">--}}
{{--            <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i>--}}
{{--                <span>My Account</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-2">--}}
{{--            <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i>--}}
{{--                <span>Shopping Bag(1)</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-2">--}}
{{--            <a href="#"><i class="fas fa-sign-out-alt"></i>--}}
{{--                <span>Sign Out</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
    @livewire('partials.cart-count')
