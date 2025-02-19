<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TJ Hotel</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="bg-light">

    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg bg-white px-lg-4 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand h-font fs-3 fw-bold me-5" href="#">TJ HOTEL</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active me-3" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link me-3" href="#">Rooms</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link me-3" href="#">Facilities</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>

                    <button class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- login modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="submit" class="btn btn-dark shadow-none">Login</button>
                            <a href="#" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- register modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                        User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <span class="badge text-bg-light mb-3 text-wrap lh-base">
                            Note: Your details must match with your id (NID, Passport, Driving Licenses, etc.) that will be required during check-in. 
                        </span>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-3 ps-0">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" name="name">
                                </div>
                                <div class="col-md-6 mb-3 p-0">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none" name="email">
                                </div>
                                <div class="col-md-6 mb-3 ps-0">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shadow-none" name="phone_number">
                                </div>
                                <div class="col-md-6 mb-3 p-0">
                                    <label for="" class="form-label">Picture</label>
                                    <input type="file" class="form-control shadow-none">
                                </div>
                                <div class="col-md-12 mb-3 p-0">
                                    <label for="" class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3 ps-0">
                                    <label for="" class="form-label">Pincode</label>
                                    <input type="number" class="form-control shadow-none" name="phone_number">
                                </div>
                                <div class="col-md-6 mb-3 p-0">
                                    <label for="" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 mb-3 ps-0">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" name="phone_number">
                                </div>
                                <div class="col-md-6 mb-3 p-0">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>
                            </div>

                            <div class="text-center my-1">
                              <button type="submit" class="btn btn-dark shadow-none">Register</button>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>