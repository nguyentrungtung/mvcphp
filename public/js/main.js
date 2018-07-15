$(document).ready(function(){

	$(".js_menu_catergory").click(function(){
		$('.js_product').addClass("dp_none");
		$('.js_catergory').removeClass("dp_none");
		$('.js_catergory_list').removeClass("dp_none");
	});

	$('.js_add-catergory').click(function(){
		$('.js_catergory_list').addClass("dp_none");
		$('.js_catergory_add').removeClass("dp_none");
	});

	$('.js_add-catergory_btn').click(function(){
		$('.js_catergory_list').removeClass("dp_none");
		$('.js_catergory_add').addClass("dp_none");
	});

	$('.js_editCat-btn').click(function(){
		$('.js_catergory_list').addClass("dp_none");
		$('.js_catergory_edit').removeClass("dp_none");
	});

	$('.js_edit-catergory_btn').click(function(){
		$('.js_catergory_list').removeClass("dp_none");
		$('.js_catergory_edit').addClass("dp_none");
	});

	// ===========================================

	$(".js_menu_product").click(function(){
		$('.js_catergory').addClass("dp_none");
		$('.js_product').removeClass("dp_none");
		$('.js_product_list').removeClass("dp_none");
	});

	$('.js_add-product').click(function(){
		$('.js_product_list').addClass("dp_none");
		$('.js_product_add').removeClass("dp_none");
	});

	$('.js_add-product_btn').click(function(){
		$('.js_product_list').removeClass("dp_none");
		$('.js_product_add').addClass("dp_none");
	});

	$('.js_editPro-btn').click(function(){
		$('.js_product_list').addClass("dp_none");
		$('.js_product_edit').removeClass("dp_none");
	});

	$('.js_edit-product_btn').click(function(){
		$('.js_product_list').removeClass("dp_none");
		$('.js_product_edit').addClass("dp_none");
	});
});