<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">USERS</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex justify-content-end mb-4">
              <input type="text" class="form-control shadow-none w-25" name="search_user" oninput="search_user(this.value)" placeholder="Search by name">
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 450px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone no.</th>
                    <th scope="col">Location</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
       
      
      </div>
    </div>
  </section>


  <script>
    function get_users()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/users_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#users_data").innerHTML = this.responseText;
      }

      xhr.send("get_users");
    }

    function users_status(val, id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/users_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Changes Saved!');
          get_users();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("val="+val+"&id="+id+"&action=users_status");
    }

    function user_remove(id) 
    {
      if(confirm("Are you sure? You want to delete this?"))
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users_crud.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function()
        {
          if(this.responseText == 1)
          {
            alert('success', 'User removed successfully!');
            get_users();
          }
          else 
          {
            alert('error', 'No changes made!');
          }
        }
        xhr.send("id="+id+"&action=user_remove");
      }
      
    }

    function search_user(val)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/users_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#users_data").innerHTML = this.responseText;
      }

      xhr.send("searched_name="+val+"&action=search_user");
    }

    window.onload = function()
    {
      get_users();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>