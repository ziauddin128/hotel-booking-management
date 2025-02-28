<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['action']) && $_POST['action'] == "add_image")
  {

    $image_res = upload_image($_FILES['image'], "carousel/");

    if($image_res == "invalid_format")
    {
      echo $image_res;
    }
    else if($image_res == "invalid_size")
    {
      echo $image_res;
    }
    else if($image_res == "upload_failed")
    {
      echo $image_res;
    }
    else 
    {
      $sql = "INSERT INTO `carousel`(`image`) VALUES (?)";
      $data_types = "s";
      $values = [$image_res];
      $result = insert($sql, $data_types, $values);
      echo $result;
    }
  
  }

  if(isset($_POST['get_carousel']))
  {
    $res = selectAll('carousel');

    $html = '';
    while ($row = mysqli_fetch_assoc($res)) 
    {
      $html .='<div class="col-sm-6 col-md-4 mb-3">
                <div class="card">
                  <img src="'.SITE_PATH.'assets/images/carousel/'.$row['image'].'" style="height: 220px; object-fit: cover; object-position: center">
                  <div class="card-img-overlay text-end">
                     <button class="btn btn-danger shadow-none" onclick="remove_image('.$row['id'].')"><i class="bi bi-trash"></i> Delete</button>
                  </div>
                </div>
              </div>';
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "remove_image")
  {
    $form_data = filtration($_POST);

    $sql = "SELECT * FROM `carousel` WHERE `id` = ?";
    $data_types = 'i';
    $values = [$form_data['id']];
    $res = select($sql, $data_types, $values);
    $row = $res->fetch_assoc();

    $is_delete = deleteImage($row['image'], "carousel/");

    if($is_delete)
    {
      $sql = "DELETE FROM `carousel` WHERE `id` = ?";
      $result = delete($sql, $data_types, $values);
      echo $result; 
    }
    else 
    {
      echo 0;
    }

  }
  

?>