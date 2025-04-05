<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";


if(isset($_GET['get_rooms']))
{

    $count = 0;
    $output = "";


    // checkin & checkout filter validation

    $chk_avail = json_decode($_GET['chk_avail'], true);

    if($chk_avail['checkin'] !="" && $chk_avail['checkout'] !="")
    {
        $t_day = new DateTime(date('Y-m-d'));
        $checkin_day = new DateTime($chk_avail['checkin']);
        $checkout_day = new DateTime($chk_avail['checkout']);
    
        $status = "";
        $result = "";
    
        if($checkin_day == $checkout_day)
        {
            echo "<h3 class='text-center text-danger'>Checkin & Checkout date are equal</h3>";
            exit();
        }
        else if($checkin_day < $t_day)
        {
            echo "<h3 class='text-center text-danger'>Checkin date are earlier from Today</h3>";
            exit();
        }
        else if($checkout_day < $checkin_day)
        {
            echo "<h3 class='text-center text-danger'>Checkout date are earlier from Checkin</h3>";
            exit();
        }
       
    }


    // guests filter validation

    $guests = json_decode($_GET['guests'], true);
    $adults = ($guests['adults'] !="") ? $guests['adults'] : 0;
    $children = ($guests['children'] !="") ? $guests['children'] : 0;


    // facilities filter validation

    $facility_list = json_decode($_GET['facilities_list'], true);


    //setting info for check website shutdown or not

    $setting_res = select("SELECT * FROM `settings` WHERE `id` = ?", 'i', [1]);
    $setting_row = $setting_res->fetch_assoc();

    $room_sql = "SELECT * FROM `rooms` WHERE `adult` >= ? AND `children` >= ? AND `status` = ? AND `removed` = ? ORDER BY `id` DESC"; 
    $room_res = select($room_sql, "iiii", [$adults, $children, 1,0]);
    if($room_res->num_rows > 0)
    {
      while($room_row = $room_res->fetch_assoc())
      {

        // check availability filter

        if($chk_avail['checkin'] !="" && $chk_avail['checkout'] !="")
        {
            $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` 
            WHERE `booking_status` = ?  AND `room_id` = ?
            AND `check_out` > ? AND `check_in` < ?";

            $values = ["booked", $room_row['id'], $chk_avail['checkin'], $chk_avail['checkout']];

            $tb_res = select($tb_query, 'siss', $values);
            $tb_row = $tb_res->fetch_assoc();

            if(($room_row['quantity'] - $tb_row['total_bookings']) == 0)
            {
                continue;
            }
        }


        // facility filter

        $fac_count = 0;

        $facilities_q = "SELECT `facilities`.`facility_name`,`facilities`.`id` FROM `facilities`
                        INNER JOIN `room-facilities` 
                        ON `facilities`.`id` = `room-facilities`.`facilities_id`
                        WHERE `room-facilities`.`room_id` = '{$room_row['id']}'";

        $facilities_res = mysqli_query($conn, $facilities_q);

        $facility_data = "";

        while($facilities_row = mysqli_fetch_assoc($facilities_res))
        {

            if(in_array($facilities_row['id'], $facility_list['facilities']))
            {
                $fac_count++;
            }

            $facility_data .=" 
             <span class='badge text-bg-light text-wrap me-1 mb-1'>".$facilities_row['facility_name']."</span>
            ";
        }

        if(count($facility_list['facilities']) != $fac_count)
        {
            continue;
        }

     
        $output .="
            <div class='card mb-3 border-0 shadow bg-white p-3'>
                <div class='row g-0 align-items-center'>";

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

        $output .="
                    <div class='col-lg-5'>
                     <img src='".IMAGE_PATH."rooms/".$thumbnail."' class='img-fluid rounded'>
                    </div>

                    <div class='col-lg-5 mt-4 mt-lg-0 px-lg-4'>
                        <h5 class='mb-3'>".$room_row['name']."</h5>
                        <div class='features mb-3'>
                            <h6 class='mb-1'>Features</h6>";

                            
                            $features_q = "SELECT `features`.`feature_name` FROM `features`
                                            INNER JOIN `room_features` 
                                            ON `features`.`id` = `room_features`.`feature_id`
                                            WHERE `room_features`.`room_id` = '{$room_row['id']}'";

                            $features_res = mysqli_query($conn, $features_q);
                            while($features_row = mysqli_fetch_assoc($features_res))
                            {
                                $output .=" 
                                  <span class='badge text-bg-light text-wrap me-1 mb-1'>".$features_row['feature_name']."</span>
                                ";
                            }

        $output .="
                        </div>

                        <div class='facility mb-3'>
                            <h6 class='mb-1'>Facilities</h6>
                            ".$facility_data."
                        </div>
                        <div class='facility mb-3'>
                            <h6 class='mb-1'>Guests</h6>
                            <span class='badge text-bg-light text-wrap me-1 mb-1'>".$room_row['adult']." Adults</span>
                            <span class='badge text-bg-light text-wrap me-1 mb-1'>".$room_row['children']." Children</span>
                        </div> ";


                        $room_rating = "SELECT AVG(rating) AS `total_rating` FROM `rate_review` WHERE `room_id` = ? AND `seen` = 1 ORDER BY `id` DESC LIMIT 20";

                        $room_rate_res = select($room_rating, 'i', [$room_row['id']]);
                        $room_rate_row = $room_rate_res->fetch_assoc();

                        if($room_rate_row['total_rating'] != NULL)
                        {

                            $output .="
                                <div class='rating'>
                                    <h6 class='mb-1'>Rating</h6>
                                    <span class='badge text-bg-light text-wrap'>";

                                    for($i = 1; $i <= ceil($room_rate_row['total_rating']); $i++)
                                    {
                                        $output .="<i class='bi bi-star-fill text-warning'></i> ";
                                    }
                            
                            $output .="
                                        
                                    </span>
                                </div>
                            ";
                            
                        }  
                
                $output .="
                    </div>

                    <div class='col-lg-2 mt-3 mt-lg-0'>
                        <div class='text-center'>
                            <h6 class='mb-4'>$".$room_row['price']." per night</h6>";

                            $login = 0;
                            if(!$setting_row['shutdown'])
                            {
                                if(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true)
                                {
                                    $login = 1;
                                }

                            $output .="
                              <button onclick='checkLogin(".$login.", ".$room_row['id'].")' class='btn text-white custom-bg d-inline-block w-100 mb-2'>Book Now</button>";

                            }

                    $output .="
                            <a href='room-details?id=".$room_row['id']."' class='btn btn-outline-dark d-inline-block w-100'>More Details</a>
                        </div>
                    </div>

                </div>
            </div>";

        $count++; 
        
      }
    } 
    else 
    {
        $output .="<h3 class='text-center text-danger'>No rooms to show</h3>";
    }

    echo $output;

}


?>