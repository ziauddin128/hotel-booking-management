<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">NEW BOOKINGS</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex justify-content-end mb-4">
              <input type="text" class="form-control shadow-none w-25" name="search_user" oninput="new_bookings(this.value)" placeholder="Search by name">
            </div>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">SL</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Bookings Details</th>
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


  <!-- assign room Modal -->
  <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Assign Room No</h1>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="assign_room_form">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Room No</label>
              <input type="text" class="form-control shadow-none" name="room_no" required>
            </div>

            <span class="badge text-bg-light mb-3 text-wrap lh-base">
                Note: Assign room only when user arrive.
            </span>

            <input type="hidden" name="booking_id">
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
          </div>
        </form>

      </div>
    </div>
  </div>


  <script>
    function new_bookings(search='')
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/new_bookings.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#table_data").innerHTML = this.responseText;
      }

      xhr.send("new_bookings&search="+search);
    }

    let assign_room_form = document.querySelector("#assign_room_form");

    function assign_room(id)
    {
      assign_room_form.elements['booking_id'].value = id;
    }

    assign_room_form.addEventListener("submit", function(e)
    {
      e.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "assign_room");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/new_bookings.php", true);

      xhr.onload = function()
      {
        const modalElement = document.getElementById('assign-room');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();

        if(this.responseText == 1)
        {
          alert('success', 'Room number alloted. Booking Finalize!');
          new_bookings();
        }
        else 
        {
          alert('error', 'Server Down!');
        }
      }
      xhr.send(form_data);
    })
    
    function cancel_booking(id) 
    {
      if(confirm("Are you sure? You want to cancel this booking?"))
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/new_bookings.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function()
        {
          if(this.responseText == 1)
          {
            alert('success', 'Booking has been cancelled!');
            new_bookings();
          }
          else 
          {
            alert('error', 'Server Down!');
          }
        }
        xhr.send("id="+id+"&action=cancel_booking");
      }
      
    }
   

    window.onload = function()
    {
      new_bookings();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>