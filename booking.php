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
                      </a>';
                if($row['rate_review'] == 0)
                {
                  $btn .= '<button type="button" onclick="review_id_set('.$row['booking_id'].', '.$row['room_id'].')" class="btn btn-dark btn-sm shadow-none ms-2" data-bs-toggle="modal" data-bs-target="#rateModal">
                        Rate & Review
                    </button>';
                }

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


<!-- rate modal -->
<div class="modal fade" id="rateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
      <form id="rate_form">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5 d-flex align-items-center">
                  <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i>
                  Rate & Review
                  </h1>
                  <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label">Rate</label>
                      <select name="rate" class="form-select shadow-none">
                        <option value="5">Excellent</option>
                        <option value="4">Good</option>
                        <option value="3">Ok</option>
                        <option value="2">Poor</option>
                        <option value="1">Bad</option>
                      </select>
                  </div>
                  <div class="mb-4">
                      <label class="form-label">Review</label>
                      <textarea name="review" class="form-control shadow-none" required></textarea>
                  </div>

                  <input type="hidden" name="booking_id">
                  <input type="hidden" name="room_id">

                  <div class="d-flex align-items-center justify-content-end">
                      <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                  </div>
              </div>
          </div>
      </form>
  </div>
</div>


<?php 

if (isset($_GET['cancel_booking'])) 
{
  if ($_GET['cancel_booking'] == 'true') {
      alert('success', 'Booking cancel successful');
  } else {
      alert('error', 'Booking cancel failed');
  }
}

if (isset($_GET['rate'])) 
{
  alert('success', 'Thank you for Rate & Review');
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

  let rate_form = document.querySelector("#rate_form");

  function review_id_set(booking_id, room_id)
  {
    rate_form.elements['booking_id'].value = booking_id;
    rate_form.elements['room_id'].value = room_id;
  }

  rate_form.addEventListener("submit", function(event)
  {
    event.preventDefault();

    let form_data = new FormData(this);
    form_data.append("action", "rate_review");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rate_review.php");

    xhr.onload = function()
    {
      const modalElement = document.getElementById('rateModal');
      const modalInstance = bootstrap.Modal.getInstance(modalElement); 
      modalInstance.hide();

      if(this.responseText == 1)
      {
        window.location.href = "booking?rate=true";
        rate_form.reset();
      }
      else 
      {
        alert("error", "Rating failed! Server Down!");
      }
    }
    xhr.send(form_data);
    
  })
</script>

<?php 
 require "footer.php";
?> 
