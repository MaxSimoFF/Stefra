<div class="row justify-content-center mt-5 text-light cart-count-component">
    <div class="col-2">
        <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i>
            <span>My Account</span>
        </a>
    </div>
    <div class="col-2">
        <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i>
            <span>Shopping Bag({{ Cart::instance('cart')->count() }})</span>
        </a>
    </div>
    <div class="col-2">
        <a href="#"><i class="fas fa-sign-out-alt"></i>
            <span>Sign Out</span>
        </a>
    </div>
</div>
