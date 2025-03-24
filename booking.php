<?php 
 require "top.php";

 if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
 {
  redirect('index');
 }

?> 

<section class="py-5">
  <div class="container">

    <div class="mb-4" style="font-size: 14px;">
      <a href="index" class="text-secondary text-decoration-none">HOME</a>
      <span class="text-secondary"> > </span>
      <a href="booking" class="text-secondary text-decoration-none">BOOKINGS</a>
    </div>

    <div class="row">

      <?php 
        $query = "SELECT bo.*, bd.* FROM `booking_order` AS bo 
        INNER JOIN `booking_details` AS bd ON bo.booking_id = bd.booking_id 
        WHERE bo.booking_status != 'pending'
        AND bo.user_id = ? ORDER BY bo.booking_id DESC";
        
        $data_types = 'i';
        $values = [$_SESSION['USER_ID']];
        
        $result = select($query, $data_types, $values);

        if($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc())
          {
            $check_in = date('d-m-Y', strtotime($row['check_in']));
            $check_out = date('d-m-Y', strtotime($row['check_out']));
            $date = date('d-m-Y', strtotime($row['datetime']));

            $status_bg = "";
            $btn = "";

            if($row['booking_status'] == "booked")
            {
              $status_bg = "bg-primary";

              if($row['arrival'] == 1)
              {
                $btn = '<a href="generate-pdf?gen_pdf&id='.$row['booking_id'].'" class="btn btn-dark btn-sm shadow-none">
                         Download PDF
                      </a>  
                      <button type="button" class="btn btn-dark btn-sm shadow-none">
                         Rate & Review
                      </button>';
              }
              else 
              {
                $btn = '<button type="button" onclick="cancel_booking('.$row['booking_id'].')" class="btn btn-danger btn-sm shadow-none">
                        Cancel Booking
                     </button>';
              }
            }
            else if($row['booking_status'] == "cancelled")
            {
              $status_bg = "bg-danger";

              if($row['refund'] == 0)
              {
                $btn = '<span class="badge bg-primary p-2">Refund in Process</span>';
              }
              else 
              {
                $btn = '<a href="generate-pdf?gen_pdf&id='.$row['booking_id'].'" class="btn btn-dark btn-sm shadow-none">
                         Download PDF
                      </a>  ';
              }
            }
            else 
            {
              $status_bg = "bg-warning";
            }

            ?>
            
            <div class="col-md-4 mb-4">
              <div class="bg-white shadow-sm rounded p-4">
                <h4><?= $row['room_name'] ?></h4>
                <p>$<?= $row['price'] ?> Per night</p>

                <p>
                  <b>Check-in:</b> <?= $check_in ?> <br>
                  <b>Check-out:</b> <?= $check_out ?>
                </p>

                <p>
                  <b>Amount:</b> $<?= $row['trans_amt'] ?> <br>
                  <b>Order ID:</b> <?= $row['order_id'] ?>  <br>
                  <b>Date:</b> <?= $date ?>
                </p>

                <p>
                  <span class="badge <?= $status_bg ?>"><?= ucfirst($row['booking_status']) ?></span>
                </p>

                <?= $btn ?>

              </div>
            </div>

            <?php 
          }
        }

      ?>

        
    </div>

  </div>
</section>

<?php 

if (isset($_GET['cancel_booking'])) 
{
  if ($_GET['cancel_booking'] == 'true') {
      alert('success', 'Booking cancel successful');
  } else {
      alert('error', 'Booking cancel failed');
  }
}

?>


<script>
  function cancel_booking(id)
  {
    if(confirm("Are you sure? You want to cancel booking."))
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/cancel_booking.php");
      xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          window.location.href = "booking?cancel_booking=true";
        }
        else 
        {
          window.location.href = "booking?cancel_booking=false";
        }
      }

      xhr.send('action=cancel_booking&id='+id);
    }
  }
</script>

<?php 
 require "footer.php";
?> 
