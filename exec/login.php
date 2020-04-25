<?php
require_once '../dbmodel.php';
require_once '../function.php';
require_once '../config.php';
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
        echo "<script>window.location = 'exec/profile.php'</script>";
    }else{
        echo "<script>Swal.fire(
            'เข้าสู่ระบบไม่สำเร็จ',
            'กรุณาตรวจสอบเบอร์โทรและรหัสผ่านอีกครั้ง',
            'error'
          )</script>";
    }
}
?>