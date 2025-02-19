<?php 
 require "top.php";
?> 

<!-- home slider -->
<section class="home_slider mt-4 px-lg-4">
    <div class="container-fluid">
        <div class="swiper homeSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="assets/images/home-slider/1.jpg"/>
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/home-slider/2.jpg"/>
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/home-slider/3.jpg"/>
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/home-slider/4.jpg"/>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var swiper = new Swiper(".homeSlider", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: 
        {
            delay: 3500
        }
    });
</script>

<!-- check ability -->
<section class="check_ability">
    <div class="container">
        <div class="bg-white shadow p-4 rounded">
            <h1 class="mb-4 fs-5" style="font-weight: 500;">Check Booking Availability</h1> 
            <div class="row align-items-end">
                <div class="col-lg-3 mb-3">
                <label for="" class="form-label">Check-in</label>
                <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-lg-3 mb-3 ps-lg-0">
                <label for="" class="form-label">Check-out</label>
                <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-lg-3 mb-3 ps-lg-0">
                <label for="" class="form-label">Adults</label>
                <select class="form-select shadow-none">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                </div>
                <div class="col-lg-2 mb-3 ps-lg-0">
                <label for="" class="form-label">Children</label>
                <select class="form-select shadow-none">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                </div>
                <div class="col-lg-1 mb-lg-3 mt-2 mt-lg-0 ps-lg-0">
                <button class="btn text-white shadow-none custom-bg">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- our rooms -->
<section class="our_rooms py-5">
    <div class="container">
        <h2 class="h-font text-center mt-5 mb-4">OUR ROOMS</h2>

        <div class="row">

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card shadow border-0">
                    <img src="assets/images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Room Name</h5>
                        <h6 class="mb-4">$200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge text-bg-light text-wrap">2 Rooms</span>
                            <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                            <span class="badge text-bg-light text-wrap">1 Balcony</span>
                            <span class="badge text-bg-light text-wrap">3 Sofa</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge text-bg-light text-wrap">Wifi</span>
                            <span class="badge text-bg-light text-wrap">Television</span>
                            <span class="badge text-bg-light text-wrap">AC</span>
                            <span class="badge text-bg-light text-wrap">Room Heater</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge text-bg-light text-wrap">5 Adults</span>
                            <span class="badge text-bg-light text-wrap">4 Children</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge text-bg-light text-wrap">
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <a href="#" class="btn btn-sm text-white custom-bg">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card shadow border-0">
                    <img src="assets/images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Room Name</h5>
                        <h6 class="mb-4">$200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge text-bg-light text-wrap">2 Rooms</span>
                            <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                            <span class="badge text-bg-light text-wrap">1 Balcony</span>
                            <span class="badge text-bg-light text-wrap">3 Sofa</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge text-bg-light text-wrap">Wifi</span>
                            <span class="badge text-bg-light text-wrap">Television</span>
                            <span class="badge text-bg-light text-wrap">AC</span>
                            <span class="badge text-bg-light text-wrap">Room Heater</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge text-bg-light text-wrap">5 Adults</span>
                            <span class="badge text-bg-light text-wrap">4 Children</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge text-bg-light text-wrap">
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <a href="#" class="btn btn-sm text-white custom-bg">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark">More Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card shadow border-0">
                    <img src="assets/images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Room Name</h5>
                        <h6 class="mb-4">$200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge text-bg-light text-wrap">2 Rooms</span>
                            <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                            <span class="badge text-bg-light text-wrap">1 Balcony</span>
                            <span class="badge text-bg-light text-wrap">3 Sofa</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge text-bg-light text-wrap">Wifi</span>
                            <span class="badge text-bg-light text-wrap">Television</span>
                            <span class="badge text-bg-light text-wrap">AC</span>
                            <span class="badge text-bg-light text-wrap">Room Heater</span>
                        </div>
                        <div class="facility mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge text-bg-light text-wrap">5 Adults</span>
                            <span class="badge text-bg-light text-wrap">4 Children</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge text-bg-light text-wrap">
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                                <i class="bi bi-star-fill text-warning"></i>    
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-evenly">
                            <a href="#" class="btn btn-sm text-white custom-bg">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>

    </div>
</section>

