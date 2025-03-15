<?php 
 require "top.php";
?> 

<!-- carousel -->
<section class="home_slider mt-4 px-lg-4">
    <div class="container-fluid">
        <div class="swiper homeSlider">
            <div class="swiper-wrapper">
                <?php 
                 $carousel_res = selectAll('carousel');
                 while($carousel_row = $carousel_res->fetch_assoc())
                 {
                    ?>
                    <div class="swiper-slide">
                        <img src="<?= IMAGE_PATH ?>carousel/<?= $carousel_row['image'] ?>"/>
                    </div>
                    <?php 
                 }
                ?>
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
            <?php 
                $room_sql = "SELECT * FROM `rooms` WHERE `status` = ? AND `removed` = ? ORDER BY `id` DESC LIMIT 3"; 
                $room_res = select($room_sql, "ii", [1,0]);
                if($room_res->num_rows > 0)
                {
                while($room_row = $room_res->fetch_assoc())
                {
                    ?>
                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card shadow border-0">

                            <?php 
                                $thumbnail_q = "SELECT * FROM `room_image` WHERE `room_id` = '{$room_row['id']}' AND `thumb` = '1'";
                                $thumbnail_res = mysqli_query($conn, $thumbnail_q);
                                if(mysqli_num_rows($thumbnail_res) > 0)
                                {
                                    $thumbnail_row = mysqli_fetch_assoc($thumbnail_res);
                                    $thumbnail = $thumbnail_row['image'];
                                }
                                else 
                                {
                                    $thumbnail = "thumbnail.jpg";
                                }
                            ?>
                            <img src="<?= IMAGE_PATH ?>rooms/<?= $thumbnail ?>" class="card-img-top">

                            <div class="card-body">
                                <h5><?= $room_row['name'] ?></h5>
                                <h6 class="mb-4">$<?= $room_row['price'] ?> per night</h6>

                                <div class="features mb-4">
                                    <h6 class="mb-1">Features</h6>
                                    <?php 
                                    $features_q = "SELECT `features`.`feature_name` FROM `features`
                                                    INNER JOIN `room_features` 
                                                    ON `features`.`id` = `room_features`.`feature_id`
                                                    WHERE `room_features`.`room_id` = '{$room_row['id']}'";

                                    $features_res = mysqli_query($conn, $features_q);
                                    while($features_row = mysqli_fetch_assoc($features_res))
                                    {
                                        ?>
                                        <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $features_row['feature_name'] ?></span>
                                        <?php 
                                    }
                                    ?>
                                </div>

                                <div class="facility mb-4">
                                    <h6 class="mb-1">Facilities</h6>
                                    <?php 
                                    $facilities_q = "SELECT `facilities`.`facility_name` FROM `facilities`
                                                    INNER JOIN `room-facilities` 
                                                    ON `facilities`.`id` = `room-facilities`.`facilities_id`
                                                    WHERE `room-facilities`.`room_id` = '{$room_row['id']}'";

                                    $facilities_res = mysqli_query($conn, $facilities_q);
                                    while($facilities_row = mysqli_fetch_assoc($facilities_res))
                                    {
                                        ?>
                                        <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $facilities_row['facility_name'] ?></span>
                                        <?php 
                                    }
                                    ?>
                                </div>

                                <div class="facility mb-4">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $room_row['adult'] ?> Adults</span>
                                    <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $room_row['children'] ?> Children</span>
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
                                    <?php 
                                    $login = 0;
                                    if(!$setting_row['shutdown'])
                                    {
                                        if(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true)
                                        {
                                            $login = 1;
                                        }
                                        ?>
                                        <button onclick="checkLogin(<?= $login ?>, <?= $room_row['id'] ?>)" class="btn btn-sm text-white custom-bg">Book Now</button>
                                        <?php 
                                    }
                                    ?>
                                    <a href="room-details?id=<?= $room_row['id'] ?>" class="btn btn-sm btn-outline-dark">More Details</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php 
                }
                } 
            ?>

            <div class="col-md-12 text-center mt-4">
                <a href="rooms" class="btn btn-sm btn-outline-dark fw-bold rounded-0">More Rooms >>></a>
            </div>

        </div>

    </div>
