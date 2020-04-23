<?php
//error_reporting(-1);

if (empty($_POST['phone'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก เบอร์โทร', 'error');</script>";
} elseif (empty($_POST['password'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก รหัสผ่าน', 'error');</script>";
} elseif (empty($_POST['firstname'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก ชื่อจริง', 'error');</script>";
} elseif (empty($_POST['lastname'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก นามสกุล', 'error');</script>";
} elseif (empty($_POST['bankaccount'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก หมายเลขบัญชี', 'error');</script>";
} elseif (empty($_POST['bankcode'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณาเลือก ธนาคาร', 'error');</script>";
} elseif (empty($_POST['lineid'])) {
    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก ไอดีไลน์', 'error');</script>";
} else { 
    require_once '../dbmodel.php';
    require_once '../function.php';

    $config = include(dirname(__FILE__).'\..\config.php');

    /* echo "\n".dirname(__FILE__);
    echo "\n" . $config['site_id'];
    exit(); */
    // Check duplicated IP
    $ip = getIP();

    $query = "SELECT count(member_ip) AS ip FROM `members` WHERE member_ip = '" . $ip . "' GROUP BY member_ip";
    $count_ip = $mysqli->query($query)->fetch_assoc();
      
    if ($count_ip['ip'] > 0) {
        echo "<script>swal.fire('ข้อมูลซ้ำ','หมายเลข IP ของคุณเคยสมัครไปแล้ว','error');</script>";
        exit();
    }

    // Gen player session
    //$player_session = urlencode(hash("sha256",rand()));
    $player_session = uniqid();

    $query = "SELECT count(member_login) AS player_session FROM `members` WHERE member_login = '" . $player_session . "' GROUP BY member_login";
    $count_query = $mysqli->query($query)->fetch_assoc();

    while ($count_query['player_session'] > 0) {
        $player_session = urlencode(hash("sha256",rand()));
        $query = "SELECT count(member_login) AS player_session FROM `members` WHERE member_login = '" . $player_session . "' GROUP BY member_login";
        $count_query = $mysqli->query($query)->fetch_assoc();  
    }

    $phone = str_check(trim($_POST['phone']));
    $password = str_check(trim($_POST['password']));
    $name = str_check(trim($_POST['firstname']));
    $surname = str_check(trim($_POST['lastname']));
    $banktype = bank_type_rename(str_check(trim($_POST['bankcode'])));
    $banknumber = str_check(trim($_POST['bankaccount']));
    $lineid = str_check(trim($_POST['lineid']));
    $row_bank = check_bank_num($banknumber);
    $row_line = check_line($lineid);
    $row_phone = check_phone($phone);
    $aff = NULL;
    $member_login = trim($player_session);
    $first_deposit_bonus = 0;
    if (isset($_POST['promo'])) {
        $first_deposit_bonus = $_POST['promo'];
    }

	$register_date = date("Y-m-d H:i:s");
    $re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
    if (mb_strlen($password, 'UTF8') < 8) {
        echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','รหัสผ่านต้องมีไม่ต่ำกว่า 8 ตัว', 'error');</script>";
    } elseif (!preg_match($re, $password)) {
        if(misc_parsestring($password) == false){
            echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','รหัสผ่านต้องมีอักษรภาษาอังกฤษกับตัวเลขผสมเท่านั้น', 'error');</script>";
        }else{
            echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','รหัสผ่านต้องมีตัวเลขอยู่ด้วยอย่างน้อย 1 ตัว', 'error');</script>";
        }
    } elseif(!preg_match('/^[ก-๙เ]+$/',$name)){
        echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','ชื่อจริงต้องเป็นภาษาไทยเท่านั้น ห้ามมีเว้นวรรค', 'error');</script>";
    } elseif(!preg_match('/^[ก-๙เ]+$/',$surname)){
        echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','นามสกุลต้องเป็นภาษาไทยเท่านั้น ห้ามมีเว้นวรรค', 'error');</script>";
    } elseif (misc_parsestring($banknumber, '0123456789') == false) {
        echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','หมายเลขบัญชี ต้องเป็นตัวเลข 10 หลักเท่านั้น', 'error');</script>";
    } elseif (misc_parsestring($phone, '0123456789') == false || strlen($phone) != 10) {
        echo "<script>swal.fire('ข้อมูลไม่ถูกต้อง','หมายเลขโทรศัพท์ ต้องเป็นตัวเลข 10 หลักเท่านั้น', 'error');</script>";
    } elseif ($row_bank > 0) {
        echo "<script>swal.fire('ข้อมูลซ้ำ','หมายเลขบัญชี $banknumber นี้ถูกใช้งานแล้ว', 'error');</script>";
    } elseif ($row_phone > 0) {
        echo "<script>swal.fire('ข้อมูลซ้ำ','หมายเลขโทรศัพท์: $phone นี้ถูกใช้งานแล้ว', 'error');</script>";
    } elseif ($row_line > 0) {
        echo "<script>swal.fire('ข้อมูลซ้ำ','ไลน์ไอดี: $lineid นี้ถูกใช้งานแล้ว', 'error');</script>";
    } else {
        
        $row_getuser = $mysqli->query("SELECT member_no FROM `members` ORDER BY member_no DESC LIMIT 1")->fetch_assoc();
        $username = '';
        $uid = 0;
        if ((count($row_getuser)) > 0) {
            $u_num =  $row_getuser['member_no'];
            $uid = $u_num+1;               
        } else {
            $uid = 1;
        }
        $uid += 100000;
        $username = $config['site_id'] . $uid ;
        
        $level = 0;
        $ocode = '';
        
        // Insert 'members' table
        $sql = "INSERT INTO members (member_username,member_password,member_name,member_surname,member_phone,member_bank_number, member_bank_type, member_line, member_register_date,member_ip,member_level,member_aff,member_vip_date,member_login,member_from,first_deposit_bonus) VALUES (";
        $sql .= "'" . $username . "','" . $password . "','" . $name . "','" . $surname . "','" . $phone . "','" . $banknumber . "','" . $banktype . "','" . $lineid . "','" . $register_date . "','" . $ip . "'," . $level . ",'" . $aff . "',NULL,'" . $member_login . "','','" . $first_deposit_bonus . "')"; 

        //echo "\n" . $sql;

        if ($mysqli->query($sql) === TRUE) {
            //echo "\nNew record 'members' created successfully";
        } else {
            //echo "\nError: " . $sql . "<br>" . $mysqli->error;
        }

        // Insert 'member_wallet' table
        $sql = "INSERT INTO `member_wallet`(`member_no`, `updated_date`, `updated_by`) VALUES ";
        $sql .= "('" . $uid . "','" . $register_date . "','System')";

        //echo "\n" . $sql;

        if ($mysqli->query($sql) === TRUE) {
            //echo "\nNew record 'member_wallet' created successfully";
        } else {
            //echo "\nError: " . $sql . "<br>" . $mysqli->error;
        }

        //$mysqli->close();
        
        $row = $mysqli->query("SELECT * FROM members WHERE member_username = '" . $username. "'")->fetch_assoc();
        $_SESSION['username'] = $row['member_username'];
        $_SESSION['operator_player_session'] = $row['member_login'];
        //echo "<script>swal.fire('". $_SESSION['operator_player_session'] ."');</script>";
        echo "<script>window.location = '/profile.php?'</script>";
    }
}
?>