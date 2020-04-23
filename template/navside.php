<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">

  <div class="main-menu-content">

    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      <?php

        if(!isset($_SESSION['username'])){ ?>

      <li><a href="login"><i class="la la-sign-in"></i><span class="menu-title">เข้าสู่ระบบ</span></a></li>

      <li><a href="register"><i class="la la-user-plus"></i><span class="menu-title">สมัครสมาชิก</span></a></li>

      <?php }else{

       $credit = get_credit($_SESSION['username']); ?>

      <li><a>ยูสเซอร์เนม :

          <span class="text-warning"><?php echo $_SESSION['username']; ?></span></a></li>

      <li><a>เครดิต :

          <span class="text-warning"><?php echo $credit; ?></span></a></li>

      <li><a href="profile"><i class="la la-user"></i><span class="menu-title">โปรไฟล์</span></a></li>

      <li><a href="freecredit"><i class="la la-gift"></i><span class="menu-title">รับเครดิตฟรี</span></a></li>

      <li class="nav-item"><a href="#"><i class="la la-plus-circle"></i><span class="menu-title">เติมเงิน</span></a>

        <ul class="menu-content">

          <li><a class="menu-item" href="scb">ฝากเงินอัตโนมัติ</a></li>
		  
		  <li><a class="menu-item" href="truewallet">ฝากเงิน Truewallet</a></li>
		  
        </ul>

      </li>

      <li><a href="withdraw"><i class="la la-money"></i><span class="menu-title">ถอนเงิน</span></a></li>

      <li><a href="transaction"><i class="la la-history"></i><span class="menu-title">ประวัติรายการ</span></a></li>

      <li><a href="logout" class="text-danger"><i class="la la-sign-out"></i><span class="menu-title">ออกจากระบบ</span></a></li>

      <?php } ?>

      <hr />

      <li><a href="index"><i class="la la-home"></i><span class="menu-title">หน้าหลัก</span></a></li>

      <li class="nav-item"><a href="#"><i class="la la-gamepad"></i><span class="menu-title">เข้าเล่นเกมส์</span></a>

        <ul class="menu-content">

          <li><a class="menu-item" href="download"><i class="la la-android"></i>Android</a></li>

          <li><a class="menu-item" href="download"><i class="la la-apple"></i>iOS</a></li>

          <li><a class="menu-item" href="https://slotxo.com"><i class="la la-desktop"></i>เล่นบน Web</a></li>

        </ul>

      </li>

      <hr />

      <li class="navigation-header">

        <span>ติดต่อเรา</span>

      </li>

      <li><a href="https://www.facebook.com/SAGAME3688-488202355341105"><i class="la la-facebook-official"></i><span class="menu-title">FB : SAGAME3688</span></a></li>

      <li><a href="https://bit.ly/2MLJQfg"><i class="la la-comments"></i><span class="menu-title">Line : @sagame3688</span></a></li>



    </ul>

  </div>

</div>