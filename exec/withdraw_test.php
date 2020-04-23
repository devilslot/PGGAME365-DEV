<?php
require_once '../config.php';
require_once '../checklogin.php';

if(isset($_POST)){
    $row_member =  check_member($_SESSION['username']);
    $row_topup = check_member($_SESSION['username']);
    $credit = get_credit($_SESSION['username']);
    $can_withdraw = false;
    $amount = str_check((int)$_POST['amount']);
        //-------------update02.12.62 ------------
        $turnpoint = 1 ;
        $turn = $mysqli->query("SELECT * FROM slot_bonus WHERE bonus_id = '".$row_topup['topup_bonus']."'")->fetch_assoc();
        $turnpoint = $turn['bonus_turnover'];
        //----------------------------------------
        if($credit >= 300){
            if($row_member['member_level'] == 2){
                $row_credit = check_freecredit();
                if($credit >= $row_credit['free_min_credit']){
                    $amount = $row_credit['free_money'];
					$creditw = $credit;
                    $can_withdraw = true;
                }
            }else{
                if($amount < 300){
                    echo "<script>swal.fire('ผิดพลาด', 'ถอนเงินขั้นต่ำ 300 บาท', 'error');</script>";
                    exit();
                }
				$creditw = $amount;
                if($row_member['member_bonus'] == 0 OR $row_member['member_bonus'] == 1){
                    $can_withdraw = true;
                }else{
                    $dep = last_dep($_SESSION['username']);
                    $dep = json_decode($dep,true);
                    if( $credit >= $dep['topup_credit']*$turnpoint){
                        $can_withdraw = true;
                    }
                }
            }
        }
        if($can_withdraw == true){
            $json = json_decode(CURL_GET($Api['url'] . 'TransferCredit?amount=-' . $creditw . '&username=' . $row_member['member_username']));
            if (isset($json->BeforeCredit)) {
                $mysqli->query("UPDATE `slot_member` SET `member_bonus` = 0 WHERE `member_username` = '".$_SESSION['username']."' ");
                $mysqli->query("INSERT INTO `slot_withdraw` VALUES (NULL,'" . $row_member['member_username'] . "','" . $amount . "','" . $creditw . "','".date('Y-m-d H:i:s')."',0)");
                echo "<script>swal.fire('แจ้งถอนเงินสำเร็จ', 'กรุณารอพนักงานทำรายการสักครู่', 'success');</script>";
            }
        }else{
            echo "<script>swal.fire('ผิดพลาด', 'การถอนถอนไม่สำเร็จ', 'error');</script>";
        }
    }
    
?>
