<div class="row justify-content-center mt-5 text-light cart-count-component">
    <div class="col-md-2">
        @auth
        <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i>
            <span>My Account</span>
        </a>
        @else

        @endauth
    </div>
    <div class="col-md-2">
        <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i>
            <span>Shopping Bag({{ Cart::instance('cart')->count() }})</span>
        </a>
    </div>
    <div class="col-md-2">
        @auth
            <form class="formLogoutUser" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a href="javascript:void(0)" onclick="document.querySelector('.formLogoutUser').submit()"><i
                    class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        @else
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                <span>Sign in</span>
            </a>
        @endauth
    </div>
</div>
