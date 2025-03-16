<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">REFUND BOOKINGS</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex justify-content-end mb-4">
              <input type="text" class="form-control shadow-none w-25" name="search_user" oninput="get_bookings(this.value)" placeholder="Search by name">
            </div>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">SL</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Refund Amount</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
      
      </div>
    </div>
  </section>


  <script>
    function get_bookings(search='')
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/refund_bookings.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#table_data").innerHTML = this.responseText;
      }

      xhr.send("get_bookings&search="+search);
    }
    
    function refund_bookings(id) 
    {
      if(confirm("You want to refund for this booking?"))
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/refund_bookings.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function()
        {
          if(this.responseText == 1)
          {
            alert('success', 'Money refunded!');
            get_bookings();
          }
          else 
          {
            alert('error', 'Server Down!');
          }
        }
        xhr.send("id="+id+"&action=refund_booking");
      }
      
    }

    window.onload = function()
    {
      get_bookings();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>