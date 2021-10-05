<x-base-layout>

    <x-slot name="title">Login</x-slot>
    <section class="second-header p-4">
        <h3 class="text-center">Login to Our store</h3>
    </section>

    <section class="login py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 section-login-left">
                            <h1 class="page-title">sign in</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Login</li>
                                </ol>
                            </nav>
                            <p>Track your future orders, checkout faster, and sync your favorites. Just enter your email
                                and we’ll send you a special link that will sign you in instantly.</p>
                        </div>
                        <div class="col-sm-6 section-login-right">
                            <x-jet-validation-errors class="mb-4 text-danger"/>
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 text-success fw-bold">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="mt-5" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="email" class="form-control bg-dark text-light mb-2" placeholder="enter your email"
                                       name="email" value="{{ old('email') }}" required autofocus>
                                <input type="password" class="form-control bg-dark text-light mb-2" placeholder="enter your Password"
                                       name="password" required autocomplete="current-password">
                                <div class="overflow-hidden">
                                    <label for="remember_me" class="align-middle">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        Remember me</label>
                                    <button class="btn btn-lg float-end btn-outline-stefra" type="submit">Log in
                                    </button>
                                </div>
                                <div>
                                    @if (Route::has('password.request'))
                                        Forgot your password?
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                       href="{{ route('password.request') }}">
                                        click here
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-base-layout>
