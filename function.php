<?php

function str_check($str)

{

    if (!get_magic_quotes_gpc()) {

        $str = addslashes($str); // กรอง

    }

    $str = str_replace("_", "", $str);

    $str = str_replace("%", "", $str);

    $str = str_replace("=", "", $str);

    $str = str_replace("<", "", $str);

    $str = str_replace(">", "", $str);

    $str = str_replace("\'", "", $str);

    $str = str_replace("-", "", $str);

    $str = str_replace(";", "", $str);

    $str = str_replace("select", "", $str);

    $str = str_replace("update", "", $str);

    $str = str_replace("delete", "", $str);

    $str = str_replace("insert", "", $str);

    $str = str_replace("union", "", $str);

    $str = str_replace("--", "", $str);

    $str = str_replace("$", "", $str);

    $str = str_replace("#", "", $str);

    //$str = str_replace("/", "", $str);

    return $str;

}

function getIP()

{

    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {

        $ip = $_SERVER["HTTP_CLIENT_IP"];

    } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {

        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

    } else if (!empty($_SERVER["REMOTE_ADDR"])) {

        $ip = $_SERVER["REMOTE_ADDR"];

    } else {

        $ip = "ไม่สามารถรับมันได้！";

    }

    return $ip;

}

function bank_type_rename($str_bnk)
{
    if (!get_magic_quotes_gpc()) {
        $str_bnk = addslashes($str_bnk);
    }

    $str_bnk = str_replace("01", "ไทยพาณิชย์", $str_bnk);
    $str_bnk = str_replace("02", "กรุงเทพ", $str_bnk);
    $str_bnk = str_replace("03", "กสิกรไทย", $str_bnk);
    $str_bnk = str_replace("04", "กรุงไทย", $str_bnk);
    $str_bnk = str_replace("05", "ธกส.", $str_bnk);
    $str_bnk = str_replace("06", "ทหารไทย", $str_bnk);
    $str_bnk = str_replace("07", "ซีไอเอ็มบี ไทย", $str_bnk);
    $str_bnk = str_replace("08", "ยูโอบี", $str_bnk);
    $str_bnk = str_replace("09", "กรุงศรีอยุธยา", $str_bnk);
    $str_bnk = str_replace("10", "ออมสิน", $str_bnk);
    $str_bnk = str_replace("11", "แลนแอนด์เฮาส์", $str_bnk);
    $str_bnk = str_replace("12", "ธนชาต", $str_bnk);
    $str_bnk = str_replace("13", "ทิสโก้", $str_bnk);
    $str_bnk = str_replace("14", "เกียรตินาคิน", $str_bnk);

    return $str_bnk;
}

function bank_name($str_bnk)
{
    if (!get_magic_quotes_gpc()) {
        $str_bnk = addslashes($str_bnk);
    }

    $str_bnk = str_replace("SCB", "ไทยพาณิชย์", $str_bnk);
    $str_bnk = str_replace("BBL", "กรุงเทพ", $str_bnk);
    $str_bnk = str_replace("KBANK", "กสิกรไทย", $str_bnk);
    $str_bnk = str_replace("KTB", "กรุงไทย", $str_bnk);
    $str_bnk = str_replace("BAAC", "ธกส.", $str_bnk);
    $str_bnk = str_replace("TMB", "ทหารไทย", $str_bnk);
    $str_bnk = str_replace("CIMB", "ซีไอเอ็มบี ไทย", $str_bnk);
    $str_bnk = str_replace("UOB", "ยูโอบี", $str_bnk);
    $str_bnk = str_replace("BAY", "กรุงศรีอยุธยา", $str_bnk);
    $str_bnk = str_replace("GSB", "ออมสิน", $str_bnk);
    $str_bnk = str_replace("LHB", "แลนแอนด์เฮาส์", $str_bnk);
    $str_bnk = str_replace("TBN", "ธนชาต", $str_bnk);
    $str_bnk = str_replace("TSCO", "ทิสโก้", $str_bnk);
    $str_bnk = str_replace("KKP", "เกียรตินาคิน", $str_bnk);
    $str_bnk = str_replace("ISBT", "อิสลามแห่งประเทศไทย", $str_bnk);
    $str_bnk = str_replace("GHB", "อาคารสงเคราะห์", $str_bnk);
    $str_bnk = str_replace("CITI", "ซิตี้แบงค์", $str_bnk);

    return $str_bnk;
}


function check_bank_num($bank_number)

{

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM `members` WHERE member_bank_number = ?");

    $stmt->bind_param("s", $bank_number);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $row = 1;

    } else {

        $row = 0;

    }

    return $row;

}



