<div>
    <section class="second-header p-4">
        <h3 class="text-center">Welcome to our store</h3>
    </section>
    <div class="container mt-5">
        @if(Cart::instance('cart')->count() > 0)
        <div class="row text-white">
            <div class="col-4">
                <h3 class='text-white'>Shopping Cart</h3>
                <h6 class='fs-6'>Back to Store</h6>
                <div class="row">
                    @foreach(Cart::instance('cart')->content() as $product)
                        <div class="col-md-12 cart-items">
                            <div class="card text-white bg-dark mb-2" style="max-width: 400px;height: 90px">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{ $product->model->image }}" class="img-fluid rounded-start"
                                             alt="item image" width="90" height="90">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <a wire:click.prevent="removeFromCart('{{ $product->rowId }}')" class="btn btn-sm btn-outline-danger float-end"><i class="fa fa-times fa-sm"></i></a>
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <div class="card-text">
                                                <small>
                                                    <select name="product-qty" data-rowid="{{ $product->rowId }}">
                                                        @for($i=1;$i<=20;$i++)
                                                            <option
                                                                {{ $product->qty == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </small>
                                                <small class="float-end">
                                                    £{{ $product->subtotal() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr class='w-100'>
                    <div class="row">
                        <div class="col-6">
                            <p>Subtotal </p>
                            <p>Estimated shipping </p>
                            <p><strong>TOTAL</strong> </p>
                        </div>
                        <div class="col-4 offset-2">
                            <p>£{{ Cart::instance('cart')->subtotal() }}</p>
                            <p>£{{ Cart::instance('cart')->tax() }}</p>
                            <p><strong>£{{ Cart::instance('cart')->total() }}</strong></p>
                        </div>
                        <small>Looking for more? <a class="continue-shopping" href="{{ route('store') }}">Continue shopping</a></small>
                    </div>
                </div>
            </div>

            <div class="col-6 offset-2">
                <h3>CheckOut</h3>
                <i class="far fa-check-circle fa-2x"></i>
                <span>Email</span>
                <hr>

                <h4>Shipping & Delivery</h4>
                <h6>Enter your shipping address. All fields are required unless they're explicitly marked as
                    optional.</h6>


                <label class="col-2 form-label">Country</label>
                <input type="text" class="mb-2 form-control">

                <div class="row">
                    <div class="col-8">
                        <label class="form-label">Full Name</label>
                        <input type="text" aria-label="First name" class="form-control">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Phone</label>
                        <input type="text" aria-label="Last name" class="form-control">
                    </div>
                </div>

                <label class="col-2 form-label">Address</label>
                <input type="text" class="mb-2 form-control" placeholder="Full Address">

                <div class="row">
                    <div class="col-8">
                        <input type="text" aria-label="First name" class="form-control" placeholder="city">
                    </div>
                    <div class="col-4">
                        <input type="text" aria-label="Last name" class="form-control" placeholder="postal code">
                    </div>
                </div>
                <select name="province" id="" class='w-100 mt-2'>
                    <option value="">cairo</option>
                    <option value="">Egypt</option>
                </select>
                <input type="submit" aria-label="First name" class="btn btn-outline-secondary mt-2 form-control">


                <div class='mt-3'>Next</div>

                <hr>
                <div class='info-small'>Delivery information</div>
                <span class='info-micro'>Specify your details to choose a shipping method.</span>
                <div class='mt-3 info-small'>Payment information</div>
                <span class='info-micro'>Choose a payment method and enter your credentials.</span>
            </div>
        </div>
            @livewire('partials.products-may-also-like', ['products' => Cart::instance('cart')->content()->pluck('id')])
        @else
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
            <div class="row text-center">
                <strong><small>Your shopping Cart is empty</small></strong>
                <div class="col mt-2">
                <a class="btn btn-outline-warning" href="{{ route('store') }}">Browse Store</a>
                </div>
            </div>
        @endif
    </div>
</div>
@push('scripts')
    <script>
        $(function(){
            $('select[name=product-qty]').on('change', function(){
                @this.set('qty', $(this).val());
                livewire.emit('updateCartQty', $(this).data('rowid'));
            })
        });
    </script>
@endpush
