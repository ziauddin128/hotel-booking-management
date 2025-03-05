    <!-- footer -->
    <section class="footer py-5 bg-white shadow px-lg-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="h-font fw-bold mb-2">TJ HOTEL</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur hic aliquam reiciendis ea explicabo maiores illum eius suscipit aliquid iusto.</p>
                </div>
                <div class="col-md-4">
                    <h3>Quick Links</h3>
                    <a href="index" class="text-decoration-none d-inline-block mb-2 text-dark">Home</a> <br>
                    <a href="about" class="text-decoration-none d-inline-block text-dark">About</a> <br>
                    <a href="rooms" class="text-decoration-none d-inline-block mb-2 text-dark">Rooms</a> <br>
                    <a href="facilities" class="text-decoration-none d-inline-block mb-2 text-dark">Facilities</a> <br>
                    <a href="contact" class="text-decoration-none d-inline-block text-dark">Contact</a>  
                </div>
                <div class="col-md-4">
                        <h4>Follow Us</h4>
                        <a href="<?= $contact_row['fb'] ?>" target="_blank" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                            <i class="bi bi-facebook me-2"></i>
                            Facebook
                        </a>
                        <a href="<?= $contact_row['insta'] ?>" target="_blank" class="d-flex align-items-center mt-3 text-decoration-none text-dark">
                            <i class="bi bi-instagram me-2"></i>
                            Instagram
                        </a>
                        <a href="<?= $contact_row['tw'] ?>" target="_blank" class="d-flex align-items-center my-3 text-decoration-none text-dark">
                            <i class="bi bi-twitter-x me-2"></i>
                            Twitter
                        </a>
                </div>
            </div>
        </div>
    </section>      
    
    <!-- copyright -->
    <section class="copyright py-4 bg-dark text-white">
        <div class="container">
            <p class="my-0 text-center">Designed and Developed By ABC Tech Ltd</p>
        </div>
    </section>                

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        let register_form = document.querySelector("#register_form");
        register_form.addEventListener("submit", function(e)
        {
            e.preventDefault();

            let form_data = new FormData(this);
            form_data.append("action", "register");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php");

            xhr.onload = function()
            {

                const modalElement = document.getElementById('registerModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement); 
                modalInstance.hide();

                if(this.responseText == "password_mismatch")
                {
                    alert("error", "Password & Confirm Password Mismatch!");
                }
                else if(this.responseText == "user_exist")
                {
                    alert("error", "Email or Phone Number already exist!");
                }
                else if(this.responseText == "invalid_format")
                {
                    alert("error", "Image should be in jpg, jpeg, png or webp format!");
                }
                else if(this.responseText == "upload_failed")
                {
                    alert("error", "Image upload failed. Server down!");
                }
                else if(this.responseText == "mail_failed")
                {
                    alert("error", "Mail send failed. Server down!");
                }
                else if(this.responseText == 1)
                {
                    alert("success", "We sent you an email with verification link. Confirm your account!");
                    register_form.reset();
                }
                else 
                {
                    alert("error", "Server down!");
                }
            }

            xhr.send(form_data);
        })
    </script>

    <script>
        function activeMenu()
        {
            let nav_bar = document.querySelector("#nav-bar");
            let nav_a_tags = nav_bar.getElementsByTagName("a");
            for (let i = 0; i < nav_a_tags.length; i++) 
            {
               let nav_path = nav_a_tags[i].href.split('/').pop();
               let activePath = document.location.href;

               if(activePath.indexOf(nav_path) >= 0)
               {
                nav_a_tags[i].classList.add("active");
               }    
            }
        }
        activeMenu();

        function alert(type, message)
        {
            const existingAlert = document.querySelector('.custom-alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            alert_type = (type == "success") ? "alert-success" : "alert-danger";
            let element = document.createElement("div");
            element.innerHTML = `<div class="alert ${alert_type} custom-alert alert-dismissible fade show" role="alert">
            <strong class="me-3">${message}</strong>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            document.body.append(element);
        }
    </script>
</body>
</html>