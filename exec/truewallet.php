<?php 

require_once '../config.php';

require_once '../checklogin.php';

$transaction_id = str_check($_POST['telno']);

$_POST['deposit'] = str_check($_POST['deposit']);

$status = curl_get($Api2['url'] . "Wallet/Verify?id=".$_POST['id']."&telno=" . $transaction_id ."&amount=".$_POST['deposit']);
//echo "<script>console.log('".$Api2['url'] . "Wallet/Verify?id=".$_POST['id']."&telno=" . $transaction_id ."&amount=".$_POST['deposit']."')</script>";

$result_status = json_decode($status, true);
echo "<script>console.log('".$result_status."')</script>";

$get_status = $result_status['status'];

if($get_status == 1){

    $row_member = check_member($_SESSION['username']);

    $bonus = 1;

    if($row_member['member_level']  == 0){

        curl_get($Api['url'].'CreateUser?username=' . $row_member['member_username'] . '&password=' . $row_member['member_password']);

    }

        add_credit($row_member['member_username'],$_POST['deposit']);

        $mysqli->query("UPDATE `slot_member` SET `member_level` = 1 WHERE `member_username`='" . $row_member['member_username'] . "'");

    $mysqli->query("INSERT `slot_topup` (`topup_username`,`topup_ocode`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`) VALUES ('" . $row_member['member_username'] . "','" . $row_member['member_ocode'] . "','wallet','" . $_POST['deposit'] . "','" . $_POST['deposit'] . "','" . date('Y-m-d H:i:s') . "','" . $bonus . "','" . $result_status['transaction'] . "')");

    echo "<script>swal.fire('ฝากเงินสำเร็จ', 'เครดิตจะเข้าสู่ยูสเซอร์ของคุณอัตโนมัติ', 'success');</script>";

}else{

    echo "<script>swal.fire('ฝากเงินผิดพลาด', 'กรุณาตรวจสอบข้อมูลที่กรอกอีกครั้ง', 'error');</script>";

}

?>