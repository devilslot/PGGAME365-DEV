<?php
  $config = include('config.php');
  require_once 'dbmodel.php';
  require_once 'function.php';

  $gen_user = uniqid();

  $web_lobby_url = "";
  $web_lobby_url .= $config['web_lobby'];
  $web_lobby_url .= "operator_token=" . $config['operator_token'] . "&";
  $web_lobby_url .= "operator_player_session=" . urlencode($gen_user) . "&";
  $web_lobby_url .= "language=" . $config['language'];
  $web_lobby_url .= "";

  $sql = "INSERT INTO `demo_user` (`username`) VALUES ";
  $sql .= "('" . $gen_user . "')";

  //echo "SQL = " . $sql;
  if ($mysqli->query($sql) === TRUE) {
    //echo "\nNew record 'members' created successfully";
  } else {
      //echo "\nError: " . $sql . "<br>" . $mysqli->error;
  }

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
    <?php
      //echo hash("sha256",rand());
      //echo $web_lobby_url;
      echo "<script>window.location = '" . $web_lobby_url . "'</script>";
    ?>

</body>

</html>
