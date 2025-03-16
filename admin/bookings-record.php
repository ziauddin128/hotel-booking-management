<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">BOOKINGS RECORD</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex justify-content-end mb-4">
              <input type="text" class="form-control shadow-none w-25" id="search_input" name="search_user" oninput="get_bookings(this.value)" placeholder="Search by name">
            </div>

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">SL</th>
                    <th scope="col">User Details</th>
                    <th scope="col">Room Details</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table_data">
                  
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-end">
              <nav>
                <ul class="pagination mt-3" id="pagination">
                </ul>
              </nav>
            </div>

          </div>
        </div>
      
      </div>
    </div>
  </section>

  <script>
    function get_bookings(search='', page = 1)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/bookings-record.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        let data = JSON.parse(this.responseText);

        document.querySelector("#table_data").innerHTML = data.table_data;
        document.querySelector("#pagination").innerHTML = data.pagination;
      }

      xhr.send("get_bookings&search="+search+'&page='+page);
    }

    function change_page(page_no)
    {
      get_bookings(document.querySelector("#search_input").value ,page_no);
    }

    function download(id)
    {
      window.location.assign('generate-pdf.php?gen_pdf&id='+id);
    }

    window.onload = function()
    {
      get_bookings();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>