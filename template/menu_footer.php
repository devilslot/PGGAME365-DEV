<footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg">THE EXCLUSIVE OF SLOT ONLINE XOSLOT69</div>
                <div class="col-lg-auto">
                <?php if(isset($_SESSION['username'])){ ?>
                    <ul class="nav">                            
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php"><i class="fas fa-user"></i>โปรไฟล์</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="deposit.php"><i class="fas fa-money-bill-alt"></i>ฝากเงิน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="withdraw.php"><i class="fas fa-hand-holding-usd"></i>ถอนเงิน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php"><i class="fab fa-line"></i>ติดต่อเรา</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?logout"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a>
                            </li>
                        </ul>
                <?php } else {?>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php"><i class="fas fa-home"></i>หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php"><i class="fas fa-money-bill-alt"></i>เข้าสู่ระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i>สมัครสมาชิก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="download.php"><i class="fas fa-download"></i>ดาวน์โหลด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php"><i class="fab fa-line"></i>ติดต่อเรา</a>
                        </li>
                    </ul>
                <?php } ?>
                   
                    
                </div>
            </div>
        </div>
    </footer>