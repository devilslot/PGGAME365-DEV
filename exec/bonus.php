<?php
require_once '../config.php';
require_once '../checklogin.php';

if (isset($_POST['bonus'])) {
    $bonus = str_check(trim($_POST['bonus']));
    $last = last_dep($_SESSION['username']);
    $data_user = check_member($_SESSION['username']);
    $credit = get_credit($_SESSION['username']);
    $check = (json_decode($last,true));
    if($check['topup_amount'] >= 1 AND $check['topup_type'] == 'promptpay'){
        if($bonus == 3){
            $query = "SELECT * FROM `slot_topup` WHERE `topup_username` = '".$_SESSION['username']."' AND `topup_bonus` =3";
            $result = $mysqli->query($query);
            if($result->num_rows >= 1){
                echo "<script>swal('เกิดข้อผิดพลาด','โบนัส 100% รับได้แค่ครั้งเดียวเท่านั้น','error')</script>";
                exit();
            }
        }
        $result = $mysqli->query("SELECT * FROM `slot_bonus` WHERE `bonus_id` = '".$bonus."'")->fetch_assoc();
        $bonus_credit = $check['topup_amount'] * ($result['bonus_percent'] / 100) + $result['bonus_plus'];
        add_credit($data_user['member_ocode'],$bonus_credit);
        $can = ($bonus_credit + $check['topup_amount']) * $result['bonus_turnover'] + $credit;
        $mysqli->query("UPDATE `slot_member` SET `member_bonus` = '".$bonus."' WHERE `member_username` = '".$_SESSION['username']."' ");
        $mysqli->query("INSERT `slot_topup` (`topup_username`,`topup_ocode`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`,`topup_can`) VALUES ('" . $data_user['member_username'] . "','" . $data_user['member_ocode'] . "','bonus','0','" . $bonus_credit . "','" . date('Y-m-d H:i:s') . "','" . $bonus . "','" . $result['bonus_name'] . "','".$can."')");
        echo "<script>swal('ทำรายการสำเร็จ','รับโบนัสเรียบร้อยแล้ว','success')</script>";
    }else{
        echo "<script>swal('เกิดข้อผิดพลาด','รับโบนัสได้เฉพาะฝากเงินผ่านธนาคารเท่านั้น','error')</script>";
    }
}
?>