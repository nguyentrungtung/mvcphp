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
<!-- <?php global $content; ?> -->
			<p class="main__right-catergory__breadcum">List User</p>
				<div class="main__right-catergory__list js_catergory_list">
					<div class="main__right-catergory__content">
						<!-- <div class="main__right-catergory__content__search">
							<input type="text" name="" placeholder="Some text for search ...">
							<button type="button" class="main__right-catergory__content__button">Search</button>
						</div> -->
						<form action="<?php echo __SITE_PATH."user/search";?>" method="GET" role="form">
							<div class="main__right-catergory__content__search">
								<input type="text" name="search" placeholder="Some text for search ...">
								<button type="submit" class="main__right-catergory__content__button">Search</button>
							</div>
						</form>

						<form action="" method="POST" role="form">
							<div class="main__right-catergory__content__management">
								<div class="main__right-catergory__content__management__head"><i class="fas fa-th-large"></i>User</div>
								<button type="button"class="main__right-catergory__content__management__button"><a href="<?php echo __SITE_PATH."user/add";?>" title="">Add User</a></button>
								<!-- ------------ -->
								<table>
									<?php echo $content; ?>
									<tbody>
										<tr>
											<th><input type="checkbox" id="toggle" value="select" onClick="do_this()" /></th>
											<th>ID</th>
											<th>User name</th>
											<th>Active</th>
											<th>Time Created</th>
											<th>Time Update</th>
											<th>Action</th>
										</tr>
										<?php foreach ($data as $row ): ?>
											
										<tr>
											<td><input type="checkbox" name="checkid[]" value="<?php echo $row['id']; ?>" ></td>
											<td><?php echo $row['id']; ?></td>
											<td><?php echo $row['user']; ?> </td>
											<td><?php echo $row['status'] == 0 ?  "Active" : "Deactive"; ?></td>
											<td><?php echo date("H:i:s d/m/Y",$row['time_create']); ?></td>
											<td><?php echo date("H:i:s d/m/Y",$row['time_update']); ?></td>
											<td>
												<a class="" href="<?php echo __SITE_PATH."user/edit/".$row['id'];?>">Edit</a> |
												<a href="<?php echo __SITE_PATH."user/delete/".$row['id'];?>" class="">Xóa</a>
											</td>
										</tr>
										
										<?php endforeach ?>	
									</tbody>
								</table>
								<!-- ------------ -->
								<button type="submit" name="active" value="active" class="main__right-catergory__content__management__button_accept">Active
								</button>
								<button type="submit" name="deactive" value="deactive" class="main__right-catergory__content__management__button_deaccept">Deavtive</button>
								<div class="phantrang">
									<?php echo $pagination; ?>
								</div>
							</div>
						</form>
						
						<!-- <img src="line.png" alt=""> -->
					</div>
				</div>

			
			