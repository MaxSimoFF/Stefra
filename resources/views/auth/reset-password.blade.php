<x-base-layout>
    <x-slot name="title">Reset Password</x-slot>
    <section class="second-header p-4">
        <h3 class="text-center">Reset Password</h3>
    </section>
    <section class="login py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="row">
                        <div class="col-sm-6 section-login-left">
                            <h1 class="page-title">Reset password</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('store') }}">Store</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">reset-password</li>
                                </ol>
                            </nav>
                            <p>Enter your new password, confirm it and click on reset password to apply changes</p>
                        </div>
                        <div class="col-sm-6 section-login-right">
                            <x-jet-validation-errors class="mb-4 text-danger"/>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <input type="email" class="form-control bg-dark text-light mb-2" placeholder="enter your email"
                                       name="email" value="{{ old('email', $request->email) }}" required autofocus>
                                <input type="password" class="form-control bg-dark text-light mb-2" placeholder="enter your new Password"
                                       name="password" required autocomplete="new-password">
                                <input type="password" class="form-control bg-dark text-light mb-2"
                                       placeholder="Confirm your new password" name="password_confirmation" required
                                       autocomplete="new-password">
                                <div class="d-grid gap-2 mt-2">
                                    <button class="btn btn-outline-stefra" type="submit">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-base-layout>
{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        <form method="POST" action="{{ route('password.update') }}">--}}
{{--            @csrf--}}

{{--            <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--            <div class="block">--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
{{--                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-jet-button>--}}
{{--                    {{ __('Reset Password') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
