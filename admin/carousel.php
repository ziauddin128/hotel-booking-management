<?php 
  require "inc/top.php";
?>

  <!-- main content -->
  <section class="container-fluid" id="main_content">
    <div class="row">
      <div class="col-lg-10 ms-auto px-2 py-4 px-lg-4 py-lg-4">
      
        <h4 class="mb-4">CAROUSEL</h4>

        <!-- Carousel -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title m-0">Images</h5>
              <button type="button" class="btn btn-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#carousel-s">
                <i class="bi bi-pencil-square"></i> Add
              </button>
            </div>

            <div class="row" id="carousel_data">
           

            </div>

          </div>
        </div>

        <!-- Carousel Modal -->
        <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Image</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form id="carousel_s_form">
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control shadow-none" name="image" id="image_inp" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn shadow-none" data-bs-dismiss="modal">CANCEL</button>
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
    let carousel_s_form = document.querySelector("#carousel_s_form");
    carousel_s_form.addEventListener("submit", function(event)
    {
      event.preventDefault();

      let form_data = new FormData(this);
      form_data.append("action", "add_image");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/carousel_crud.php");

      xhr.onload = function()
      {
        const modalElement = document.getElementById('carousel-s');
        const modalInstance = bootstrap.Modal.getInstance(modalElement); 
        modalInstance.hide();
       
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
          alert("success", "Image added!");
          carousel_s_form.reset();

          get_carousel();
        }
      }

      xhr.send(form_data);

    })

    function get_carousel()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/carousel_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        document.querySelector("#carousel_data").innerHTML = this.responseText;
      }

      xhr.send("get_carousel");
    }

    function remove_image(id)
    {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/carousel_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function()
      {
        if(this.responseText == "1")
        {
          alert("success", "Image Deleted!");
          get_carousel();
        }
        else
        {
          alert("error", "Server Down!");
        }
      }
      xhr.send("id="+id+"&action=remove_image");
    }

    window.onload = function()
    {
      get_carousel();
    }
  </script>

<?php 
  require "inc/footer.php";
?>