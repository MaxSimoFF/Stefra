<div class="container mt-5 text-white">
    <div class="row">
        <div class='col-8 offset-2'>
            <h1>How to Contact Us</h1>
        </div>
    </div>
    <div class="row">
        <div class='col-8 offset-2'>
            <h6 class='mb-5'> If you have any questions about our offer, please contact us by filling out the form below
                and we will get in touch with you shortly. Alternatively, you can give us a call.
            </h6>
        </div>
    </div>
    <div class='text-center'>
        <iframe class="map-frame"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2973.3688918579574!2d-0.4126013428936616!3d51.32796217675668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875df9827ef99cf%3A0xc715f943c9a4eb0e!2sHigh%20St%2C%20Oakdene%20Parade%2C%20Cobham%20KT11%202LR%2C%20UK!5e0!3m2!1sen!2seg!4v1632569443862!5m2!1sen!2seg"
                width="900" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <section class="mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Where to Find Us</h3>
                        <p>High Street, Cobham, KT11 2LR, United Kingdom</p>

                        <h3>Business Hours</h3>
                        <div class="row">
                            <div class="col-6">
                                <h6>Mon - Fri</h6>
                                <h6>Saturday9</h6>
                                <h6>Sunday</h6>
                            </div>
                            <div class="col-6">
                                <h6>9:00 - 17:00</h6>
                                <h6>9:00 - 14:00</h6>
                                <h6>Closed</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class='mb-5'>Send Us a Message</h3>
                        <form wire:submit.prevent="sendMessage">
                            <div class="row mb-3">
                                <label for="contact-name" class="col-2 col-form-label">Name:</label>
                                <div class='col-8 col-sm-10'>
                                    <input id="contact-name" type="text" placeholder="enter Your name" wire:model.debounce.500ms="name"
                                           class="@error('name') is-invalid @enderror form-control bg-dark text-light">
                                </div>
                                @error('name') <span class="text-danger offset-2">{{ $message }}</span> @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="contact-email" class="col-2 col-form-label">Email:</label>
                                <div class='col-8 col-sm-10'>
                                    <input id="contact-email" type="email" placeholder="name@example.com"
                                           class="@error('email') is-invalid @enderror form-control bg-dark text-light"
                                           wire:model.debounce.500ms="email">
                                </div>
                                @error('email') <span class="text-danger offset-2">{{ $message }}</span> @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="contact-phone" class="col-2 col-form-label">Phone:</label>
                                <div class='col-8 col-sm-10'>
                                    <input type="tel" id="contact-phone" placeholder="enter your phone number ( optional )"
                                           class="@error('phone') is-invalid @enderror form-control bg-dark text-light"
                                           wire:model.debounce.500ms="phone">
                                </div>
                                @error('phone') <span class="text-danger offset-2">{{ $message }}</span> @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="contact-message" class="col-2 col-form-label">Message</label>
                                <div class='col-8 col-sm-10'>
                                    <textarea id="contact-message" rows="3" placeholder="enter your message"
                                              class="@error('message') is-invalid @enderror form-control bg-dark text-light"
                                              wire:model.debounce.500ms="message"></textarea>
                                </div>
                                @error('message') <span class="text-danger offset-2">{{ $message }}</span> @enderror
                            </div>
                            <button class="btn btn-lg btn-outline-secondary col-8 col-sm-10 offset-2" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
