<?php 
 require "top.php";
?> 

<!-- facilities -->
<section class="our_facilities py-5">
    <div class="container">

        <h2 class="h-font text-center mt-5 mb-2">OUR FACILITIES</h2>
        <p class="text-center mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto quasi dolor at non illo adipisci unde aliquam placeat soluta aspernatur.</p>

        <div class="row">

            <?php 
              $facility_res = selectAll('facilities');
              while ($facility_row = mysqli_fetch_assoc($facility_res)) 
              {
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-white shadow rounded border-top border-4 border-dark facilities-item p-4 mb-3">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <img src="<?= IMAGE_PATH ?>facilities/<?= $facility_row['facility_icon'] ?>" width="50px">
                            <h4 class="m-0"><?= $facility_row['facility_name'] ?></h4>
                        </div>
                        <p><?= $facility_row['facility_desc'] ?></p>
                    </div>
                </div>
                <?php
              }
            ?>
           
        </div>

    </div>
</section>


<?php 
 require "footer.php";
?> 
