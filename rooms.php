<?php 
 require "top.php";

 $checkin_default = "";
 $checkout_default = "";
 $adults_default = "";
 $children_default = "";

 if(isset($_GET['check_availability']))
 {
   $frm_data = filtration($_GET);

   $checkin_default = $frm_data['checkin'];
   $checkout_default = $frm_data['checkout'];
   $adults_default = $frm_data['adults'];
   $children_default = $frm_data['children'];
 }


?> 

<section class="py-5">
    <div class="container-fluid">

        <h2 class="h-font text-center mt-5 mb-4">OUR ROOMS</h2>

        <div class="row"> 

          <div class="col-lg-3 mb-3 ps-lg-4">
              <nav class="navbar navbar-expand-lg bg-white shadow rounded p-3">
                  <div class="container-fluid flex-row flex-lg-column align-items-baseline p-0">
                      <h4 class="my-0">FILTER</h4>
                      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown">
                      <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse flex-column align-items-stretch w-100" id="filterDropdown">

                          <!-- check availability -->

                          <div class="border bg-light py-3 px-2 mt-3 rounded">
                              <h4 class="mb-2 d-flex align-items-center justify-content-between" style="font-size: 16px;">
                                <span>CHECK AVAILABILITY</span>
                                <button type="button" class="shadow-none btn btn-sm text-secondary d-none" id="check_avail_btn" onclick="clear_avail_filter()">Reset</button>
                              </h4>
                              <div class="mb-3">
                                  <label class="form-label">Check-in</label>
                                  <input type="date" onchange="check_avail_filter()" value="<?= $checkin_default ?>" class="form-control shadow-none" id="checkin">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Check-out</label>
                                  <input type="date" onchange="check_avail_filter()" value="<?= $checkout_default ?>" class="form-control shadow-none" id="checkout">
                              </div>
                          </div>

                          <!-- facilities -->

                          <div class="border bg-light py-3 px-2 mt-3 rounded">

                              <h4 class="mb-2 d-flex align-items-center justify-content-between" style="font-size: 16px;">
                                <span>FACILITIES</span>
                                <button type="button" class="shadow-none btn btn-sm text-secondary d-none" id="facility_btn" onclick="facility_clear()">Reset</button>
                              </h4>

                              <?php 
                                $facility_q = selectAll('facilities');
                                while($facility_row = $facility_q->fetch_assoc())
                                {
                                  ?>
                                  <div class="d-flex gap-2 mb-1">
                                      <input type="checkbox" class="form-check-input shadow-none" value="<?= $facility_row['id'] ?>" name="facilities" id="f_<?= $facility_row['id'] ?>" style="cursor: pointer" onclick="fetch_rooms()">
                                      
                                      <label for="f_<?= $facility_row['id'] ?>" class="form-label m-0" style="cursor: pointer"><?= $facility_row['facility_name'] ?></label>
                                  </div>
                                  <?php 
                                }
                              ?>
                             
                          </div>

                          <!-- guests -->

                          <div class="border bg-light py-3 px-2 mt-3 rounded">
                              <h4 class="mb-2 d-flex align-items-center justify-content-between" style="font-size: 16px;">
                                <span>GUESTS</span>
                                <button type="button" class="shadow-none btn btn-sm text-secondary d-none" id="guests_btn" onclick="guest_clear()">Reset</button>
                              </h4>

                              <div class="d-flex gap-2">
                                  <div>
                                    <label for="" class="form-label">Adults</label>
                                    <input type="number" min="1" value="<?= $adults_default ?>" class="form-control shadow-none" id="adults" oninput="guests_filter()">
                                  </div>
                                  <div>
                                    <label for="" class="form-label">Children</label>
                                    <input type="number" min="1" value="<?= $children_default ?>" class="form-control shadow-none" id="children" oninput="guests_filter()">
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              </nav>
          </div>

          <div class="col-lg-9">
            <div class="rooms-card" id="rooms_data">



            </div>
          </div>
           
        </div>

    </div>
</section>

<script>
  let rooms_data = document.querySelector("#rooms_data");
  let checkin = document.querySelector("#checkin");
  let checkout = document.querySelector("#checkout");
  let check_avail_btn = document.querySelector("#check_avail_btn");

  let adults = document.querySelector("#adults");
  let children = document.querySelector("#children");
  let guests_btn = document.querySelector("#guests_btn");

  let facility_btn = document.querySelector("#facility_btn");
  

  function fetch_rooms()
  {

    let chk_avail = JSON.stringify(
      {
        checkin : checkin.value,
        checkout : checkout.value,
      }
    )

    let guests = JSON.stringify(
      {
        adults : adults.value,
        children : children.value,
      }
    )


    let facilities_list = {"facilities" : []};

    let get_facilities = document.querySelectorAll('[name="facilities"]:checked');

    if(get_facilities.length > 0)
    {
      get_facilities.forEach(facility => {
        facilities_list.facilities.push(facility.value);
      });

      
      facility_btn.classList.remove("d-none");
    }
    else 
    {
      facility_btn.classList.add("d-none");
    }

    facilities_list = JSON.stringify(facilities_list);


    let xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax/rooms.php?get_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facilities_list="+facilities_list, true);

    xhr.onprogress = function()
    {
      rooms_data.innerHTML = `<div class="spinner-border text-info d-block mx-auto" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>`;
    }

    xhr.onload = function()
    {
      rooms_data.innerHTML = this.responseText;
    }

    xhr.send();

  }

  function check_avail_filter()
  {
    if(checkin.value !="" && checkout.value !="")
    {
      fetch_rooms();
      check_avail_btn.classList.remove("d-none")
    }
  }
  
  function clear_avail_filter()
  {
    checkin.value ="";
    checkout.value ="";
    check_avail_btn.classList.add("d-none");
    fetch_rooms();
  }

  function guests_filter()
  {
    if(adults.value > 0 || children.value > 0)
    {
      fetch_rooms();
      guests_btn.classList.remove("d-none")
    }
  }

  function guest_clear()
  {
    adults.value ="";
    children.value ="";
    guests_btn.classList.add("d-none");
    fetch_rooms();
  }

  function facility_clear()
  {

    let get_facilities = document.querySelectorAll('[name="facilities"]:checked');

    get_facilities.forEach(facility => {
      facility.checked = false;
    });

    facility_btn.classList.add("d-none");
    fetch_rooms();
  }


  window.onload = function()
  {
    fetch_rooms();
  }

</script>

<?php 
 require "footer.php";
?> 
