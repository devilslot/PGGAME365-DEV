<?php
require_once '../config.php';
require_once '../checklogin.php';

if (isset($_POST['user'])) {
    $user = str_check(trim($_POST['user']));
    $free_data = check_freecredit();
    if($free_data['free_status'] == true){
        if (misc_parsestring($user, 'XO0123456789') == true) {
            $stmt = $mysqli->prepare("SELECT * FROM `slot_member` WHERE `member_level` = 0 AND `member_username` = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $row_member = check_member($_SESSION['username']);
                $data = add_user($row_member['member_username'],$row_member['member_password'],$row_member['member_name'],$row_member['member_surname'],$free_data['free_credit']);
                $mysqli->query("UPDATE `slot_member` SET `member_ocode`='" . $data['ocode'] . "',`member_level` = 2 WHERE `member_username`='" . $row_member['member_username'] . "' AND `member_ocode`=''");
                $row_member = check_member($_SESSION['username']);
                $mysqli->query("INSERT `slot_topup` (`topup_username`,`topup_ocode`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`) VALUES ('".$row_member['member_username']."','".$row_member['member_ocode']."','free','0','".$free_data['free_credit']."','".date("Y-m-d H:i:s")."')");
                echo "<script>swal('ทำรายการสำเร็จ','รับเครดิตฟรีเรียบร้อยแล้ว','success')</script>";
            }else{
                echo "<script>swal('เกิดข้อผิดพลาด','คุณไม่สามารถรับเครดิตฟรีไปแล้ว','error')</script>";
            }
        }
    }else{
        echo "<script>swal('เกิดข้อผิดพลาด','หมดระยะเวลากิจกรรมแล้ว','error')</script>";
    }
}
?>