<?php 

/**
 * model csdl vs category
 */
class product_Model extends Model
{
	public $table="product";
	
	function __construct()
	{
		parent::__construct();
	}

	public function getdata(){
		$this->select($this->table);
		if($this->num_rows()==0){
         return false;
		}else{
		return true;
		}		
		
	}
	
	public function limit($start, $limit){

		$sql = "SELECT * FROM $this->table LIMIT $start, $limit";
		//echo $sql; die();
		$this->query($sql);
	}

	public function checkexist($file){
		$sql = "SELECT * FROM $this->table WHERE name_product LIKE '%$file%'";
		$this->query($sql);
		if($this->num_rows()==0){
         return false;
		}else{
		return true;
		}
	}

	public function getone($id){
		$where = array('id' => $id);
		$this->select($this->table,$where);
		if($this->num_rows()==0){
         return false;
		}else{
		return true;
		}
	}

	public function active($checkid){
		$sql = "UPDATE $this->table SET status='0' WHERE id IN ($checkid)";
		$this->query($sql);
	}
	public function deactive($checkid){
		$sql = "UPDATE $this->table SET status='1' WHERE id IN ($checkid)";
		//echo $sql; die();
		$this->query($sql);
	}

	public function insert($productname,$str_img,$description,$productprice,$status){
		
		$datetime = $this->setTimestamp();
		$file = "(name_product,image,description,price,status,time_create,time_update)";	
		$values = "('$productname','$str_img','$description','$productprice','$status','$datetime','$datetime')";
		$sql = "INSERT INTO $this->table $file VALUES $values";
		// echo "<pre>";
		// var_dump($sql);die();
		//echo $datetime; die();
		$this->query($sql);
	}

	public function del($id){
		$sql = "DELETE FROM $this->table WHERE id = $id";
		if ($this->query($sql)) {
		 	return true;
		 }else{
		 	return false;
		 }
	}

	public function update($productname,$str_img,$description,$productprice,$status,$id){			
		$timeup = $this->setTimestamp();
		$sql = "UPDATE $this->table SET name_product ='$productname', image ='$str_img', description = '$description', price = '$productprice', time_update ='$timeup' where id = $id";
		 //  echo $sql;
		 // die();
		// var_dump($sql); die();
		$this->query($sql);

	}

	public function search($search){
		$sql = "SELECT * FROM $this->table WHERE name_product LIKE '%$search%'";
		$this->query($sql);
	}
}

 ?>