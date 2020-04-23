<?php
if(empty($_SESSION['username'])){
    header('refresh:0;url='.$Web['url']);
    session_destroy();
    exit();
}
if(isset($_GET['logout'])){
    session_destroy();
    header('refresh:0;url='.$Web['url']);
    exit();
} ?>