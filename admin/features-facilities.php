<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">FEATURE FACILITIES</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">Features</h5>
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#feature-s">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 450px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="features_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">Facilities</h5>
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#facility-s">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 450px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Sl</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="facilities_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
      
      </div>
    </div>
  </section>


  <!-- feature Modal -->
  <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Feature</h1>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="feature_s_form">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control shadow-none" name="feature_name" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- facility Modal -->
  <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Facility</h1>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="facility_s_form">
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Icon</label>
              <input type="file" class="form-control shadow-none" name="facility_icon" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control shadow-none" name="facility_name" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control shadow-none" name="facility_desc" id="" rows="6" required></textarea>
            </div>

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

    //features
    let feature_s_form = document.querySelector("#feature_s_form");
    feature_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "add_feature");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert("success", "New feature added!");
          feature_s_form.reset();
          get_features();
        }
        else 
        {
          alert("error", "Server Down!");
        }

        const modalElement = document.getElementById('feature-s');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();
      }

      xhr.send(form_data);
    })

    function get_features()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#features_data").innerHTML = this.responseText;
      }

      xhr.send("get_features");
    }

    function remove_feature(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Feature Deleted!');
          get_features();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("id="+id+"&action=remove_feature");
    }

    //facilities
    let facility_s_form = document.querySelector("#facility_s_form");
    facility_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "add_facility");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php");

      xhr.onload = function()
      {
        const modalElement = document.getElementById('facility-s');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();

        if(this.responseText == "invalid_format")
        {
          alert("error", "Only SVG are allowed!");
        }
        else if(this.responseText == "invalid_size")
        {
          alert("error", "Image size must be lower than 1MB!");
        }
        else if(this.responseText == "upload_failed")
        {
          alert("error", "Server Down");
        }
        else
        {
          alert("success", "Facility added!");
          facility_s_form.reset();

          get_facilities();
        }
   
      }

      xhr.send(form_data);
    })

    function get_facilities()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#facilities_data").innerHTML = this.responseText;
      }

      xhr.send("get_facilities");
    }

    function remove_facility(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Facility Deleted!');
          get_facilities();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("id="+id+"&action=remove_facility");
    }

    window.onload = function()
    {
      get_features();
      get_facilities();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>