
	
			<div class="main__right-catergory js_catergory">			
				<div class="main__right-catergory__edit-add js_catergory_add">
					<div class="main__right-catergory__edit-add__head"><i class="fas fa-th-large"></i>Edit User Management</div>
					<form action="" method="POST" role="form">
						<?php foreach ($data as $row): ?>						
						
						<div class="main__right-catergory__edit-add__content">
							<div class="main__right-catergory__edit-add__content__name">
								<div class="main__right-catergory__edit-add__content__name__label">
									<label for="">User Name:</label>	
								</div>
								<div class="main__right-catergory__edit-add__content__name__input">
									<input type="text" name="user" value="<?php echo $row["user"] ? $row["user"] : "" ;?>">
									<p> <?php echo empty($data["ex_user"]) ? "" : $data["ex_user"] ; ?> </p>
								</div>
							</div>
							<div class="main__right-catergory__edit-add__content__active">
								<div class="main__right-catergory__edit-add__content__name__label">
									<label for="">Active:</label>	
								</div>
								<div class="main__right-catergory__edit-add__content__name__input">
									<!-- <input list="list_active"> -->
									<select class="status_form" name="active">
									    
									    <option value="0" <?php if($row["status"]=="0") echo 'selected="selected"'; ?> >Active</option>
										<option value="1" <?php if($row["status"]=="1") echo 'selected="selected"'; ?> >Deactive</option>
									</select>
								</div>
							</div>

						<?php endforeach ?>
							<div class="main__right-catergory__edit-add__content__submit">
								<button type="submit" name="edit" value="EDIT" >EDIT USER</button>
								<!-- <input type="submit" name="submit" value="SUBMIT"/> -->
							</div>
						</div>
					</form>
					
					<img src="line.png" alt="">
				</div>				
			</div>

