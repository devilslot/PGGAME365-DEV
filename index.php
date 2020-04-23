<?php
  $config = include('config.php');

  $web_lobby_url = "";
  $web_lobby_url .= $config['web_lobby'];
  $web_lobby_url .= "operator_token=" . $config['operator_token'] . "&";
  $web_lobby_url .= "operator_player_session=" . urlencode($config['operator_player_session']) . "&";
  $web_lobby_url .= "language=" . $config['language'];
  $web_lobby_url .= "";
?>

<!DOCTYPE html>
<html lang="th" class="">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noodp">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  </head>

  <body>
    <button onclick="window.location.href='<?=$web_lobby_url?>';">เข้าสู่ระบบ</button><BR>
    <button onclick="window.location.href='<?=$config['host']?>/register';">สมัครสมาชิก</button><BR>
    <?php
      echo hash("sha256",rand());
    ?>
    <!--
    <button onclick="window.open('<?=$web_lobby_url?>','_blank');">เข้าสู่ระบบ</button>
    -->
</body>

</html>




<?php

//require_once '../config.php';
/*
$web_lobby_url = "<script>window.location = '";
$web_lobby_url .= $config['web_lobby'];
$web_lobby_url .= "operator_token=" . $config['operator_token'] . "&";
$web_lobby_url .= "operator_player_session=" . urlencode($config['operator_player_session']) . "&";
$web_lobby_url .= "language=" . $config['language'];
$web_lobby_url .= "'</script>";
*/
//echo "<script>window.location = '" . $web_lobby_url . "'</script>";
//echo $web_lobby_url;

/*
if (isset($_POST['phone']) and isset($_POST['password'])) {
    $phone  = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $stmt = $mysqli->prepare("SELECT `member_username` FROM `members` WHERE `member_phone` = ? AND `member_password` = ?");
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username); 
        $stmt->fetch();
        $_SESSION['username'] = $username;
        echo "<script>window.location = 'profile.php'</script>";
    }else{
        echo "<script>Swal.fire(
            'เข้าสู่ระบบไม่สำเร็จ',
            'กรุณาตรวจสอบเบอร์โทรและรหัสผ่านอีกครั้ง',
            'error'
          )</script>";
    }
}*/


?>