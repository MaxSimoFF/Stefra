<div>
    <section class="second-header p-4">
        <h3 class="text-center">Welcome to our store</h3>
    </section>
    <section class="category-store pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-6">
                                <a href="{{ route('category', $category->slug) }}">
                                    <img width="300" height="300" src="{{ asset($category->image) }}" alt="category">
                                    <p>{{ $category->name }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @livewire('partials.cart-count')
        </div>
    </section>
</div>
