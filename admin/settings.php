<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">SETTINGS</h4>

        <!-- general settings -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">General Settings</h5>
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
            </div>

            <h6 class="card-subtitle mb-2">Site Title</h6>
            <p class="card-text" id="site_title"></p>

            <h6 class="card-subtitle mb-2">About Us</h6>
            <p class="card-text" id="site_about"></p>
           
          </div>
        </div>

        <!-- general settings Modal -->
        <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">General Settings</h1>
                <button type="button" class="btn-close shadow-none" onclick="site_title_inp.value = general_data.site_title, site_about_inp.value = general_data.site_about" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              
                <div class="mb-3">
                    <label for="site_title_inp" class="form-label">Site Title</label>
                    <input type="text" class="form-control shadow-none" name="site_title_inp" id="site_title_inp">
                </div>

                <div class="col-md-12 mb-3 p-0">
                    <label for="site_about_inp" class="form-label">About Us</label>
                    <textarea class="form-control shadow-none" rows="6" name="site_about_inp" id="site_about_inp"></textarea>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" onclick="site_title_inp.value = general_data.site_title, site_about_inp.value = general_data.site_about" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" onclick="update_settings(site_title_inp.value, site_about_inp.value)" class="btn custom-bg text-white shadow-none">SUBMIT</button>
              </div>
            </div>
          </div>
        </div>

        <!-- shutdown -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">Website Shutdown</h5>
              <div class="form-check form-switch">
                <input class="form-check-input shadow-none" name="shutdown_switch" id="shutdown_switch" onchange="update_shutdown(this.value)" type="checkbox" role="switch"  style="transform: scale(1.8); cursor: pointer">
              </div>
            </div>

            <p class="card-text">No customer can book room, when site is shutdown</p>
           
          </div>
        </div>
      
      </div>
    </div>
  </section>


  <script>
    let general_data;

    function get_general()
    {
      let site_title = document.querySelector("#site_title");
      let site_about = document.querySelector("#site_about");
      let site_title_inp = document.querySelector("#site_title_inp");
      let site_about_inp = document.querySelector("#site_about_inp");

      let shutdown_switch = document.querySelector("#shutdown_switch");


      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        general_data = JSON.parse(this.responseText);

        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_inp.value = general_data.site_title;
        site_about_inp.value = general_data.site_about;

        if(general_data.shutdown == 1)
        {
          shutdown_switch.checked = true;
        }
        else 
        {
          shutdown_switch.checked = false;
        }
        shutdown_switch.value = general_data.shutdown;


      }

      xhr.send("get_general");
    }

    function update_settings(title, about)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert("success", "Changes Saved!");
        }
        else 
        {
          alert("error", "No changes has been made!");
        }

        const modalElement = document.getElementById('general-s');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();
        
        get_general();
      }

      let form_data = new FormData();
      form_data.append("site_title", title);
      form_data.append("site_about", about);
      form_data.append("action", "setting_update");

      xhr.send(form_data);
    }

    function update_shutdown(value)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php");

      xhr.onload = function()
      {
        if(this.responseText == 1 && general_data.shutdown == 0)
        {
          alert("success", "The site has been shut down!");
        }
        else 
        {
          alert("success", "The site is now live!");
        }
        get_general();
      }

      let form_data = new FormData();
      form_data.append("val", value);
      form_data.append("action", "shutdown_update");

      xhr.send(form_data);
    }


    window.onload = function()
    {
      get_general();
    }
  </script>

<?php 
  require "inc/footer.php";
?>