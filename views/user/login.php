
<!-- <div class="error" style="background:#FC6;color:red;padding:10px"> -->


<!-- </div> -->

<style type="text/css">
	div#conten {
	    width: 100%;
	    height: auto;
	}
	.input-login {
	    width: 260px;
	    margin: auto;
	}
	.error-login {
		text-align: center;
		color: red;
	}
</style>

<?php 
	// echo "<pre>";
	// var_dump($_SESSION['user']);

 ?>

 <div class="input-login">
 	<form action="" method="POST" role="form">
 		<legend>Đăng Nhập Quản Trị</legend>
 	
 		<div class="form-group">
 			<label for="">User</label>
 			<input type="text" class="form-control" name="user" placeholder="Tài Khoản">
 		</div>
 		<div class="form-group">
 			<label for="">Password</label>
 			<input type="password" class="form-control" name="password" placeholder="*********">
 		</div>
 		<button type="submit" name="login" class="btn btn-primary">Login</button>
 	</form>
 </div>