function check_line($lineid)

{

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM `members` WHERE member_line = ?");

    $stmt->bind_param("s", $lineid);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $row = 1;

    } else {

        $row = 0;

    }

    return $row;

}



function check_phone($phone)

{

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM `members` WHERE member_phone = ?");

    $stmt->bind_param("s", $phone);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $row = 1;

    } else {

        $row = 0;

    }

    return $row;

}



function misc_parsestring($text, $allowchr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')

{

    if (empty($allowchr)) {

        $allowchr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    }

    if (empty($text)) {

        return false;

    }

    $size = strlen($text);

    for ($i = 0; $i < $size; $i++) {

        $tmpchr = substr($text, $i, 1);

        if (strpos($allowchr, $tmpchr) === false) {

            return false;

        }

    }

    return true;

}

function curl_get($URL)

{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $URL);

    curl_setopt($ch, CURLOPT_USERAGENT, 'GET FROM web');

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}

function check_member($username)

{

    global $mysqli;

    $result = $mysqli->query("SELECT * FROM `members` WHERE `member_username` = '" . $username . "'");

    $row_member = $result->fetch_assoc();

    return ($row_member);

}

function check_freecredit()

{

    global $mysqli;

    $result = $mysqli->query("SELECT * FROM `slot_freecredit` WHERE `free_start_date` < '" . date('Y-m-d H:i:s') . "' AND `free_end_date` > '" . date('Y-m-d H:i:s') . "'");

    $free_data = $result->fetch_assoc();

    $count = $mysqli->query("SELECT COUNT(*) AS count FROM `slot_topup` WHERE `topup_type` = 'free' AND DATE(`topup_datetime`) BETWEEN '" . $free_data['free_start_date'] . "' AND '" . $free_data['free_end_date'] . "'")->fetch_assoc();

    if ($count['count'] >= $free_data['free_limit'])

        $free_data['limit'] = true;

    else

        $free_data['limit'] = false;



    return ($free_data);

}

/*function get_credit($username)

{

    global $Api;

    $ocode = check_member($username);

    $ocode = $ocode['member_ocode'];

    //$data = json_decode(CURL_GET($Api['url'] . 'Agent/GetCredit?ocode=' . $ocode));

    if ($ocode != '') {

        $data = json_decode(CURL_GET($Api['url'] . 'Agent/GetCredit?ocode=' . $ocode));

        if ($data[0]->Available == null){

            //login_api();

            $data = json_decode(CURL_GET($Api['url'] . 'Agent/GetCredit?ocode=' . $ocode));

        }

        return($data[0]->Available);

        

    } else {

        return 0;

    }



}*/

function get_credit($username)

{

    global $Api;

    $data = json_decode(CURL_GET($Api['url'] . 'GetCredit?username=' . $username));

    if($data->Credit != ''){

        return($data->Credit);

    } else {

        return 0;

    }



}

function promptpay_count($username)

{

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM `slot_promptpay` WHERE `pp_username` = ?");

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $stmt->store_result();

    return $stmt->num_rows;

}

function withdraw_now($username)

{

    global $mysqli;

    $stmt = $mysqli->prepare("SELECT `wd_amount` FROM `slot_withdraw` WHERE `wd_username` = ? AND `wd_status` = 0 LIMIT 1");

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($amount);

    $stmt->fetch();

    $response['numrow'] = $stmt->num_rows;

    if (empty($amount)) {

        $amount = 0;

    }



    $response['amount'] = $amount;

    return json_encode($response);

}

function last_dep($username)

{

    global $mysqli;

    $result = $mysqli->query("SELECT * FROM `slot_topup` WHERE `topup_username` = '" . $username . "' ORDER BY `topup_datetime` DESC LIMIT 1")->fetch_assoc();

    $response['topup_credit'] = $result['topup_credit'];

    $response['topup_amount'] = $result['topup_amount'];

    $response['topup_type'] = $result['topup_type'];

    $response['topup_can'] = $result['topup_can'];

    $response['topup_bonus'] = $result['topup_bonus'];

    return json_encode($response);

}

function last_bonus($username)

{

    global $mysqli;

    $result = $mysqli->query("SELECT `topup_bonus`,`topup_credit`,`topup_type`,`topup_amount` FROM `slot_topup` WHERE `topup_username` = '" . $username . "' ORDER BY `topup_datetime` DESC LIMIT 1")->fetch_assoc();

    $result = $mysqli->query("SELECT `bonus_name` , `bonus_turnover` FROM `slot_bonus` WHERE `bonus_id` = '" . $result['topup_bonus'] . "'")->fetch_assoc();

    $response['name'] = $result['bonus_name'];

    $response['min_credit'] = ($response['topup_credit'] * $result['bonus_turnover']);

    if ($response['min_credit'] == 0) {

        $response['min_credit'] = 300;

    }

    return json_encode($response);

}



