<?php 
    require "inc/config.php";
    require "inc/function.php";
    require "inc/mpdf/vendor/autoload.php";
    adminLogin();

    if(isset($_GET['gen_pdf']) && isset($_GET['id']))
    {
        $form_data = filtration($_GET);

        $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` AS bo 
              INNER JOIN `booking_details` AS bd ON bo.booking_id = bd.booking_id 
              INNER JOIN `user_cred` AS uc ON bo.user_id = uc.id
              WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1) 
                    OR (bo.booking_status = 'cancelled' AND `refund` = 1))
                    AND bo.booking_id = '{$form_data['id']}'";

        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_assoc($res);

            $table_data = '';
            $table_data .= '<h2>BOOKING RECEIPT</h2>';

            $check_in = date('d-m-Y', strtotime($row['check_in']));
            $check_out = date('d-m-Y', strtotime($row['check_out']));
            $date = date('H:ia d-m-Y', strtotime($row['datetime']));

            $table_data .= '<table border="1" style="border-collapse: collapse">';

            $table_data .= '<tr>
              <td>Order ID: '.$row['order_id'].'</td>
              <td>Booking Date: '.$date.'</td>
            <tr>
            
            <tr>
              <td colspan="2">Status: '.ucfirst($row['booking_status']).'</td>
            <tr>

            <tr>
              <td>Name: '.$row['user_name'].'</td>
              <td>Email: '.$row['email'].'</td>
            <tr>

            <tr>
              <td>Phone Number: '.$row['phone_num'].'</td>
              <td>Address: '.$row['address'].'</td>
            <tr>

            <tr>
              <td>Room Name: '.$row['room_name'].'</td>
              <td>Cost: $'.$row['price'].' per night</td>
            <tr>

            <tr>
              <td>Check-in: '.$check_in.'</td>
              <td>Check-out: '.$check_out.'</td>
            <tr>
            ';
            
            if($row['booking_status'] == "cancelled")
            {
                $refund = ($row['refund']) ? "Amount Refunded" : "Not Refund Yet";

                $table_data .= '<tr>
                        <td>Amount Paid: $'.$row['trans_amt'].'</td>
                        <td>Refund: '.$refund.'</td>
                        <tr>';
            }
            else
            {
               $table_data .=' <tr>
                <td>Room No: '.$row['room_no'].'</td>
                <td>Amount Paid: $'.$row['trans_amt'].'</td>
                <tr> ';
            }

            $table_data .= '</table>';
            
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($table_data);
            $mpdf->Output($row['order_id'].'.pdf', 'D');
        }
        else 
        {
            redirect('dashboard'); 
        }
    }
    else 
    {
        redirect('dashboard');
    }
?>