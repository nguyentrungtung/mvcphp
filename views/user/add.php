
	
			<div class="main__right-catergory js_catergory">			
				<div class="main__right-catergory__edit-add js_catergory_add">
					<div class="main__right-catergory__edit-add__head"><i class="fas fa-th-large"></i>Create Add User Management</div>
					<form action="" method="POST" role="form">
						<div class="main__right-catergory__edit-add__content">
							<div class="main__right-catergory__edit-add__content__name">
								<div class="main__right-catergory__edit-add__content__name__label">
									<label for="">User Name:</label>	
								</div>
								<div class="main__right-catergory__edit-add__content__name__input">
									<input type="text" name="user" placeholder="some text value ...">
									<p> <?php echo empty($data["ex_user"]) ? "" : $data["ex_user"] ; ?> </p>
								</div>
							</div>

							<div class="main__right-catergory__edit-add__content__name">
								<div class="main__right-catergory__edit-add__content__name__label">
									<label for="">Password:</label>	
								</div>
								<div class="main__right-catergory__edit-add__content__name__input">
									<input type="password" name="password" placeholder="*****">
									<p><?php echo empty($data["ex_password"]) ? "" : $data["ex_password"] ; ?></p>
								</div>
							</div>

							<div class="main__right-catergory__edit-add__content__active">
								<div class="main__right-catergory__edit-add__content__name__label">
									<label for="">Active:</label>	
								</div>
								<div class="main__right-catergory__edit-add__content__name__input">
									<!-- <input list="list_active"> -->
									<select class="status_form" name="active">
									    <option value="0">Active</option>
									    <option value="1">Deactive</option>
									</select>
								</div>
							</div>
							<div class="main__right-catergory__edit-add__content__submit">
								<button type="submit" name="submit" value="SUBMIT" >Add</button>
								<!-- <input type="submit" name="submit" value="SUBMIT"/> -->
							</div>
						</div>
					</form>
					
					<img src="line.png" alt="">
				</div>				
			</div>


<?php 
// echo "<pre>";
// var_dump($data);


 ?>