</section>

<!-- facilities -->
<section class="our_facilities py-5">
    <div class="container">
        <h2 class="h-font text-center mt-5 mb-4">OUR FACILITIES</h2>

        <div class="row">

            <?php 
              $facility_res = mysqli_query($conn, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 4");
              while ($facility_row = mysqli_fetch_assoc($facility_res)) 
              {
                ?>
                <div class="col-6 col-md-4 col-lg-3 my-3">
                    <div class="text-center bg-white shadow rounded py-4 px-5">
                        <img src="<?= IMAGE_PATH ?>facilities/<?= $facility_row['facility_icon'] ?>" class="img-fluid" style="width: 80px;" alt="">
                        <p class="mt-2 mb-0"><?= $facility_row['facility_name'] ?></p>
                    </div>
                </div>
                <?php
              }
            ?>

            <div class="col-md-12 text-center mt-4">
                <a href="facilities" class="btn btn-sm btn-outline-dark fw-bold rounded-0">More Facilities >>></a>
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
                <iframe width="100%" height="100%" src="<?= $contact_row['iframe'] ?>" style="border:0;" loading="lazy"></iframe>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow mt-4 mt-md-0 mb-4">
                    <h4>Call Us</h4>
                    <a href="tel: <?= $contact_row['phn1'] ?>" class="d-flex align-items-center my-3 text-decoration-none text-dark">
                        <i class="bi bi-telephone me-2"></i>
                        <?= $contact_row['phn1'] ?>
                    </a>
                    <a href="tel:  <?= $contact_row['phn2'] ?>" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-telephone me-2"></i>
                        <?= $contact_row['phn2'] ?>
                    </a>
                </div>

                <div class="bg-white p-4 rounded shadow">
                    <h4>Follow Us</h4>
                    <a href="<?= $contact_row['fb'] ?>" target="_blank" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-facebook me-2"></i>
                        Facebook
                    </a>
                    <a href="<?= $contact_row['insta'] ?>" target="_blank" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                        <i class="bi bi-instagram me-2"></i>
                        Instagram
                    </a>
                    <a href="<?= $contact_row['tw'] ?>" target="_blank" class="d-flex align-items-center my-3 text-decoration-none text-dark">
                        <i class="bi bi-twitter-x me-2"></i>
                        Twitter
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- set password -->
<div class="modal fade" id="setPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <form id="set_pass_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center">
                    <i class="bi bi-shield-lock fs-3 me-2"></i>
                    Set New Password
                    </h1>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control shadow-none" name="pass" required>

                        <input type="hidden" name="email">
                        <input type="hidden" name="token">

                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn outline-none shadow-none text-secondary text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php 
 require "footer.php";
?> 

<?php 

if(isset($_GET['type']) && $_GET['type'] == "reset")
{
    $form_data = filtration($_GET);

    $t_date = date('Y-m-d');

    if($t_date > $form_data['date'])
    {
        alert('error', "Invalid or Expired token");
    }
    else 
    {
       echo "
       <script>
            const modalElement = document.getElementById('setPasswordModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement); 
            modalInstance.show();

            let set_pass_form = document.getElementById('set_pass_form');
            set_pass_form.elements['email'].value = '{$form_data['email']}';
            set_pass_form.elements['token'].value = '{$form_data['token']}';

       </script>
       "; 
    }
}

?>

<script>
    //set new password 

    set_pass_form.addEventListener("submit", function(e)
    {
        e.preventDefault();

        let form_data = new FormData(this);
        form_data.append("action", "set_password");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php");

        xhr.onload = function()
        {
            const modalElement = document.getElementById('setPasswordModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement); 
            modalInstance.hide();

            if(this.responseText == "invalid_token")
            {
                alert("error", "Invalid token!");
            }
            else if(this.responseText == "expire_token")
            {
                alert("error", "Token Expired!");
            }
            else if(this.responseText == "success")
            {
                set_pass_form.reset();
                alert("success", "Password Set Successfully!");
            }
            else 
            {
                alert("error", "Server down!");
            }
        }

        xhr.send(form_data);
    })
</script>

