<?php 
 require "top.php";
?> 

<section class="py-5">
    <div class="container-fluid">

        <h2 class="h-font text-center mt-5 mb-4">OUR ROOMS</h2>

        <div class="row">

            <div class="col-lg-3 mb-3 ps-lg-4">
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

                <?php 
                  $room_sql = "SELECT * FROM `rooms` WHERE `status` = ? AND `removed` = ? ORDER BY `id` DESC"; 
                  $room_res = select($room_sql, "ii", [1,0]);
                  if($room_res->num_rows > 0)
                  {
                    while($room_row = $room_res->fetch_assoc())
                    {
                      ?>
                      <div class="card mb-3 border-0 shadow bg-white p-3">
                          <div class="row g-0 align-items-center">
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
                              <div class="col-lg-5">
                                <img src="<?= IMAGE_PATH ?>rooms/<?= $thumbnail ?>" class="img-fluid rounded">
                              </div>

                              <div class="col-lg-5 mt-4 mt-lg-0 px-lg-4">
                                  <h5 class="mb-3"><?= $room_row['name'] ?></h5>
                                  <div class="features mb-3">
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

                                  <div class="facility mb-3">
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
                                  <div class="facility mb-3">
                                      <h6 class="mb-1">Guests</h6>
                                      <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $room_row['adult'] ?> Adults</span>
                                      <span class="badge text-bg-light text-wrap me-1 mb-1"><?= $room_row['children'] ?> Children</span>
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
                                      <h6 class="mb-4">$<?= $room_row['price'] ?> per night</h6>

                                      <?php 
                                      $login = 0;
                                      if(!$setting_row['shutdown'])
                                      {
                                        if(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true)
                                        {
                                            $login = 1;
                                        }
                                        ?>
                                        <button onclick="checkLogin(<?= $login ?>, <?= $room_row['id'] ?>)" class="btn text-white custom-bg d-inline-block w-100 mb-2">Book Now</button>
                                        <?php 
                                      }
                                      ?>

                                      <a href="room-details?id=<?= $room_row['id'] ?>" class="btn btn-outline-dark d-inline-block w-100">More Details</a>
                                  </div>
                              </div>

                          </div>
                      </div> 
                      <?php 
                    }
                  } 
                ?>
             </div>
            </div>
           
        </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 
