<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['get_bookings']))
  {
    $form_data = filtration($_POST);

    $page_no = $form_data['page'];
    $limit = 10;
    $offset = ($page_no - 1) * $limit;

    $query = "SELECT bo.*, bd.* FROM `booking_order` AS bo 
              INNER JOIN `booking_details` AS bd ON bo.booking_id = bd.booking_id 
              WHERE (bo.order_id LIKE ? OR bd.user_name LIKE ? OR bd.phone_num LIKE ?)
              AND ((bo.booking_status = 'booked' AND bo.arrival = 1) 
                  OR (bo.booking_status = 'cancelled' AND `refund` = 1))
              ORDER BY bo.booking_id DESC";

    $res = select($query, 'sss', ["%".$form_data['search']."%", "%".$form_data['search']."%", "%".$form_data['search']."%"]);

    $limited_query = $query." LIMIT $offset, $limit";
    $limited_res = select($limited_query, 'sss', ["%".$form_data['search']."%", "%".$form_data['search']."%", "%".$form_data['search']."%"]);

    $html = '';
    if(mysqli_num_rows($limited_res) > 0)
    {
      $sl = $offset + 1;
      while($row = mysqli_fetch_assoc($limited_res))
      {
        $check_in = date('d-m-Y', strtotime($row['check_in']));
        $check_out = date('d-m-Y', strtotime($row['check_out']));
        $date = date('d-m-Y', strtotime($row['datetime']));

        if($row['booking_status'] == 'booked')
        {
          $status_class = "bg-primary";
        }
        else if($row['booking_status'] == 'cancelled')
        {
          $status_class = "bg-danger";
        }

        $html .= '<tr>
                    <td>'.$sl.'</td>
                    <td>
                      <span class="badge bg-primary">Order ID: '.$row['order_id'].'</span>
                      <br>
                      <span><b>Name:</b> '.$row['user_name'].'</span>
                      <br>
                      <span><b>Phone:</b> '.$row['phone_num'].'</span>
                    </td>
                   
                    <td>
                      <span><b>Room:</b> '.$row['room_name'].'</span>
                      <br>
                      <span><b>Checkin:</b> '.$check_in.'</span>
                      <br>
                      <span><b>Checkout:</b> '.$check_out.'</span>
                      <br>
                      <span><b>Date:</b> '.$date.'</span>
                    </td>
                    <td>
                      <span><b>$'.$row['trans_amt'].'</b></span>
                    </td>
                     <td>
                      <span class="badge '.$status_class.'">'.$row['booking_status'].'</span>
                    </td>
                    <td>
                      <button type="button" onclick="download('.$row['booking_id'].')" class="btn btn-outline-primary btn-sm shadow-none">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                      </button>
                    </td>
                 </tr>';
    
                $sl++;
      }

      $pagination = "";

      $total_rows = mysqli_num_rows($res);
      if($total_rows > $limit)
      {
        $total_pages = ceil($total_rows / $limit);

        $prev = $page_no - 1;
        $disabled = ($page_no == 1) ? "disabled" : "";

        $pagination .= '<li class="page-item '.$disabled.'">
          <a class="page-link shadow-none" onclick="change_page('.$prev.')" href="javascript:void(0)">Prev</a>
        </li>';

        for ($i = 1; $i <= $total_pages; $i++) 
        { 
          $active_class = ($page_no == $i) ? "active" : "";

          $pagination .= '<li class="page-item '.$active_class.'">
            <a class="page-link shadow-none" onclick="change_page('.$i.')" href="javascript:void(0)">'.$i.'</a>
          </li>';
        }

        $next = $page_no + 1;
        $disabled = ($page_no == $total_pages) ? "disabled" : "";
        $pagination .= '<li class="page-item '.$disabled.'">
          <a class="page-link shadow-none" onclick="change_page('.$next.')" href="javascript:void(0)">Next</a>
        </li>';

      }

      $output = [
        "table_data" => $html,
        "pagination" => $pagination
      ];

    }
    else 
    {
      $output = [
        "table_data" => "<tr>
                 <td colspan='6'>No data found</td>
               </tr>",
        "pagination" => ""
      ];
    }

    echo json_encode($output);
  }


?>