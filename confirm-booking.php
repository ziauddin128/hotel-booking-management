<?php 
 require "top.php";

 if(!isset($_GET['id']))
 {
    redirect('rooms');
 }

 if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
 {
  redirect('index');
 }

 $form_data = filtration($_GET);

 $room_sql = "SELECT * FROM `rooms` WHERE `status` = ? AND `removed` = ? AND `id` = ?"; 
 $room_res = select($room_sql, "iii", [1,0, $form_data['id']]);
 if($room_res->num_rows == 0)
 {
   redirect('rooms');
 }
 $room_row = $room_res->fetch_assoc();

 $_SESSION['room'] = [
   "id" =>  $room_row['id'],
   "name" =>  $room_row['name'],
   "price" =>  $room_row['price'],
   "payment" =>  null,
   "available" =>  null,
 ]

?> 

<section class="py-5">
    <div class="container">

      <div class="row">

          <div class="col-lg-7">
            <div class="mb-3 bg-white shadow-sm rounded p-3">

            <?php 
              $image_q = "SELECT * FROM `room_image` WHERE `room_id` = '{$room_row['id']}' AND `thumb` = 1";
              $image_res = mysqli_query($conn, $image_q);
              if(mysqli_num_rows($image_res) > 0)
              {
                $image_row = mysqli_fetch_assoc($image_res);
                ?>
                 <img src="<?= IMAGE_PATH ?>rooms/<?= $image_row['image'] ?>" class="d-block w-100 rounded img-fluid">
                <?php 
              }
              else 
              {
                $image = "thumbnail.jpg";
                ?>
                  <img src="<?= IMAGE_PATH ?>rooms/thumbnail.jpg" class="d-block w-100 rounded img-fluid">
                <?php 
              }
            ?>
            <h4 class="mt-3 mb-0"><?= $room_row['name'] ?></h4>
            <h5>$<?= $room_row['price'] ?> per night</h5>

           </div> 
          </div>

          <div class="col-lg-5">
            <div class="bg-white shadow-sm rounded p-4">
              <h5>BOOKING DETAILS</h5>

              <form id="booking_form" action="pay_now.php" method="POST">
                <div class="row">

                  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control shadow-none" value="<?= $_SESSION['USER_NAME'] ?>" name="name" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control shadow-none" value="<?= $_SESSION['USER_PHONE'] ?>"  name="phone_no" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control shadow-none" rows="2" name="address" required><?= $_SESSION['USER_ADDRESS'] ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Check In</label>
                        <input type="date" class="form-control shadow-none" name="checkin" onchange="check_ability()" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Check Out</label>
                        <input type="date" class="form-control shadow-none" name="checkout" onchange="check_ability()" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="spinner-border text-info d-none" id="info_loader" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>

                    <h6 class="text-danger mb-3" id="pay_info">Provide Check-in & Check-out date!</h6>

                    <button name="pay_btn" class="btn w-100 custom-bg shadow-none text-white" disabled>Pay Now</button>
                  </div>

                </div>
              </form>

            </div>
          </div>
          
      </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 

<script>
  let booking_form = document.querySelector("#booking_form");
  let info_loader = document.querySelector("#info_loader");
  let pay_info = document.querySelector("#pay_info");

  function check_ability()
  {
    let checkin = booking_form.elements['checkin'].value;
    let checkout = booking_form.elements['checkout'].value;

    booking_form.elements['pay_btn'].setAttribute("disabled", true);

    if(checkin !="" && checkout !="")
    {
      pay_info.classList.add("d-none");
      pay_info.classList.replace("text-dark", "text-danger");
      info_loader.classList.remove("d-none");

      let form_data =  new FormData();
      form_data.append("check_ability", true);
      form_data.append("checkin", checkin);
      form_data.append("checkout", checkout);
      
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/confirm_booking.php");

      xhr.onload = function()
      {

        let data = JSON.parse(this.responseText);

        if(data.status == "checkin_out_days_equal")
        {
          pay_info.innerText = "Check in & out can't be equal";
        }
        else if(data.status == "checkin_earlier")
        {
          pay_info.innerText = "Check-in date can't earlier from today's";
        }
        else if(data.status == "checkout_earlier")
        {
          pay_info.innerText = "Check-out date can't earlier from check-in";
        }
        else if(data.status == "unavailable")
        {
          pay_info.innerText = "Room not available for this check-in date";
        }
        else 
        {
          pay_info.innerHTML = `No. of days ${data.days} <br> Total amount to pay $${data.payment}`;
          pay_info.classList.replace("text-danger","text-dark");
          booking_form.elements['pay_btn'].removeAttribute("disabled");
        }

        pay_info.classList.remove("d-none");
        info_loader.classList.add("d-none");
      }

      xhr.send(form_data);
    }

  }



</script>
