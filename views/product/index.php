<script type="text/javascript">

    function do_this(){

        var checkboxes = document.getElementsByName('checkid[]');
        var button = document.getElementById('toggle');

        if(button.value == 'select'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'select';
        }
    }
</script>		
			<div class="main__right-product js_product">
				<p class="main__right-product__breadcum">List Products</p>
				<div class="main__right-product__list js_product_list">
					<!-- <form action="" method="POST" role="form"> -->
					<div class="main__right-product__content">
						
						<form action="<?php echo __SITE_PATH."product/search";?>" method="GET" role="form">
							<div class="main__right-catergory__content__search">
								<input type="text" name="search" placeholder="Some text for search ...">
								<button type="submit" class="main__right-catergory__content__button">Search</button>
							</div>
						</form>
						<!-- ==================== -->
						<form action="" method="POST" role="form">
						<div class="main__right-product__content__management">
							<div class="main__right-product__content__management__head"><i class="fas fa-list-ul"></i>Products</div>
							<button type="button" class="main__right-product__content__management__button js_add-product"><a href="<?php echo __SITE_PATH."product/add";?>" title="">Add Products</a></button>
							<!-- ------------ -->
						
							<table>
								<tbody>
									<tr>
										<th>
											<input type="checkbox" id="toggle" value="select" onClick="do_this()" />
										</th>
										<th>ID</th>
										<th>Products name</th>
										<th>Price</th>
										<th>Active</th>
										<th>Time Created</th>
										<th>Time Update</th>
										<th>Action</th>
									</tr>

									<?php foreach ($data as $row): ?>						
									<tr>
										<td><input type="checkbox"name="checkid[]" value="<?php echo $row['id']; ?>" ></td>
										<td><?php echo $row['id']; ?></td>
										<td><?php echo $row['name_product']; ?></td>
										<td><?php echo $row['price']; ?></td>
										<td><?php echo $row['status'] == 0 ?  "Active" : "Deactive"; ?></td>
										<td><?php echo date("H:i:s d/m/Y",$row['time_create']); ?></td>
										<td><?php echo date("H:i:s d/m/Y",$row['time_update']); ?></td>
										<td>
											<a class="" href="<?php echo __SITE_PATH."product/edit/".$row['id'];?>">Edit</a> |
											<a href="<?php echo __SITE_PATH."product/delete/".$row['id'];?>" class="">Xóa</a>
										</td>
									</tr>
									<?php endforeach ?>

								</tbody>
							</table>
							<!-- ------------ -->
						
							<button type="submit" name="active" value="active" class="main__right-catergory__content__management__button_accept">Active
							</button>
							<button type="submit" name="deactive" value="deactive" class="main__right-catergory__content__management__button_deaccept">Deavtive</button>
						</form>	
							<div class="phantrang">
								<?php echo $pagination; ?>
							</div>
						</div>
					<!-- </form> -->
					
						<!-- <img src="line.png" alt=""> -->
					</div>
				</div>
				
			</div>