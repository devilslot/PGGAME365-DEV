<?php
/*
if($_SESSION['level'] == '0'){
    $credit = 0;
}else{
    $json = json_decode(curl_get($Api['url'].'GetCredit?username='.$_SESSION['username']));
    $credit = $json->Credit;
}*/
?>
<div class="card card-body card-form p-lg-5">
    <p class="text-center " style="color:#495057">เครดิตคงเหลือ : <?php echo $credit;?></p>
</div>
<br />