<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">USER QUERIES</h4>
  
        <div class="card border-0 shadow-sm">
          <div class="card-body">

            <div class="text-end mb-4">
               <a href='javascript:void(0)' onclick="mark_all_queries()" class="badge rounded-pill text-bg-primary text-decoration-none py-2 px-3"><i class="bi bi-check-all fs-6"></i> Mark all seen</a>

               <a href='javascript:void(0)' onclick="remove_all_queries()" class="badge rounded-pill text-bg-danger text-decoration-none py-2 px-3"><i class="bi bi-trash3 fs-6"></i> Delete all</a>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 450px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="25%">Subject</th>
                    <th scope="col" width="25%">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="queries_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
      
      </div>
    </div>
  </section>


  <script>
    function get_queries()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/user_queries.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#queries_data").innerHTML = this.responseText;
      }

      xhr.send("get_queries");
    }

    function mark_queries(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/user_queries.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Changes Saved!');
          get_queries();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("id="+id+"&action=mark_queries");
    }

    function remove_queries(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/user_queries.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Queries Deleted!');
          document.querySelector("#queries_row"+id).remove();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("id="+id+"&action=remove_queries");
    }

    function mark_all_queries() 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/user_queries.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Changes Saved!');
          get_queries();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("action=mark_all_queries");
    }

    function remove_all_queries() 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/user_queries.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'All queries deleted!');
          get_queries();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("action=remove_all_queries");
    }

    window.onload = function()
    {
      get_queries();
    }
  </script>

<?php 
  require "inc/footer.php";
?>