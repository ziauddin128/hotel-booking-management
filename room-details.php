<?php 
 require "top.php";

 if(!isset($_GET['id']))
 {
    redirect('rooms');
 }

 $form_data = filtration($_GET);

 $room_sql = "SELECT * FROM `rooms` WHERE `status` = ? AND `removed` = ? AND `id` = ?"; 
 $room_res = select($room_sql, "iii", [1,0, $form_data['id']]);
 if($room_res->num_rows == 0)
 {
   redirect('rooms');
 }
 $room_row = $room_res->fetch_assoc();

?> 

<section class="py-5">
    <div class="container">

      <h2 class="mb-3"><?= $room_row['name'] ?></h2>

      <div class="mb-4" style="font-size: 14px;">
        <a href="index" class="text-secondary text-decoration-none">HOME</a>
        <span class="text-secondary"> > </span>
        <a href="rooms" class="text-secondary text-decoration-none">ROOMS</a>
      </div>

      <div class="row">

          <div class="col-lg-7 mb-3">

            <div id="image_carousel" class="carousel slide carousel-fade">
              <div class="carousel-inner">

                <?php 
                  $image_q = "SELECT * FROM `room_image` WHERE `room_id` = '{$room_row['id']}'";
                  $image_res = mysqli_query($conn, $image_q);
                  if(mysqli_num_rows($image_res) > 0)
                  {
                    $active_class = "active";
                    while($image_row = mysqli_fetch_assoc($image_res))
                    {
                      ?>
                      <div class="carousel-item <?= $active_class ?>">
                        <img src="<?= IMAGE_PATH ?>rooms/<?= $image_row['image'] ?>" class="d-block w-100 rounded">
                      </div>
                      <?php 
                      $active_class = "";
                    }
                  }
                  else 
                  {
                    $image = "thumbnail.jpg";
                    ?>
                    <div class="carousel-item active">
                      <img src="<?= IMAGE_PATH ?>rooms/thumbnail.jpg" class="d-block w-100">
                    </div>
                    <?php 
                  }
                ?>

              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#image_carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#image_carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
              
          </div>

          <div class="col-lg-5">
          
            <div class="bg-white shadow-sm rounded p-4">
              <h4 class="mb-4">$<?= $room_row['price'] ?> per night</h4>

              <?php 
                $room_rating = "SELECT AVG(rating) AS `total_rating` FROM `rate_review` WHERE `room_id` = ? AND `seen` = 1 ORDER BY `id` DESC LIMIT 20";

                $room_rate_res = select($room_rating, 'i', [$room_row['id']]);
                $room_rate_row = $room_rate_res->fetch_assoc();

                if($room_rate_row['total_rating'] != NULL)
                {
                  ?>
                      <div class="rating mb-4">
                          <h6 class="mb-1">Rating</h6>
                          <span class="badge text-bg-light text-wrap">

                              <?php 
                                for($i = 1; $i <= ceil($room_rate_row['total_rating']); $i++)
                                {
                                  ?>
                                    <i class="bi bi-star-fill text-warning"></i>    
                                  <?php 
                                }
                              ?>
                          </span>
                      </div>
                  <?php 
                }  
              ?>

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

              <?php 
                $login = 0;
                if(!$setting_row['shutdown'])
                {
                  if(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true)
                  {
                    $login = 1;
                  }
                  ?>
                  <button onclick="checkLogin(<?= $login ?>, <?= $room_row['id'] ?>)" class="btn text-white custom-bg d-inline-block w-100 mb-1">Book Now</button>
                  <?php 
                }
              ?>


            </div>
          </div>
          
      </div>

      <div class="mt-3 mb-5">
        <h4 class="mb-3">Description</h4>
        <p><?= $room_row['description'] ?></p>
      </div>

      <div class="mt-3 mb-2">
        <h4 class="mb-3">Review-Rating</h4>

        <?php 
          $rating_sql = "SELECT rr.*, uc.name AS uname, uc.picture AS u_picture FROM `rate_review` AS rr
          INNER JOIN `user_cred` AS uc ON rr.user_id = uc.id
          WHERE rr.seen = 1 AND rr.room_id = {$room_row['id']}
          ORDER BY rr.`id` DESC LIMIT 6";
          $rating_res = mysqli_query($conn, $rating_sql);
          if(mysqli_num_rows($rating_res) > 0)
          { 
            while($rating_row = mysqli_fetch_assoc($rating_res))
            {
              ?>

               <div class="shadow-sm mb-2 bg-white p-3 p-md-4 rounded">
                <div class="d-flex align-items-center">
                    <img src="<?= IMAGE_PATH ?>users/<?= $rating_row['u_picture'] ?>" loading="lazy" style="height: 100px; width: 100px;object-fit: cover; object-position: center; border-radius: 50%;">
                    <h5 class="m-0 ms-2"><?= $rating_row['uname'] ?></h5>
                </div>

                <p class="mt-4 mb-2"><?= $rating_row['review'] ?></p>

                <div>
                    <?php 
                      for($i = 1; $i <= $rating_row['rating']; $i++)
                      {
                      ?>
                      <i class="bi bi-star-fill text-warning"></i>    
                      <?php 
                      } 
                  ?>  
                </div>
               </div>
              
              <?php 
            }
          }
          else 
          {
            echo "No review yet";
          }
        ?>


      </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 
