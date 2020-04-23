<!-- Header -->
<header class="header sticky-top">
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./assets/images/logo.png" alt="XOSLOT69">
                </a>

                <?php if(isset($_SESSION['username'])){ ?>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                                <a class="nav-link" href="profile.php">โปรไฟล์</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="deposit.php">ฝากเงิน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="withdraw.php">ถอนเงิน</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://public.pg-redirect.net/web-lobby/tournament/?operator_token=fu6fpagpekf7445m6sdeecr8xvkkfvy6&operator_player_session=abc123-abc123&language=en">เข้าเล่น</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="?logout">ออกจากระบบ</a>
                            </li>
                </ul>
                <?php } else {?>

                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">สมัครสมาชิก</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://public.pg-redirect.net/web-lobby/tournament/?operator_token=fu6fpagpekf7445m6sdeecr8xvkkfvy6&operator_player_session=abc123-abc123&language=en">ทดลองเล่น</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="download.php">ดาวน์โหลด</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                    </li>
                </ul>
                <?php } ?>

                
            </div>
        </nav>
    </header>