<x-base-layout>
    <x-slot name="title">Forget Password</x-slot>
    <section class="second-header p-4">
        <h3 class="text-center">Forget Password</h3>
    </section>
    <section class="login py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 section-login-left">
                            <h1 class="page-title">Forget password</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Forgot-password</li>
                                </ol>
                            </nav>
                            <p>Forgot your password? No problem. Just let us know your email address and we will email
                                you a password reset link that will allow you to choose a new one.</p>
                        </div>
                        <div class="col-sm-6 section-login-right">
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 text-success fw-bold">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <x-jet-validation-errors class="mb-4 text-danger"/>

                            <form class="mt-5" method="POST" action="{{ route('password.email') }}">
                            @csrf
                                <input type="email" class="form-control mb-2 bg-dark text-light" name="email" placeholder="enter your email address" value="{{ old('email') }}" required autofocus>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-outline-stefra">Email Password Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-base-layout>
