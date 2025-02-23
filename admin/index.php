<?php 
  require "inc/config.php";
  require "inc/function.php";


  if(isset($_SESSION['ADMIN_ID']) && isset($_SESSION['ADMIN_LOGIN']))
  {
      redirect('dashboard');
  }

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

        $sql = "SELECT * FROM `admin_cred` WHERE `name` = ? AND `password` = ?";
        $data_types = "ss";
        $values = [$form_data['admin_name'], $form_data['admin_pass']];

        $result = select($sql, $data_types, $values);
        if($result->num_rows > 0)
        {
          $row = $result->fetch_assoc();
          $_SESSION['ADMIN_ID'] = $row['id'];
          $_SESSION['ADMIN_LOGIN'] = true;

          redirect("dashboard");
        }
        else 
        {
          alert("error", "Invalid login credential");
        }

      }
    ?>  

    <?php require "inc/scripts.php"; ?>
</body>
</html>