<?php
require_once '../dbmodel.php';
//require_once '../function.php';
//require_once '../config.php';
if (isset($_POST['phone']) and isset($_POST['password'])) {
    $phone  = trim($_POST['phone']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM members WHERE ";
    $sql .= "member_phone = '" . $phone . "' AND member_password = '" . $password . "'";

    echo "Phone : " . $phone . PHP_EOL;
    echo "Password : " . $password . PHP_EOL;
    echo "SQL : " . $sql . PHP_EOL;
    exit();

    $data_members = $mysqli->query($sql)->fetch_assoc();
    if (count($data_members) > 0) {
        $stmt->bind_result($username); 
        $stmt->fetch();
        $_SESSION['username'] = $username;
        echo "<script>window.location = '../profile.php'</script>";
    }else{
        echo "<script>Swal.fire(
            'เข้าสู่ระบบไม่สำเร็จ',
            'กรุณาตรวจสอบเบอร์โทรและรหัสผ่านอีกครั้ง',
            'error'
          )</script>";
    }
}
?>