function now_bonus($username)

{

    global $mysqli;

    $nowbonus = $mysqli->query("SELECT `member_bonus` FROM `members` WHERE `member_username` = '" . $username . "'")->fetch_assoc();

    if($nowbonus['member_bonus'] == 0)

        $response['bonus_id'] = 1;

    else

        $response['bonus_id'] = $nowbonus['member_bonus'];

    $result = $mysqli->query("SELECT `topup_credit` FROM `slot_topup` WHERE `topup_username` = '" . $username . "' ORDER BY `topup_datetime` DESC LIMIT 1")->fetch_assoc();

    $response['topup_credit'] = $result['topup_credit'];

    $result = $mysqli->query("SELECT `bonus_name` , `bonus_turnover` FROM `slot_bonus` WHERE `bonus_id` = '" . $response['bonus_id'] . "'")->fetch_assoc();

    $response['name'] = $result['bonus_name'];

    $response['min_credit'] = ($response['topup_credit'] * $result['bonus_turnover']);

    if ($response['min_credit'] < 200) {

        $response['min_credit'] = 200;

    }



    return json_encode($response);

}

function promptpay_del_overtime()

{

    global $mysqli;

    $datetime = date("Y-m-d H:i:s");

    $mysqli->query("DELETE FROM `slot_promptpay` WHERE `pp_endtime` < '" . $datetime . "'");

}

function login_api()

{

    global $Api;

    $Check_Agent = CURL_GET($Api['url'] . 'Agent/Login');

}

function add_user($username, $password, $name, $surname, $amount)

{

    global $Api;

    CURL_GET($Api['url'] . "Agent/AddMember?username=" . $username . "&password=" . $password . "&firstname=" . $name . "&lastname=" . $surname . "&amount=" . $amount);

    $get_json = CURL_GET($Api['url'] . "Agent/MemberInfo?username=" . $username);

    $data = json_decode($get_json, true);

    return $data;

}

function add_credit($username, $amount)

{

    global $Api;

    $get_json = CURL_GET($Api['url'] . "TransferCredit?username=" . $username . "&amount=" . $amount);

}

if (!function_exists('str_split')) {

    function str_split($string, $string_length = 1)

    {

        if (strlen($string) > $string_length || !$string_length) {

            do {

                $c = strlen($string);

                $parts[] = substr($string, 0, $string_length);

                $string = substr($string, $string_length);

            } while ($string !== false);

        } else {

            $parts = array($string);

        }

        return $parts;

    }

}

function refill_count_cards($card)

{

    global $mysqli;

    $row = $mysqli->query("SELECT COUNT(*) AS status FROM `slot_tmpay` WHERE password = '$card'")->fetch_row();

    return $row[0];

}



function refill_count_date($username)

{

    global $mysqli;

    $row = $mysqli->query("SELECT COUNT(*) AS status FROM `slot_tmpay` WHERE user_id = '$username' AND status > 1 AND added_time > DATE_SUB('" . date('Y-m-d H:i:s') . "',INTERVAL 1 DAY)")->fetch_row();

    return $row[0];

}



function refill_sendcard($user_id, $password)

{

    global $mysqli;

    global $merchant_id;

    global $resp_url;

    $curl = curl_init('https://www.tmpay.net/tmpay.net/TPG/backend.php?merchant_id=' . $merchant_id . '&password=' . $password . '&resp_url=' . $resp_url . '');

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($curl, CURLOPT_TIMEOUT, 10);

    curl_setopt($curl, CURLOPT_HEADER, false);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    $curl_content = curl_exec($curl);

    curl_close($curl);

    if (strpos($curl_content, 'SUCCEED') !== false) {

        $mysqli->query("INSERT INTO `slot_tmpay`(password,user_id,amount,status,added_time) VALUES ('$password','$user_id',0,0,'" . date('Y-m-d H:i:s') . "')");

        return true;

    } else {

        return $curl_content;

    }



}

function notify($message)

{

    $lineapi = '';

    $mms = trim($message);

    date_default_timezone_set("Asia/Bangkok");

    $chOne = curl_init();

    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");

    // SSL USE

    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);

    //POST

    curl_setopt($chOne, CURLOPT_POST, 1);

    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");

    curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);

    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '');

    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($chOne);

    curl_close($chOne);

}

