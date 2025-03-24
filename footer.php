    <!-- footer -->
    <section class="footer py-5 bg-white shadow px-lg-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="h-font fw-bold mb-2"><?= $setting_row['site_title'] ?></h3>
                    <p><?= $setting_row['site_about'] ?></p>
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

        //register

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

        //login

        let login_form = document.querySelector("#login_form");
        login_form.addEventListener("submit", function(e)
        {
            e.preventDefault();

            let form_data = new FormData(this);
            form_data.append("action", "login");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php");

            xhr.onload = function()
            {
                const modalElement = document.getElementById('loginModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement); 
                modalInstance.hide();

                if(this.responseText == "invalid_email_mob")
                {
                    alert("error", "Mobile Or Email is invalid!");
                }
                else if(this.responseText == "not_verified")
                {
                    alert("error", "Account not verified yet!");
                }
                else if(this.responseText == "suspended")
                {
                    alert("error", "Account suspended. Contact with admin!");
                }
                else if(this.responseText == "invalid_pass")
                {
                    alert("error", "Incorrect Password!");
                }
                else if(this.responseText == "success")
                {
                    login_form.reset();
                    
                    let page_name = window.location.href.split('/').pop().split('?').shift();
                    if(page_name == "room-details")
                    {
                        window.location.reload();
                    }
                    else
                    {
                       window.location = window.location.pathname;
                    }
                }
                else 
                {
                    alert("error", "Server down!");
                }
            }

            xhr.send(form_data);
        })

        //forgot form

        let forgot_form = document.querySelector("#forgot_form");
        forgot_form.addEventListener("submit", function(e)
        {
            e.preventDefault();

            let form_data = new FormData(this);
            form_data.append("action", "forgot_pass");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php");

            xhr.onload = function()
            {
                const modalElement = document.getElementById('forgetModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement); 
                modalInstance.hide();

                if(this.responseText == "invalid_email")
                {
                    alert("error", "Email address is invalid!");
                }
                else if(this.responseText == "not_verified")
                {
                    alert("error", "Account not verified yet!");
                }
                else if(this.responseText == "suspended")
                {
                    alert("error", "Account suspended. Contact with admin!");
                }
                else if(this.responseText == "mail_failed")
                {
                    alert("error", "MaIl send failed! Server Down!");
                }
                else if(this.responseText == "success")
                {
                    forgot_form.reset();
                    alert("success", "Reset Password link sent successfully!");
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

        function checkLogin(login, room_id)
        {
            if(login)
            {
                window.location.assign('confirm-booking?id='+room_id);
            }
            else 
            {
                alert('error', 'Please login first');
            }
        }

    </script>
</body>
</html>