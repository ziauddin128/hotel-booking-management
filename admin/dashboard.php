<?php 
  require "inc/top.php";

  $is_shutdown = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `shutdown` FROM `settings`"));

  $current_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT 
  COUNT(CASE WHEN `booking_status` = 'booked' AND `arrival` = 0 THEN 1 END) AS `new_bookings`,
  COUNT(CASE WHEN `booking_status` = 'cancelled' AND `refund` = 0 THEN 1 END) AS `refund_bookings`
  FROM `booking_order`"));

  $unread_queries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS `count` FROM `user_queries` WHERE `seen` = 0"));
  $unread_reviews = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS `count` FROM `rate_review` WHERE `seen` = 0"));

?>

  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
          <h4>DASHBOARD</h4>
          <?php 
           if($is_shutdown['shutdown'])
           {
            ?>
            <h6 class="badge bg-danger rounded py-2 px-3">Shutdown Mode is Active!</h6>
            <?php 
           }
          ?>
        </div>

        <div class="row mb-4">

          <div class="col-md-6 col-lg-3 mb-4">
          <a href="new-bookings" class="card rounded text-center text-success p-3 text-decoration-none">
            <h6>New Bookings</h6>
            <h1 class="mt-2 mb-0"><?= $current_bookings['new_bookings'] ?></h1>
          </a>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
          <a href="refund-bookings" class="card rounded text-center text-warning p-3 text-decoration-none">
            <h6>Refund Bookings</h6>
            <h1 class="mt-2 mb-0"><?= $current_bookings['refund_bookings'] ?></h1>
          </a>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
          <a href="user-queries" class="card rounded text-center text-info p-3 text-decoration-none">
            <h6>User Queries</h6>
            <h1 class="mt-2 mb-0"><?= $unread_queries['count'] ?></h1>
          </a>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
          <a href="rate-review" class="card rounded text-center text-primary p-3 text-decoration-none">
            <h6>Rating & Review</h6>
            <h1 class="mt-2 mb-0"><h1 class="mt-2 mb-0"><?= $unread_reviews['count'] ?></h1></h1>
          </a>
          </div>

        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
          <h4>BOOKING ANALYTICS</h4>

          <select class="form-select w-auto shadow-none" onchange="booking_analytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="4">All Time</option>
          </select>
        </div>

        <div class="row mb-4">

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-primary p-3">
              <h6>Total Bookings</h6>
              <h1 class="mt-2 mb-0" id="total_bookings">0</h1>
              <h1 class="mt-2 mb-0" id="total_amt">$0</h1>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-success p-3">
              <h6>Active Bookings</h6>
              <h1 class="mt-2 mb-0" id="active_bookings">0</h1>
              <h1 class="mt-2 mb-0" id="active_amt">$0</h1>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-danger p-3">
              <h6>Cancelled Bookings</h6>
              <h1 class="mt-2 mb-0" id="refund_bookings">0</h1>
              <h1 class="mt-2 mb-0" id="refund_amt">$0</h1>
            </div>
          </div>

        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
          <h4>Users, Queries, Review ANALYTICS</h4>

          <select class="form-select w-auto shadow-none" onchange="query_analytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="4">All Time</option>
          </select>
        </div>

        <div class="row mb-4">

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-primary p-3">
              <h6>New Registration</h6>
              <h1 class="mt-2 mb-0" id="new_reg">0</h1>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-success p-3">
              <h6>Queries</h6>
              <h1 class="mt-2 mb-0" id="queries">0</h1>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 mb-4">
            <div class="card rounded text-center text-info p-3">
              <h6>Review</h6>
              <h1 class="mt-2 mb-0" id="reviews">0</h1>
            </div>
          </div>

        </div>
      
      </div>
    </div>
  </section>

  <script>

    function booking_analytics(period = 1)
    {
      let form_data = new FormData();
      form_data.append("action","booking_analytics");
      form_data.append("period", period);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/dashboard.php");

      xhr.onload = function()
      {
        let data = JSON.parse(this.responseText);

        document.querySelector("#total_bookings").textContent = data.total_bookings;
        document.querySelector("#total_amt").textContent = "$"+data.total_amt;

        document.querySelector("#active_bookings").textContent = data.active_bookings;
        document.querySelector("#active_amt").textContent = "$"+data.active_amt;

        document.querySelector("#refund_bookings").textContent = data.refund_bookings;
        document.querySelector("#refund_amt").textContent = "$"+data.refund_amt;
      }

      xhr.send(form_data);
    }

    function query_analytics(period = 1)
    {
      let form_data = new FormData();
      form_data.append("action","query_analytics");
      form_data.append("period", period);

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/dashboard.php");

      xhr.onload = function()
      {
        let data = JSON.parse(this.responseText);

        document.querySelector("#new_reg").textContent = data.new_reg;
        document.querySelector("#queries").textContent = data.queries;
        document.querySelector("#reviews").textContent = data.reviews;
      }

      xhr.send(form_data);
    }


    window.onload = function()
    {
      booking_analytics();
      query_analytics();
    }
  </script>

<?php 
  require "inc/footer.php";
?>