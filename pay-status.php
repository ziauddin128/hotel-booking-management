<?php 
 require "top.php";

 if(!isset($_GET['order_id']))
 {
    redirect('index');
 }

 if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
 {
  redirect('index');
 }

 $form_data = filtration($_GET);

?> 

<section class="py-5">
    <div class="container">

    <div class="mb-3 bg-white shadow-sm rounded p-3">
        <?php 
          $query = "SELECT `bo`.*, `bd`.* FROM `booking_order` AS bo INNER JOIN booking_details AS bd ON  `bo`.`booking_id` = `bd`.`booking_id` WHERE `bo`.`order_id` = ? AND `bo`.`user_id` = ? AND `bo`.`booking_status` != ?";

          $booking_res = select($query, 'sis', [$form_data['order_id'], $_SESSION['USER_ID'], "pending"]);

          if($booking_res->num_rows == 0 )
          {
            redirect('index');
          }

          $booking_row = $booking_res->fetch_assoc();

          if($booking_row['trans_status'] == "succeeded")
          {
            
            echo <<<data
              <div>
                <p class="fw-bold alert alert-success p-3 rounded">
                 <i class="bi bi-check-circle"></i>
                 Payment Done! Booking Successful
                 <br><br>
                 <a href="booking">Go to bookings</a>
                </p>
              </div>
            data;
          }
          else 
          {
            echo <<<data
              <div>
                <p class="fw-bold alert alert-danger p-3 rounded">
                  <i class="bi bi-exclamation-triangle-fill"></i>
                  Payment Failed!
                  <br><br>
                  <a href="booking">Go to bookings</a>
                </p>
                
              </div>
            data;
          }
        ?>
    </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 

