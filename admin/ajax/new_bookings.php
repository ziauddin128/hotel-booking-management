<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['new_bookings']))
  {
    $form_data = filtration($_POST);

    $query = "SELECT bo.*, bd.* FROM `booking_order` AS bo 
              INNER JOIN `booking_details` AS bd ON bo.booking_id = bd.booking_id 
              WHERE (bo.order_id LIKE ? OR bd.user_name LIKE ? OR bd.phone_num LIKE ?)
              AND bo.arrival = ? AND bo.booking_status = ?";

    $res = select($query, 'sssis', ["%".$form_data['search']."%", "%".$form_data['search']."%", "%".$form_data['search']."%", 0, "booked"]);

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
                      <span><b>Price:</b> $'.$row['price'].'</span>
                    </td>
                    <td>
                      <span><b>Checkin:</b> '.$check_in.'</span>
                      <br>
                      <span><b>Checkout:</b> '.$check_out.'</span>
                      <br>
                      <span><b>Paid:</b> $'.$row['trans_amt'].'</span>
                      <br>
                      <span><b>Date:</b> '.$date.'</span>
                    </td>
                    <td>
                      <button type="button" onclick="assign_room('.$row['booking_id'].')" class="btn custom-bg btn-sm text-white fw-bold shadow-none" data-bs-toggle="modal" data-bs-target="#assign-room">
                        <i class="bi bi-check2-square"></i> Assign Room
                      </button>
                      <br>
                      <button type="button" onclick="cancel_booking('.$row['booking_id'].')" class="btn btn-outline-danger btn-sm mt-2 fw-bold shadow-none">
                        <i class="bi bi-trash"></i> Cancel Booking
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

  if(isset($_POST['action']) && $_POST['action'] == "assign_room")
  {
    $form_data = filtration($_POST);

    $query = "UPDATE `booking_order` AS bo 
              INNER JOIN `booking_details` AS bd 
              ON bo.booking_id = bd.booking_id
              SET bo.arrival = ?, bd.room_no = ?
              WHERE bo.booking_id = ?";
    $data_types = 'isi';
    $values = [1, $form_data['room_no'], $form_data['booking_id']];

    $res = update($query, $data_types, $values); // it will update 2 tables 2 rows and it will return 2

    echo ($res == 2) ? 1 : 0;
  }

  if(isset($_POST['action']) && $_POST['action'] == "cancel_booking")
  {
    $form_data = filtration($_POST);

    $query = "UPDATE `booking_order` SET `refund` = ?, `booking_status` = ? WHERE `booking_id` = ?";
    $data_types = 'isi';
    $values = [0, "cancelled", $form_data['id']];

    $res = update($query, $data_types, $values); 
    echo $res;
  }

?>