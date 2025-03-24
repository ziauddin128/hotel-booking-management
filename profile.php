<?php 
 require "top.php";

 if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
 {
  redirect('index');
 }

 // user info
 
 $result = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1", 'i', [$_SESSION['USER_ID']]);
 $row = $result->fetch_assoc();

?> 

<section class="py-5">
  <div class="container">

    <div class="mb-4" style="font-size: 14px;">
      <a href="index" class="text-secondary text-decoration-none">HOME</a>
      <span class="text-secondary"> > </span>
      <a href="profile" class="text-secondary text-decoration-none">PROFILE</a>
    </div>

    <div class="bg-white shadow-sm rounded p-3 p-md-4 mb-4">
      <h4 class="fw-bold mb-4">Basic Information</h4>

      <form id="profile_form">
        <div class="row">

          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control shadow-none" value="<?= $row['name'] ?>" name="name" required>
          </div>

          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Phone Number</label>
            <input type="number" class="form-control shadow-none" value="<?= $row['phone_number'] ?>" name="phone_number" required>
          </div>

          <div class="col-md-6 col-lg-4 mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control shadow-none" value="<?= $row['dob'] ?>" name="dob" required>
          </div>

          <div class="col-md-6 col-lg-4 mb-3">
              <label class="form-label">Pincode</label>
              <input type="number" class="form-control shadow-none" value="<?= $row['pincode'] ?>" name="pincode" required>
          </div>
          
          <div class="col-md-6 col-lg-8 mb-4">
            <label class="form-label">Address</label>
            <textarea class="form-control shadow-none" rows="2" name="address" required><?= $row['address'] ?></textarea>
          </div>

        </div>

        <button type="submit" class="btn custom-bg text-white">Save Changes</button>
      </form>

    </div>

    <div class="row">
      <div class="col-md-4">

        <div class="bg-white shadow-sm rounded p-3 p-md-4">
          <h4 class="fw-bold mb-4">Picture</h4>
    
          <img src="<?= IMAGE_PATH ?>users/<?= $row['picture'] ?>" class="w-50">
    
          <form id="picture_form">
            <div class="row">
    
              <div class="col-12 my-3">
                <label class="form-label">Picture</label>
                <input type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" name="picture" required>
              </div>
    
            </div>
    
            <button type="submit" class="btn custom-bg text-white">Update</button>
          </form>
    
        </div>
        
      </div>

      <div class="col-md-8">

        <div class="bg-white shadow-sm rounded p-3 p-md-4">
          <h4 class="fw-bold mb-4">Change Password</h4>
    
          <form id="password_form">
            <div class="row">
    
              <div class="col-md-6 mb-3">
                <label class="form-label">New Password</label>
                <input type="text" class="form-control shadow-none" name="new_pass" required>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="text" class="form-control shadow-none" name="con_pass" required>
              </div>
    
            </div>
    
            <button type="submit" class="btn custom-bg text-white">Update</button>
          </form>
    
        </div>
        
      </div>

    </div>

  </div>
</section>


<script>

  // basic information

  let profile_form = document.querySelector("#profile_form");
  profile_form.addEventListener("submit", function(event)
  {
    event.preventDefault();

    let form_data = new FormData(this);
    form_data.append("action", "basic_info");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/profile.php");

    xhr.onload = function()
    {
      if(this.responseText == "phone_already")
      {
        alert('error', 'Phone number already exist');
      }
      else if(this.responseText == 1)
      {
        alert('success', 'Changes saved!');
      }
      else 
      {
        alert('error', 'No changes made');
      }
    }

    xhr.send(form_data);

  })

  // update picture

  let picture_form = document.querySelector("#picture_form");
  picture_form.addEventListener("submit", function(event)
  {
    event.preventDefault();

    let form_data = new FormData(this);
    form_data.append("action", "picture_update");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/profile.php");

    xhr.onload = function()
    {
      console.log(this.responseText);

      if(this.responseText == "invalid_format")
      {
        alert("error", "Image should be in jpg, jpeg, png or webp format!");
      }
      else if(this.responseText == "upload_failed")
      {
        alert("error", "Image upload failed. Server down!");
      }
      else if(this.responseText == 1)
      {
         window.location.reload();
      }
      else 
      {
        alert('error', 'No changes made');
      }
    }

    xhr.send(form_data);

  })


  // password change

  let password_form = document.querySelector("#password_form");
  password_form.addEventListener("submit", function(event)
  {
    event.preventDefault();

    let new_pass = password_form.elements['new_pass'].value;
    let con_pass = password_form.elements['con_pass'].value;

    if(new_pass != con_pass)
    {
      alert('error', 'Password did not match');
      return false;
    }

    let form_data = new FormData(this);
    form_data.append("action", "password_update");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/profile.php");

    xhr.onload = function()
    {
      console.log(this.responseText);

      if(this.responseText == "mismatch")
      {
        alert("error", "Password did not match!");
      }
      else if(this.responseText == 1)
      {
        alert("success", "Changes success!");
        password_form.reset();
      }
      else 
      {
        alert('error', 'No changes made');
      }
    }

    xhr.send(form_data);

  })

</script>

<?php 
 require "footer.php";
?> 
