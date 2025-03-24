<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['get_queries']))
  {
    $sql = "SELECT rr.*, uc.name AS uname, r.name AS rname FROM `rate_review` AS rr
    INNER JOIN `user_cred` AS uc ON rr.user_id = uc.id
    INNER JOIN `rooms` AS r  ON rr.room_id = r.id
    ORDER BY rr.`id` DESC";
    $res = mysqli_query($conn, $sql);

    $html = '';
    if(mysqli_num_rows($res) > 0)
    {
      $sl = 1;
      while($row = mysqli_fetch_assoc($res))
      {

        $date = date('d-m-Y', strtotime($row['datetime']));

        $seen = "";
        if(!$row['seen'] == 1)
        {
          $seen .= "<a href='javascript:void(0)' onclick='mark_queries(".$row['id'].")' class='badge rounded-pill text-bg-primary text-decoration-none'>Mark as seen</a> <br>";
        }
        $seen .= "<a href='javascript:void(0)' onclick='remove_queries(".$row['id'].")' class='badge rounded-pill text-bg-danger text-decoration-none'>Delete</a>";

        $html .='<tr id="queries_row'.$row['id'].'">
                  <td>'.$sl.'</td>
                  <td>'.$row['rname'].'</td>
                  <td>'.$row['uname'].'</td>
                  <td>'.$row['rating'].'</td>
                  <td>'.$row['review'].'</td>
                  <td>'.$date.'</td>
                  <td>'.$seen.'</td>
                </tr>';

        $sl++;
      }
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "mark_queries")
  {
    $form_data = filtration($_POST);

    $sql = "UPDATE `rate_review` SET `seen`=? WHERE `id` = ?";
    $data_types = 'ii';
    $values = [1,$form_data['id']];
    echo $res = update($sql, $data_types, $values);
  } 

  if(isset($_POST['action']) && $_POST['action'] == "remove_queries")
  {
    $form_data = filtration($_POST);

    $sql = "DELETE FROM `rate_review` WHERE `id` = ?";
    $data_types = 'i';
    $values = [$form_data['id']];
    echo $res = delete($sql, $data_types, $values);
  } 

  if(isset($_POST['action']) && $_POST['action'] == "mark_all_queries")
  {
    $sql = "UPDATE `rate_review` SET `seen`= 1";
    echo $res = mysqli_query($conn, $sql);
  } 

  if(isset($_POST['action']) && $_POST['action'] == "remove_all_queries")
  {
    $sql = "DELETE FROM `rate_review`";
    echo $res = mysqli_query($conn, $sql);
  } 
  

?>