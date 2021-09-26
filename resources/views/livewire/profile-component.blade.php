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
                        <div>Email</div>
                        <span>xyz@gmail.com</span>
                        <span class='text-warning'>Edit</span>
                    </div>
                </div>
            </div>
            <hr class='w-75'>


            <h5 class='text-white'>Shooping Cart</h5>

            <div class="row">
                <div class="col-2">
                    <img src="assets/images/products/stickOS Drive-64GB.png" width='50' height='50' alt="">

                </div>
                <div class="col-3">
                    <span>1 item (10$)</span>
                    <p><a href='#'>got to Checkout</a></p>
                </div>
            </div>

            <div class='fs-5 mt-3'>Legal</div>

            <div class='info-microX2 brown'>Terms and Conditions</div>
            <div class='info-microX2 brown'>Return Policy</div>
            <div class='info-microX2 brown'>Shipping & Payment Info</div>
            <div class='info-microX2 brown'>Privacy Policy</div>

            <hr class='w-75'>


            <div>Have another account?
                <span><a class='brown' href="#">Sign Out</a></span>
            </div>

        </div>

        <div class="col-6">
            <h3>Orders</h3>
            <div class='info-microX2'>You don't have any orders yet. Once you've placed one, you'll find it here.
                <span><a class='brown' href="#">Start Shopping</a></span>
            </div>

            <h5 class='mt-5'>Have questions? Contact us</h5>

            <div class='info-microX2'>Phone: 07889060031</div>
            <div> <span class='info-mini'>Email:</span> <span class='info-mini brown'>info@stickos.co.uk</span></div>
        </div>
    </div>
    <div class="row justify-content-center mt-5 text-light">
        <div class="col-2">
            <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i>
                <span>My Account</span>
            </a>
        </div>
        <div class="col-2">
            <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i>
                <span>Shopping Bag(1)</span>
            </a>
        </div>
        <div class="col-2">
            <a href="#"><i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </div>
    </div>
