<?php 
 require "top.php";
?> 

<section class="py-5">
    <div class="container">

        <h2 class="h-font text-center mt-5 mb-4">OUR ROOMS</h2>

        <div class="row">

            <div class="col-lg-3 px-lg-0">
                <nav class="navbar navbar-expand-lg bg-white shadow rounded p-3">
                    <div class="container-fluid flex-row flex-lg-column align-items-baseline p-0">
                        <h4 class="my-0">FILTER</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch w-100" id="filterDropdown">

                            <div class="border bg-light py-3 px-2 mt-3 rounded">
                                <h4 class="mb-2" style="font-size: 16px;">CHECK AVAILABILITY</h4>
                                <div class="mb-3">
                                   <label for="" class="form-label">Check-in</label>
                                   <input type="date" class="form-control shadow-none" name="name">
                                </div>
                                <div class="mb-3">
                                   <label for="" class="form-label">Check-out</label>
                                   <input type="date" class="form-control shadow-none" name="name">
                                </div>
                            </div>

                            <div class="border bg-light py-3 px-2 mt-3 rounded">
                                <h4 class="mb-2" style="font-size: 16px;">FACILITIES</h4>
                                <div class="d-flex gap-2 mb-1">
                                   <input type="checkbox" class="form-check-input shadow-none" id="f1" name="name">
                                   <label for="f1" class="form-label m-0">Facility 1</label>
                                </div>
                                <div class="d-flex gap-2 mb-1">
                                   <input type="checkbox" class="form-check-input shadow-none" id="f2" name="name">
                                   <label for="f2" class="form-label m-0">Facility 2</label>
                                </div>
                                <div class="d-flex gap-2 mb-1">
                                   <input type="checkbox" class="form-check-input shadow-none" id="f3" name="name">
                                   <label for="f3" class="form-label m-0">Facility 3</label>
                                </div>
                            </div>

                            <div class="border bg-light py-3 px-2 mt-3 rounded">
                                <h4 class="mb-2" style="font-size: 16px;">GUESTS</h4>
                                <div class="d-flex gap-2">
                                    <div>
                                      <label for="" class="form-label">Adults</label>
                                      <input type="number" class="form-control shadow-none" name="name">
                                    </div>
                                    <div>
                                      <label for="" class="form-label">Children</label>
                                      <input type="number" class="form-control shadow-none" name="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
             <div class="rooms-card">

                <div class="card mb-3 border-0 shadow bg-white p-3">
                    <div class="row g-0 align-items-center">

                        <div class="col-lg-5">
                          <img src="assets/images/rooms/1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-lg-5 mt-4 mt-lg-0 px-lg-4">
                            <h5 class="mb-3">Room Name</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <span class="badge text-bg-light text-wrap">2 Rooms</span>
                                <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                                <span class="badge text-bg-light text-wrap">1 Balcony</span>
                                <span class="badge text-bg-light text-wrap">3 Sofa</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge text-bg-light text-wrap">Wifi</span>
                                <span class="badge text-bg-light text-wrap">Television</span>
                                <span class="badge text-bg-light text-wrap">AC</span>
                                <span class="badge text-bg-light text-wrap">Room Heater</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge text-bg-light text-wrap">5 Adults</span>
                                <span class="badge text-bg-light text-wrap">4 Children</span>
                            </div>
                            <div class="rating">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge text-bg-light text-wrap">
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-2 mt-3 mt-lg-0">
                          <div class="text-center">
                            <h6 class="mb-4">$200 per night</h6>
                            <a href="#" class="btn btn-sm text-white custom-bg d-inline-block w-100 mb-2">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark d-inline-block w-100">More Details</a>
                          </div>
                        </div>

                    </div>
                </div>  

                <div class="card mb-3 border-0 shadow bg-white p-3">
                    <div class="row g-0 align-items-center">

                        <div class="col-lg-5">
                          <img src="assets/images/rooms/1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-lg-5 mt-4 mt-lg-0 px-lg-4">
                            <h5 class="mb-3">Room Name</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <span class="badge text-bg-light text-wrap">2 Rooms</span>
                                <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                                <span class="badge text-bg-light text-wrap">1 Balcony</span>
                                <span class="badge text-bg-light text-wrap">3 Sofa</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge text-bg-light text-wrap">Wifi</span>
                                <span class="badge text-bg-light text-wrap">Television</span>
                                <span class="badge text-bg-light text-wrap">AC</span>
                                <span class="badge text-bg-light text-wrap">Room Heater</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge text-bg-light text-wrap">5 Adults</span>
                                <span class="badge text-bg-light text-wrap">4 Children</span>
                            </div>
                            <div class="rating">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge text-bg-light text-wrap">
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-2 mt-3 mt-lg-0">
                          <div class="text-center">
                            <h6 class="mb-4">$200 per night</h6>
                            <a href="#" class="btn btn-sm text-white custom-bg d-inline-block w-100 mb-2">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark d-inline-block w-100">More Details</a>
                          </div>
                        </div>

                    </div>
                </div>  

                <div class="card mb-3 border-0 shadow bg-white p-3">
                    <div class="row g-0 align-items-center">

                        <div class="col-lg-5">
                          <img src="assets/images/rooms/1.jpg" class="img-fluid rounded">
                        </div>

                        <div class="col-lg-5 mt-4 mt-lg-0 px-lg-4">
                            <h5 class="mb-3">Room Name</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                <span class="badge text-bg-light text-wrap">2 Rooms</span>
                                <span class="badge text-bg-light text-wrap">1 Bathroom</span>
                                <span class="badge text-bg-light text-wrap">1 Balcony</span>
                                <span class="badge text-bg-light text-wrap">3 Sofa</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge text-bg-light text-wrap">Wifi</span>
                                <span class="badge text-bg-light text-wrap">Television</span>
                                <span class="badge text-bg-light text-wrap">AC</span>
                                <span class="badge text-bg-light text-wrap">Room Heater</span>
                            </div>
                            <div class="facility mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge text-bg-light text-wrap">5 Adults</span>
                                <span class="badge text-bg-light text-wrap">4 Children</span>
                            </div>
                            <div class="rating">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge text-bg-light text-wrap">
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                    <i class="bi bi-star-fill text-warning"></i>    
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-2 mt-3 mt-lg-0">
                          <div class="text-center">
                            <h6 class="mb-4">$200 per night</h6>
                            <a href="#" class="btn btn-sm text-white custom-bg d-inline-block w-100 mb-2">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark d-inline-block w-100">More Details</a>
                          </div>
                        </div>

                    </div>
                </div>  

               

             </div>
            </div>
           
        </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 
