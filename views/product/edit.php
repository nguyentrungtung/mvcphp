			<script>
		      $(document).ready(function(){
		        $('.add_more').click(function(e){
		          e.preventDefault();
		          $(this).before("<input name='avatar[]' type='file'/>");
		        });
		      });
		    </script>


			<div class="main__right-product js_product">
				<p class="main__right-product__breadcum">Edit Products</p>
				<div class="main__right-product__list js_product_list dp_none">
					<div class="main__right-product__content">
						<div class="main__right-product__content__search">
							<input type="text" name="" placeholder="Some text for search ...">
							<button type="button" class="main__right-product__content__button">Search</button>
						</div>
						<!-- ==================== -->		
						<!-- <img src="line.png" alt=""> -->
					</div>
				</div>	


				<div class="main__right-product__edit-add js_product_add">
					<div class="main__right-product__edit-add__head"><i class="fas fa-th-large"></i>Edit Products Management</div>
					<form action="" enctype="multipart/form-data" method="POST" role="form"  >
						<?php foreach ($data as $row): ?>
						<div class="main__right-product__edit-add__content">
							<div class="main__right-product__edit-add__content__name">
								<div class="main__right-product__edit-add__content__name__label">
									<label for="">Product Name:</label>	
								</div>
								<div class="main__right-product__edit-add__content__name__input">
									<input type="text" name="productname" value="<?php echo $row["name_product"] ? $row["name_product"] : "" ;?>" >
									<p> <?php echo empty($data["ex_productname"]) ? "" : $data["ex_productname"] ; ?></p>
								</div>
							</div>
							<div class="main__right-product__edit-add__content__price">
								<div class="main__right-product__edit-add__content__price__label">
									<label for="">Price:</label>	
								</div>
								<div class="main__right-product__edit-add__content__price__input">
									<input type="number" name="productprice" value="<?php echo $row["price"] ? $row["price"] : "" ;?>" >
									<p> <?php echo empty($data["ex_productprice"]) ? "" : trim($data["ex_productprice"]) ; ?></p>
								</div>
							</div>
							<div class="main__right-product__edit-add__content__description">
								<div class="main__right-product__edit-add__content__description__label">
									<label for="">Description:</label>	
								</div>
								<div class="main__right-product__edit-add__content__description__input">
									<textarea class="text-left" name="description" rows="5" cols="100%">
										<?php echo $row["description"] ? $row["description"] : "" ;?>
									</textarea>
									<p></p>
								</div>
							</div>
							<div class="main__right-product__edit-add__content__description">
								<div class="main__right-product__edit-add__content__description__label">
									<label for="">Image</label>	
								</div>
								<div class="list_img">
										<?php 
										if ($row["image"]) {
											$imgMang = explode("/",$row["image"]); 
											foreach ($imgMang as $key) { ?>

											<img src='../../uploads/<?php echo $key; ?>' class="list_img_edit" alt="">
											<?php 

												//echo $key;
											}
											//print_r($imgMang);
											}

										 ?>
										<!-- <?php echo $row["image"] ? $row["image"] : "" ;?> -->
										
											<!-- <img src='../../uploads/06-home6-01.jpg' class="list_img_edit" alt="">
											
											<img src='../../uploads/06-home6-01.jpg' class="list_img_edit" alt=""> -->
										
										
								</div>
							</div>
							<div class="main__right-product__edit-add__content__upload_img">
								<div class="main__right-product__edit-add__content__description__label">
									<label for="">Upload Image:</label>	
								</div>
								<div class="main__right-product__edit-add__content__description__input">
									<input name='avatar[]' type='file' />
     								<button class="add_more">Add More Files</button>	
								</div>
							</div>
							<div class="main__right-product__edit-add__content__active">
								<div class="main__right-product__edit-add__content__name__label">
									<label for="">Active:</label>	
								</div>
								<div class="main__right-product__edit-add__content__name__input">
									
									<select class="status_form" name="active">
									    <option value="0">Active</option>
									    <option value="1">Deactive</option>
									</select>
								</div>
							</div>
						<?php endforeach ?>
							<div class="main__right-product__edit-add__content__submit">
								<!-- <button type="button" class="js_add-product_btn">Add</button> -->
								<button type="submit" name="edit" value="EDIT" >Add</button>
							</div>
						</div>
					</form>
					<img src="line.png" alt="">
				</div>
			</div>