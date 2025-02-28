<?php 
 require "top.php";
?> 

<section class="py-5">
    <div class="container">

        <h2 class="h-font text-center mt-5 mb-2">CONTACT US</h2>
        <p class="text-center mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto quasi dolor at non illo adipisci unde aliquam placeat soluta aspernatur.</p>

        <div class="row">

            <div class="col-md-6">
                <div class="bg-white shadow rounded p-4 mb-3">
                   <iframe width="100%" height="300px" src="<?= $contact_row['iframe'] ?>" style="border:0;" loading="lazy"></iframe>

                   <h5 class="mt-4">Address</h5>
                   <p class="my-1"><i class="bi bi-geo-alt-fill"></i> <?= $contact_row['address'] ?></p>

                   <h5 class="mt-4">Contact Us</h5>
                   <a href="tel:<?= $contact_row['phn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark ">
                      <i class="bi bi-telephone-fill"></i> <?= $contact_row['phn1'] ?>
                   </a>
                   <br>
                   <a href="tel:<?= $contact_row['phn2'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark ">
                      <i class="bi bi-telephone-fill"></i> <?= $contact_row['phn2'] ?>
                   </a>
                   <br>
                   <a href="mailto: <?= $contact_row['email'] ?>" class="d-inline-block text-decoration-none text-dark ">
                      <i class="bi bi-envelope"></i> <?= $contact_row['email'] ?>
                   </a>


                   <h5 class="mt-4">Follow Us</h5>
                   <a href="<?= $contact_row['fb'] ?>" target="_blank" class="text-dark text-decoration-none me-2"><i class="bi bi-facebook fs-3"></i></a>
                   <a href="<?= $contact_row['insta'] ?>" target="_blank" class="text-dark text-decoration-none me-2"><i class="bi bi-instagram fs-3"></i></a>
                   <a href="<?= $contact_row['tw'] ?>" target="_blank" class="text-dark text-decoration-none"><i class="bi bi-twitter fs-3"></i></a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-white shadow rounded p-4">
                    <form id="contact_form">
                        <h4>Send a Message</h4>

                        <div class="mb-3">
                           <label for="" class="form-label">Name</label>
                           <input type="text" class="form-control shadow-none" name="name" required>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">Email</label>
                          <input type="email" class="form-control shadow-none" name="email" required>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">Subject</label>
                          <input type="text" class="form-control shadow-none" name="subject" required>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">Message</label>
                          <textarea class="form-control shadow-none" rows="2" name="message" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn text-white custom-bg">SEND</button>
                       
                    </form>
                </div>
            </div>
           
        </div>

    </div>
</section>


<script>
   let contact_form = document.querySelector("#contact_form");
   contact_form.addEventListener("submit", function(event)
   {
      event.preventDefault();
      let form_data = new FormData(this);
      form_data.append("action", "add_queries");

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/contact_crud.php");

      xhr.onload = function()
      {
        if(this.responseText == 1)
        {
            alert('success', 'Mail Sent!');
            contact_form.reset();
        }
        else 
        {
            alert('error', 'Server Down! Please try again later!');
        }
      }
      xhr.send(form_data);
   }) 
</script>


<?php 
 require "footer.php";
?> 
