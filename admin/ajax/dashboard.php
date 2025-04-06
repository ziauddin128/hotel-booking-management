<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['action']) && $_POST['action'] == "booking_analytics")
  {
    $form_data = filtration($_POST);

    $condition = "";
    if($form_data['period'] == 1)
    { 
      // 30 days
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
    }
    else if($form_data['period'] == 2)
    {
      // 90 days
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
    }
    else if($form_data['period'] == 3)
    {
      // 1 Year
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
    }
    
    $result = mysqli_fetch_assoc(mysqli_query($conn, 
              "SELECT 
              COUNT(booking_id) AS `total_bookings`,
              SUM(trans_amt) AS `total_amt`,

              COUNT(CASE WHEN `booking_status` = 'booked' AND `arrival` = 1 THEN 1 END) AS `active_bookings`,
              SUM(CASE WHEN `booking_status` = 'booked' AND `arrival` = 1 THEN `trans_amt` END) AS `active_amt`,

              COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 1 THEN 1 END) AS `refund_bookings`,
              SUM(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 1 THEN `trans_amt` END) AS `refund_amt`

              FROM `booking_order` $condition"
              ));

    echo json_encode($result);
  }

  if(isset($_POST['action']) && $_POST['action'] == "query_analytics")
  {
    $form_data = filtration($_POST);

    $condition = "";
    if($form_data['period'] == 1)
    { 
      // 30 days
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
    }
    else if($form_data['period'] == 2)
    {
      // 90 days
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
    }
    else if($form_data['period'] == 3)
    {
      // 1 Year
      $condition ="WHERE `datetime` BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
    }
    
    $new_reg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS `count` FROM `user_cred` $condition"));
    $queries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS `count` FROM `user_queries` $condition"));
    $reviews = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS `count` FROM `rate_review` $condition"));

    $result = [
      "new_reg" => $new_reg['count'],
      "queries" => $queries['count'],
      "reviews" => $reviews['count'],
    ];

    echo json_encode($result);
  }


?>