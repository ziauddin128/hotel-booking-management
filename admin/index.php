<?php 
  require "inc/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php require "inc/links.php"; ?>
</head>
<body class="bg-light">

    <section class="login_era d-flex align-items-center justify-content-center vh-100 vw-100">
        <div class="login_era_in bg-white shadow rounded text-center overflow-hidden" style="max-width: 400px; width: 100%">
            <h3 class="bg-dark py-3 text-white fs-4">Admin Login</h3>
            
            <form method="POST" class="p-3">
                <div class="mb-3">
                    <input type="text" class="form-control shadow-none text-center" required placeholder="Admin Name" name="admin_name" id="admin_name">
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control shadow-none text-center" required placeholder="Admin Password" name="admin_pass" id="admin_pass">
                </div>
                <div>
                  <button type="submit" name="login_btn" class="btn btn-dark shadow-none custom-bg">Login</button>
                </div>
            </form>

        </div>
    </section>

    <?php 
      if(isset($_POST['login_btn']))
      {
        $form_data = filtration($_POST);

      }
    ?>  

    <?php require "inc/scripts.php"; ?>
</body>
</html>