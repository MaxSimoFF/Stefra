<x-base-layout>

    <x-slot name="title">Register</x-slot>
    <section class="second-header p-4">
        <h3 class="text-center">Sign up to our store</h3>
    </section>

    <section class="login py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 section-login-left">
                            <h1 class="page-title">Join us</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                                </ol>
                            </nav>
                            <p>Track your future orders, checkout faster, and sync your favorites Just sign up with
                                us.</p>
                        </div>
                        <div class="col-sm-6 section-login-right">
                            <x-jet-validation-errors class="mb-4 text-danger"/>
                            <form class="mt-5" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="name" class="form-control bg-dark text-light mb-2" placeholder="enter your name"
                                       name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                <input type="email" class="form-control bg-dark text-light mb-2" placeholder="enter your email"
                                       name="email" value="{{ old('email') }}" required>
                                <input type="password" class="form-control bg-dark text-light mb-2" placeholder="enter your password"
                                       name="password" required
                                       autocomplete="new-password">
                                <input type="password" class="form-control bg-dark text-light mb-2"
                                       placeholder="Confirm your password"
                                       name="password_confirmation" required
                                       autocomplete="new-password">
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mb-1">
                                        <label class="text-16" for="terms">
                                            <input type="checkbox" name="terms" id="terms">
                                            I agree to the <a target="_blank" href="{{ route('terms.show') }}">Terms of
                                                Service</a> and <a target="_blank" href="{{ route('policy.show') }}">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                @endif

                                <div class="d-grid gap-2 mt-2">
                                    <button class="btn btn-outline-stefra" type="submit">Register</button>
                                </div>
                                <div class="mt-3">Already registered? <a href="{{ route('login') }}">click here</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-base-layout>