<!-- facilities -->
<section class="our_facilities py-5">
    <div class="container">
        <h2 class="h-font text-center mt-5 mb-4">OUR FACILITIES</h2>

        <div class="row">

            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>
            
            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 my-3">
                <div class="text-center bg-white shadow rounded py-4 px-5">
                    <img src="assets/images/facilities/wifi.png" class="img-fluid" style="width: 80px;" alt="">
                    <p class="mt-2 mb-0">Wifi</p>
                </div>
            </div>

            <div class="col-md-12 text-center mt-4">
                <a href="#" class="btn btn-sm btn-outline-dark fw-bold rounded-0">More Facilities >>></a>
            </div>
        </div>

    </div>
</section>

<!-- testimonial -->
<section class="testimonial py-5">
    <div class="container">
        <h2 class="h-font text-center mt-5 mb-4">TESTIMONIAL</h2>

        <div class="swiper testimonialSwiper">
            <div class="swiper-wrapper mb-5">

                <div class="swiper-slide p-4 shadow">
                    <div class="d-flex align-items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAadK3kM1_f3Kwpt1WbQFeeEDJQ5cjccz8Q&s" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                        <h5 class="m-0 ms-2">User Name 1</h5>
                    </div>
                    <p class="mt-4 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione vero ut animi atque non, ullam laudantium quaerat dicta expedita illum.</p>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                    </div>
                </div>

                <div class="swiper-slide p-4 shadow">
                    <div class="d-flex align-items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAadK3kM1_f3Kwpt1WbQFeeEDJQ5cjccz8Q&s" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                        <h5 class="m-0 ms-2">User Name 1</h5>
                    </div>
                    <p class="mt-4 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione vero ut animi atque non, ullam laudantium quaerat dicta expedita illum.</p>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                    </div>
                </div>

                <div class="swiper-slide p-4 shadow">
                    <div class="d-flex align-items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAadK3kM1_f3Kwpt1WbQFeeEDJQ5cjccz8Q&s" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                        <h5 class="m-0 ms-2">User Name 1</h5>
                    </div>
                    <p class="mt-4 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione vero ut animi atque non, ullam laudantium quaerat dicta expedita illum.</p>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                    </div>
                </div>

                <div class="swiper-slide p-4 shadow">
                    <div class="d-flex align-items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAadK3kM1_f3Kwpt1WbQFeeEDJQ5cjccz8Q&s" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                        <h5 class="m-0 ms-2">User Name 1</h5>
                    </div>
                    <p class="mt-4 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione vero ut animi atque non, ullam laudantium quaerat dicta expedita illum.</p>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                    </div>
                </div>

                <div class="swiper-slide p-4 shadow">
                    <div class="d-flex align-items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdAadK3kM1_f3Kwpt1WbQFeeEDJQ5cjccz8Q&s" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                        <h5 class="m-0 ms-2">User Name 1</h5>
                    </div>
                    <p class="mt-4 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione vero ut animi atque non, ullam laudantium quaerat dicta expedita illum.</p>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                        <i class="bi bi-star-fill text-warning"></i>    
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>

<script>
    var swiper = new Swiper(".testimonialSwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints:{
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        }
    });
</script>

<!-- reach us -->
<section class="reach_us py-5">
    <div class="container">
        <h2 class="h-font text-center mt-5 mb-4">REACH US</h2>

        <div class="row">
            <div class="col-md-8">
                <iframe width="100%" height="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17637.751539051675!2d91.65767756226288!3d22.544391590228916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acccb300038f6f%3A0xb481266e22127949!2zQmFuc2hiYXJpYSBTZWEgQmVhY2gg4Kas4Ka-4KaB4Ka24Kas4Ka-4Kec4Ka_4Kef4Ka-IOCmuOCmruCngeCmpuCnjeCmsCDgprjgp4jgppXgpqQ!5e1!3m2!1sen!2sbd!4v1739979921788!5m2!1sen!2sbd" style="border:0;" loading="lazy"></iframe>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow mt-4 mt-md-0 mb-4">
                    <h4>Call Us</h4>
                    <a href="#" class="d-flex align-items-center my-3 text-decoration-none text-dark">
                        <i class="bi bi-telephone me-2"></i>
                        +01531454578
                    </a>
                    <a href="#" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-telephone me-2"></i>
                        +01531454578
                    </a>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h4>Follow Us</h4>
                    <a href="#" class="d-flex align-items-center my-3 text-decoration-none text-dark">
                        <i class="bi bi-twitter-x me-2"></i>
                        X
                    </a>
                    <a href="#" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-facebook me-2"></i>
                        Facebook
                    </a>
                    <a href="#" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-instagram me-2"></i>
                        Instagram
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>


<?php 
 require "footer.php";
?> 
