	<script>
      $(document).ready(function(){
        $('.add_more').click(function(e){
          e.preventDefault();
          $(this).before("<input name='avatar[]' type='file'/>");
        });
      });
    </script>

    <!-- <form enctype="multipart/form-data" action="upload.php" method="post">
	    <input name="file[]" type="file" />
	    <button class="add_more">Add More Files</button>
	    <input type="submit" value="Upload File" id="upload"/>
    </form>	 -->		

			<div class="main__right-product js_product">
				<p class="main__right-product__breadcum">Add Products</p>
				<div class="main__right-product__list js_product_list dp_none">
					<div class="main__right-product__content">	
					</div>
				</div>
				
				<div class="main__right-product__edit-add js_product_add">
					<div class="main__right-product__edit-add__head"><i class="fas fa-th-large"></i>Add Products Management</div>
					<form action="" enctype="multipart/form-data" method="POST" role="form"  >
						<div class="main__right-product__edit-add__content">
							<div class="main__right-product__edit-add__content__name">
								<div class="main__right-product__edit-add__content__name__label">
									<label for="">Product Name:</label>	
								</div>
								<div class="main__right-product__edit-add__content__name__input">
									<input type="text" name="productname" placeholder="some text value ...">
									<p> <?php echo empty($data["ex_productname"]) ? "" : $data["ex_productname"] ; ?></p>
								</div>
							</div>
							<div class="main__right-product__edit-add__content__price">
								<div class="main__right-product__edit-add__content__price__label">
									<label for="">Price:</label>	
								</div>
								<div class="main__right-product__edit-add__content__price__input">
									<input type="number" name="productprice" placeholder="some text value ...">
									<p> <?php echo empty($data["ex_productprice"]) ? "" : $data["ex_productprice"] ; ?></p>
								</div>
							</div>
							<div class="main__right-product__edit-add__content__description">
								<div class="main__right-product__edit-add__content__description__label">
									<label for="">Description:</label>	
								</div>
								<div class="main__right-product__edit-add__content__description__input">
									<textarea  name="description" rows="5" cols="100%"></textarea>
									<p></p>
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
							<div class="main__right-product__edit-add__content__submit">
								<!-- <button type="button" class="js_add-product_btn">Add</button> -->
								<button type="submit" name="submit" value="SUBMIT" >Add</button>
							</div>
						</div>
					</form>
					<img src="line.png" alt="">
				</div>
			</div>