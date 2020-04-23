<?php 

require_once 'dbmodel.php';
require_once 'function.php';

$config = include('config.php');

?>
	<!DOCTYPE html>
	<html lang="th">

	<head>
		<?php
            include(dirname(__FILE__).'/template/head.php');
        ?>
	</head>

	<body>
		<!-- Header -->
		<!-- Main -->
		<main class="main">
				<!-- Content -->
				<section class="content">
					<div class="container">
						<div class="card card-content">
							<!-- Register -->
							<div class="register card-body">
								<h3 class="card-title">สมัครสมาชิก</h3>
                        <p>* กรุณากรอกเฉพาะข้อมูลจริงเท่านั้น เพื่อประโยชน์ของตัวท่านเองในการถอนเงิน</p>
								<form method="POST" id="register">
                        <!--
								<form method="POST" action="/exec/register.php">
                        -->
                           <div class="input-group mb-3">
										<input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อจริง">
                              <input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุลจริง"> 
							  <!--
                              <input type="hidden" name="player_session" id="player_session" value="<?=$player_session?>">
							  -->
                           </div>
									<div class="input-group mb-3">
										<div class="input-group-prepend"> <span class="input-group-text"><img src="./assets/images/bank.png" alt=""></span> </div>
										<select class="form-control" id="bankcode" required="" name="bankcode">
											<option selected="selected" value="">-- เลือกธนาคาร --</option>
											<option value="KBANK">กสิกรไทย</option>
											<option value="SCB">ไทยพานิชย์</option>
											<option value="KTB">กรุงไทย</option>
											<option value="BBL">กรุงเทพ</option>
											<option value="BAY">กรุงศรีอยุธยา</option>
											<option value="TMB">ทหารไทย</option>
											<option value="TBN">ธนชาติ</option>
											<option value="BAAC">ธ.ก.ส.</option>
											<option value="TSCO">ทิสโก้</option>
											<option value="CITI">ซิตี้แบงค์</option>
											<option value="LHB">แลนด์ แอนด์ เฮ้าส์</option>
											<option value="GSB">ออมสิน</option>
											<option value="GHB">อาคารสงเคราะห์</option>
											<option value="ISBT">อิสลามแห่งประเทศไทย</option>
										</select>
									</div>
									<div class="input-group mb-3">
										<div class="input-group-prepend"> <span class="input-group-text"><img src="./assets/images/bank-number.png"
                                            alt=""></span> </div>
										<input type="text" class="form-control" name="bankaccount" id="bankaccount" placeholder="เลขบัญชีธนาคาร"> </div>
									<div class="input-group mb-3">
										<div class="input-group-prepend"> <span class="input-group-text"><img src="./assets/images/phone.png" alt=""></span> </div>
										<input type="tel" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์"> </div>
									<div class="input-group mb-3">
										<div class="input-group-prepend"> <span class="input-group-text"><img src="./assets/images/line-id.png" alt=""></span> </div>
										<input type="text" class="form-control" name="lineid" id="lineid" placeholder="LINE ID"> </div>
									<div class="input-group mb-3">
										<div class="input-group-prepend" onclick="passwordToggle()"> 
											<span class="input-group-text"><img src="./assets/images/password.png" class="img-fluid" alt=""></span> 
										</div>
										<input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน"> 
									</div>
									<div class="input-group mb-3">
										<div class="input-group-prepend"> 
											<span class="input-group-text"><img src="./assets/images/plus.png" class="img-fluid" alt=""></span> 
										</div>
										<input type="checkbox" class="form-control" name="promo" id="promo" value="1"> รับโบนัสฝากครั้งแรก 50%
									</div>
									<div class="text-center">
										<button type="submit" id="btn-submit">สมัครสมาชิก</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>
		</main>
		<!-- Footer -->
		<!-- JS -->
		<?php
        include(dirname(__FILE__).'/template/footer_js.php');
      ?>
			<script>
			function passwordToggle() {
				var x = document.getElementById("password");
				if(x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}
			</script>
			<script>
            $("#register").submit(function(e) {
               e.preventDefault();
               $.post('/exec/register.php', $(this).serialize(), function(data) {
                  $("#alerts").html(data)
               });
            });
			</script>
	</body>

	</html>