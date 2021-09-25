<div class="container mt-5">
    <div class="row">
        @foreach($products as $product)
            <div class="col-4 mb-3">
                <div class='products-content'>
                    <img src="{{ asset($product->image) }}" alt="">
                    <div class='background-products-desc'>
                        <div class='products-desc'>
                            <h1 class='mb-5'><a href="#">{{ $product->name }}</a></h1>
                            <p>{{ $product->desc }}</p>
                            <a href="#">Read More
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 8">
                                    <defs></defs>
                                    <path
                                        d="M15.3536 4.35355c.1952-.19526.1952-.51184 0-.7071L12.1716.464466c-.1953-.195262-.5119-.195262-.7071 0-.1953.195262-.1953.511845 0 .707104L14.2929 4l-2.8284 2.82843c-.1953.19526-.1953.51184 0 .7071.1952.19527.5118.19527.7071 0l3.182-3.18198zM0 4.5h15v-1H0v1z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <span class='span-top'></span>
                            <span class='span-bottom'></span>
                            <span class='span-right'></span>
                            <span class='span-left'></span>

                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
