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

              <form id="gen_s_form">
                <div class="modal-body">
                
                  <div class="mb-3">
                      <label for="site_title_inp" class="form-label">Site Title</label>
                      <input type="text" class="form-control shadow-none" name="site_title_inp" id="site_title_inp" required>
                  </div>

                  <div class="col-md-12 mb-3 p-0">
                      <label for="site_about_inp" class="form-label">About Us</label>
                      <textarea class="form-control shadow-none" rows="6" name="site_about_inp" id="site_about_inp" required></textarea>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" onclick="site_title_inp.value = general_data.site_title, site_about_inp.value = general_data.site_about" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
                  <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
              </form>

            </div>
          </div>
        </div>

        <!-- shutdown -->
        <div class="card border-0 shadow-sm mb-4">
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

        <!-- contact settings -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">Contact Settings</h5>
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#contact-s">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
            </div>

            <div class="row">
              <div class="col-md-6">

                <div class="mb-4">
                  <h6 class="card-subtitle mb-2">Address</h6>
                  <p class="card-text" id="address"></p>
                </div>

                <div class="mb-4">
                  <h6 class="card-subtitle mb-2">Google Map</h6>
                  <p class="card-text" id="gmap"></p>
                </div>

                <div class="mb-4">
                 <h6 class="card-subtitle mb-2">Phone Numbers</h6>
                 <p class="card-text"><i class="bi bi-telephone-fill"></i> <span id="phn1"></span></p>
                 <p class="card-text"><i class="bi bi-telephone-fill"></i> <span id="phn2"></span></p>
                </div>

                <div class="mb-4">
                 <h6 class="card-subtitle mb-2">Email</h6>
                 <p class="card-text"><i class="bi bi-envelope"></i> <span id="email"></span></p>
                </div>
                
              </div>
              <div class="col-md-6">

                <div class="mb-4">
                  <h6 class="card-subtitle mb-2">Social Links</h6>
                  <p class="card-text"><i class="bi bi-facebook"></i> <span id="fb"></span></p>
                  <p class="card-text"><i class="bi bi-instagram"></i> <span id="insta"></span></p>
                  <p class="card-text"><i class="bi bi-twitter"></i> <span id="tw"></span></p>
                </div>

                <h6 class="card-subtitle mb-2">iFrame</h6>
                <div class="bg-white shadow-sm p-3 rounded">
                  <iframe src="" id="iframe" height="250px" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                
              </div>
            </div>
          </div>
        </div>

        <!-- contact settings Modal -->
        <div class="modal fade" id="contact-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Contact Settings</h1>
                <button type="button" class="btn-close shadow-none" onclick="contacts_inp_show(contacts_data)" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form id="contact_s_form">
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="address_inp" class="form-label">Address</label>
                        <input type="text" class="form-control shadow-none" name="address" id="address_inp" required>
                      </div>

                      <div class="mb-3">
                        <label for="gmap_inp" class="form-label">Google Map</label>
                        <input type="text" class="form-control shadow-none" name="gmap" id="gmap_inp" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Phone Numbers (with country code)</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                          <input type="text" class="form-control shadow-none" name="phn1" id="phn1_inp" required>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                          <input type="text" class="form-control shadow-none" name="phn2" id="phn2_inp" required>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="email_inp" class="form-label">Email</label>
                        <input type="text" class="form-control shadow-none" name="email" id="email_inp" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Social Links</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                          <input type="text" class="form-control shadow-none" name="fb" id="fb_inp" required>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                          <input type="text" class="form-control shadow-none" name="insta" id="insta_inp" required>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                          <input type="text" class="form-control shadow-none" name="tw" id="tw_inp" required>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="iframe_inp" class="form-label">iFrame</label>
                        <textarea class="form-control shadow-none" rows="6" name="iframe" id="iframe_inp" required></textarea>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" onclick="contacts_inp_show(contacts_data)" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
                  <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      
      </div>
    </div>
  </section>


  <script>
    let general_data, contacts_data;
    let site_title_inp = document.querySelector("#site_title_inp");
    let site_about_inp = document.querySelector("#site_about_inp");

    function get_general()
    {
      let site_title = document.querySelector("#site_title");
      let site_about = document.querySelector("#site_about");

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

    function get_contacts()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        let contact_p_id = ["address", "gmap", "phn1", "phn2", "email", "fb", "insta", "tw"];
        let iframe = document.querySelector("#iframe");

        contacts_data = JSON.parse(this.responseText);
        contacts_data = Object.values(contacts_data);

        for (let i = 0; i < contact_p_id.length; i++) 
        {
          document.getElementById(contact_p_id[i]).innerText = contacts_data[i+1];
        }
        iframe.src = contacts_data[9];

        contacts_inp_show(contacts_data);
      }

      xhr.send("get_contacts");
    }

    function contacts_inp_show(data)
    {
      let contact_inp_id = ["address_inp", "gmap_inp", "phn1_inp", "phn2_inp", "email_inp", "fb_inp", "insta_inp", "tw_inp", "iframe_inp"];

      for (let i = 0; i < contact_inp_id.length; i++) 
      {
        document.getElementById(contact_inp_id[i]).value = data[i+1];
      }
    }

    let gen_s_form = document.querySelector("#gen_s_form");
    gen_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();
      update_settings(site_title_inp.value, site_about_inp.value);
    })

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

    let contact_s_form = document.querySelector("#contact_s_form");
    contact_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "contacts_update");

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

        const modalElement = document.getElementById('contact-s');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();
        
        get_contacts();
      }

      xhr.send(form_data);

    })

    window.onload = function()
    {
      get_general();
      get_contacts();
    }
  </script>

<?php 
  require "inc/footer.php";
?>