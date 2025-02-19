<?php 
 require "top.php";
?> 

<section class="py-5">
    <div class="container">

        <h2 class="h-font text-center mt-5 mb-2">ABOUT US</h2>
        <p class="text-center mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto quasi dolor at non illo adipisci unde aliquam placeat soluta aspernatur.</p>

        <div class="row align-items-center justify-content-between">
            <div class="col-md-6 mt-3 mt-md-0 order-2 order-md-1">
                <div>
                    <h2>About Us</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui libero ipsam earum ad minima vitae eum nobis suscipit nemo deserunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui libero ipsam earum ad minima vitae eum nobis suscipit nemo deserunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui libero ipsam earum ad minima vitae eum nobis suscipit nemo deserunt.</p>
                </div>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <div>
                    <img src="assets/images/about.jpg" class="w-100">
                </div>
            </div>
        </div>

    </div>
</section>

<section class="py-5">
    <div class="container">

      <div class="row">

        <div class="col-md-6 col-lg-3 my-3">
            <div class="text-center bg-white shadow rounded p-4 border-top border-4 border-dark about-item">
                <img src="assets/images/room.png" width="80px">
                <h4 class="mt-3 mb-0 text-uppercase">100+ Rooms</h4>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 my-3">
            <div class="text-center bg-white shadow rounded p-4 border-top border-4 border-dark about-item">
                <img src="assets/images/customer.png" width="80px">
                <h4 class="mt-3 mb-0 text-uppercase">200+ Customer</h4>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 my-3">
            <div class="text-center bg-white shadow rounded p-4 border-top border-4 border-dark about-item">
                <img src="assets/images/rating.png" width="80px">
                <h4 class="mt-3 mb-0 text-uppercase">150+ Reviews</h4>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 my-3">
            <div class="text-center bg-white shadow rounded p-4 border-top border-4 border-dark about-item">
                <img src="assets/images/staff.png" width="80px">
                <h4 class="mt-3 mb-0 text-uppercase">100+ Staffs</h4>
            </div>
        </div>

      </div>

    </div>
</section>

<section class="py-5">
    <div class="container">

        <h2 class="h-font text-center mt-5 mb-2">MANAGEMENT TEAM</h2>

        <div class="swiper managementSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide my-2 ">
                    <div class="bg-white shadowrounded overflow-hidden p-3 text-center">
                        <img class="w-100" src="https://images.pexels.com/photos/5371584/pexels-photo-5371584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                        <h4 class="mt-3">Team Member 1</h4>
                    </div>
                </div>

                <div class="swiper-slide my-2 ">
                    <div class="bg-white shadowrounded overflow-hidden p-3 text-center">
                        <img class="w-100" src="https://images.pexels.com/photos/5371584/pexels-photo-5371584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                        <h4 class="mt-3">Team Member 1</h4>
                    </div>
                </div>

                <div class="swiper-slide my-2 ">
                    <div class="bg-white shadowrounded overflow-hidden p-3 text-center">
                        <img class="w-100" src="https://images.pexels.com/photos/5371584/pexels-photo-5371584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                        <h4 class="mt-3">Team Member 1</h4>
                    </div>
                </div>

                <div class="swiper-slide my-2 ">
                    <div class="bg-white shadowrounded overflow-hidden p-3 text-center">
                        <img class="w-100" src="https://images.pexels.com/photos/5371584/pexels-photo-5371584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                        <h4 class="mt-3">Team Member 1</h4>
                    </div>
                </div>

                <div class="swiper-slide my-2 ">
                    <div class="bg-white shadowrounded overflow-hidden p-3 text-center">
                        <img class="w-100" src="https://images.pexels.com/photos/5371584/pexels-photo-5371584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                        <h4 class="mt-3">Team Member 1</h4>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>

<script>
    var swiper = new Swiper(".managementSwiper", {
        spaceBetween : 40,
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
                slidesPerView: 4,
            },
        }
    });
</script>

<?php 
 require "footer.php";
?> 
