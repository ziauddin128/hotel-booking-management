<?php 
 require "top.php";


 if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
 {
  redirect('index');
 }
?> 

<section class="py-5">
    <div class="container">

    <div class="mb-3 bg-white shadow-sm rounded p-3">
      <div>
        <p class="fw-bold alert alert-danger p-3 rounded">
          <i class="bi bi-exclamation-triangle-fill"></i>
          Payment Cancelled! 
          <br><br>
          <a href="booking">Go to bookings</a>
        </p>
      </div>
    </div>

    </div>
</section>

<?php 
 require "footer.php";
?> 

