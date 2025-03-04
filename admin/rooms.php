<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">ROOMS</h4>
  
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#room-s">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 450px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Area</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="rooms_data">
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
       
      
      </div>
    </div>
  </section>

  <!-- room Modal -->
  <div class="modal fade" id="room-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Room</h1>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="room_s_form" autocomplete="off">
          <div class="modal-body">

            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control shadow-none" name="name" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Area</label>
                  <input type="number" min="1" class="form-control shadow-none" name="area" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Price</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="price" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="quantity" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Adult (Max.)</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="adult" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Children (Max.)</label>
                  <input type="number" min="1" class="form-control shadow-none" name="children" required>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Features</label>
                  <div class="row">
                    <?php 
                      $feature_res = selectAll('features');
                      while($feature_row = $feature_res->fetch_assoc())
                      {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                          <label style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input shadow-none me-2" name="features[]" value="<?= $feature_row['id'] ?>">
                            <?= $feature_row['feature_name'] ?>
                          </label>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Facilities</label>
                  <div class="row">
                    <?php 
                      $facilities_res = selectAll('facilities');
                      while($facilities_row = $facilities_res->fetch_assoc())
                      {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                          <label style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input shadow-none me-2" name="facilities[]" value="<?= $facilities_row['id'] ?>">
                            <?= $facilities_row['facility_name'] ?>
                          </label>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea class="form-control shadow-none" name="description" rows="6" required></textarea>
                </div>
              </div>
              
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

  <!-- Edit room Modal -->
  <div class="modal fade" id="room-edit-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="room_title">Update Room</h1>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="room_edit_form" autocomplete="off">

          <input type="hidden" name="room_id">

          <div class="modal-body">

            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control shadow-none" name="name" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Area</label>
                  <input type="number" min="1" class="form-control shadow-none" name="area" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Price</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="price" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="quantity" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Adult (Max.)</label>
                  <input type="number" min="1"  class="form-control shadow-none" name="adult" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Children (Max.)</label>
                  <input type="number" min="1" class="form-control shadow-none" name="children" required>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Features</label>
                  <div class="row">
                    <?php 
                      $feature_res = selectAll('features');
                      while($feature_row = $feature_res->fetch_assoc())
                      {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                          <label style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input shadow-none me-2" name="features[]" value="<?= $feature_row['id'] ?>">
                            <?= $feature_row['feature_name'] ?>
                          </label>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Facilities</label>
                  <div class="row">
                    <?php 
                      $facilities_res = selectAll('facilities');
                      while($facilities_row = $facilities_res->fetch_assoc())
                      {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                          <label style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input shadow-none me-2" name="facilities[]" value="<?= $facilities_row['id'] ?>">
                            <?= $facilities_row['facility_name'] ?>
                          </label>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea class="form-control shadow-none" name="description" rows="6" required></textarea>
                </div>
              </div>
              
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

  <!-- Room Image Modal -->
  <div class="modal fade" id="image-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="room_image_title">Update room image</h1>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="room_image_form" autocomplete="off">

          <input type="hidden" name="room_id">

          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Image</label>
              <input type="file" class="form-control shadow-none" name="image" required>
            </div>

            <button type="submit" class="btn custom-bg text-white shadow-none mb-3">SUBMIT</button>

            <div class="table-responsive">
              <table class="table table-bordered" style="max-height: 350px; overflow: auto">
                <thead>
                  <tr class="table-dark">
                    <th scope="col">SL</th>
                    <th scope="col">Image</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="images_data">
                  
                </tbody>
              </table>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    function get_rooms()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#rooms_data").innerHTML = this.responseText;
      }

      xhr.send("get_rooms");
    }

    let room_s_form = document.querySelector("#room_s_form");
    room_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "add_room");
     
      let is_features_checked = false;
      let features = room_s_form.elements['features[]'];
      if(features == undefined)
      {
        is_features_checked = false;
      }
      else 
      {
        features.forEach(item => 
        {
          if(item.checked)
          {
            is_features_checked = true;
          }
        });
      }

      let is_facilities_checked = false;
      let facilities = room_s_form.elements['facilities[]'];
      if(facilities == undefined)
      {
        is_facilities_checked = false;
      }
      else 
      {
        facilities.forEach(item => 
        {
          if(item.checked)
          {
            is_facilities_checked = true;
          }
        });
      }

      if(!is_facilities_checked)
      {
        alert('error', 'Checked at least 1 Facility');
      }

      if(!is_features_checked)
      {
        alert('error', 'Checked at least 1 Feature');
      }

      if(is_features_checked && is_facilities_checked)
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php");

        xhr.onload = function()
        {
          const modalElement = document.getElementById('room-s');
          const modalInstance = bootstrap.Modal.getInstance(modalElement); 
          modalInstance.hide();

          if(this.responseText == 1)
          {
            alert("success", "New room added!");
            room_s_form.reset();
            get_rooms();
          }
          else 
          {
            alert("error", "Server Down!");
          }
        }
        xhr.send(form_data);
      }
    })

    function room_status(val, id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Changes Saved!');
          get_rooms();
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("val="+val+"&id="+id+"&action=room_status");
    }

    function show_room_det(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        let data = JSON.parse(this.responseText);
        document.querySelector("#room_title").innerText = data.room_data.name;
        room_edit_form.elements['name'].value = data.room_data.name;
        room_edit_form.elements['area'].value = data.room_data.area;
        room_edit_form.elements['price'].value = data.room_data.price;
        room_edit_form.elements['quantity'].value = data.room_data.quantity;
        room_edit_form.elements['adult'].value = data.room_data.adult;
        room_edit_form.elements['children'].value = data.room_data.children;
        room_edit_form.elements['description'].value = data.room_data.description;
        room_edit_form.elements['room_id'].value = data.room_data.id;
        
        room_edit_form.elements['features[]'].forEach((item)=>
        {
          if (data.features.includes(Number(item.value))) {
              item.checked = true;
          }
        })

        room_edit_form.elements['facilities[]'].forEach((item)=>
        {
          if (data.facilities.includes(Number(item.value))) {
              item.checked = true;
          }
        })

      }
      xhr.send("id="+id+"&action=show_room_det");
    }

    let room_edit_form = document.querySelector("#room_edit_form");
    room_edit_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "edit_room");
     
      let is_features_checked = false;
      let features = room_edit_form.elements['features[]'];
      if(features == undefined)
      {
        is_features_checked = false;
      }
      else 
      {
        features.forEach(item => 
        {
          if(item.checked)
          {
            is_features_checked = true;
          }
        });
      }

      let is_facilities_checked = false;
      let facilities = room_edit_form.elements['facilities[]'];
      if(facilities == undefined)
      {
        is_facilities_checked = false;
      }
      else 
      {
        facilities.forEach(item => 
        {
          if(item.checked)
          {
            is_facilities_checked = true;
          }
        });
      }

      if(!is_facilities_checked)
      {
        alert('error', 'Checked at least 1 Facility');
      }

      if(!is_features_checked)
      {
        alert('error', 'Checked at least 1 Feature');
      }

      if(is_features_checked && is_facilities_checked)
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php");

        xhr.onload = function()
        {
          const modalElement = document.getElementById('room-edit-s');
          const modalInstance = bootstrap.Modal.getInstance(modalElement); 
          modalInstance.hide();

          if(this.responseText == 1)
          {
            alert("success", "Changes saved");
            room_s_form.reset();
            get_rooms();
          }
          else 
          {
            alert("error", "No changes made!");
          }
        }
        xhr.send(form_data);
      }
    })
    
    let room_image_form = document.querySelector("#room_image_form");
    function show_room_image(id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        room_image_form.elements['room_id'].value = id;
        document.querySelector("#images_data").innerHTML = this.responseText;
      }
      xhr.send("id="+id+"&action=show_room_image");
    }

    room_image_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "add_image");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php");

      xhr.onload = function()
      {
        if(this.responseText == "invalid_format")
        {
          alert("error", "Only jpg, png, jpeg, webp are allowed!");
        }
        else if(this.responseText == "invalid_size")
        {
          alert("error", "Image size must be lower than 2MB!");
        }
        else if(this.responseText == "upload_failed")
        {
          alert("error", "Server Down");
        }
        else
        {
          alert("success", "Room image added!");
          room_image_form.reset();
          show_room_image(room_image_form.elements['room_id'].value);
          get_rooms();
        }
      }

      xhr.send(form_data);

    })

    function set_thumbnail(room_id, id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Thumbnail Saved!');
          show_room_image(room_image_form.elements['room_id'].value);
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("room_id="+room_id+"&id="+id+"&action=set_thumbnail");
    }

    function image_remove(room_id, id) 
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/rooms_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
          alert('success', 'Image deleted!');
          show_room_image(room_image_form.elements['room_id'].value);
        }
        else 
        {
          alert('error', 'No changes made!');
        }
      }
      xhr.send("room_id="+room_id+"&id="+id+"&action=image_remove");
    }
    
    function room_remove(id) 
    {
      if(confirm("Are you sure? You want to delete this?"))
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms_crud.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function()
        {
          if(this.responseText == 1)
          {
            alert('success', 'Room removed successfully!');
            get_rooms();
          }
          else 
          {
            alert('error', 'No changes made!');
          }
        }
        xhr.send("id="+id+"&action=room_remove");
      }
      
    }

    window.onload = function()
    {
      get_rooms();
    } 
  </script>

<?php 
  require "inc/footer.php";
?>