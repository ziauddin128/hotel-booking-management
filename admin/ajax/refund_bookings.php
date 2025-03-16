<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['get_bookings']))
  {
    $form_data = filtration($_POST);

    $query = "SELECT bo.*, bd.* FROM `booking_order` AS bo 
              INNER JOIN `booking_details` AS bd ON bo.booking_id = bd.booking_id 
              WHERE (bo.order_id LIKE ? OR bd.user_name LIKE ? OR bd.phone_num LIKE ?)
              AND bo.refund = ? AND bo.booking_status = ?";

    $res = select($query, 'sssis', ["%".$form_data['search']."%", "%".$form_data['search']."%", "%".$form_data['search']."%", 0, "cancelled"]);

    $html = '';
    if(mysqli_num_rows($res) > 0)
    {
      $sl = 1;

      while($row = mysqli_fetch_assoc($res))
      {

        $check_in = date('d-m-Y', strtotime($row['check_in']));
        $check_out = date('d-m-Y', strtotime($row['check_out']));
        $date = date('d-m-Y', strtotime($row['datetime']));

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
                      <button type="button" onclick="refund_bookings('.$row['booking_id'].')" class="btn custom-bg btn-sm text-white fw-bold shadow-none">
                        <i class="bi bi-cash-stack"></i> Refund
                      </button>
                    </td>
                 </tr>';
      }
    }
    else 
    {
      $html .= '<tr>
                 <td colspan="5">No data found</td>
               </tr>';
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "refund_booking")
  {
    $form_data = filtration($_POST);

    $query = "UPDATE `booking_order` SET `refund` = ? WHERE `booking_id` = ?";
    $data_types = 'ii';
    $values = [1, $form_data['id']];

    $res = update($query, $data_types, $values); 
    echo $res;
  }

?>