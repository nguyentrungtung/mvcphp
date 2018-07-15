<?php 

/**
 * model csdl vs category
 */
class category_Model extends Model
{
	public $table = "category";
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
		$sql = "SELECT * FROM $this->table WHERE name_cate LIKE '%$file%'";
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

	public function update($categoryname, $status, $id){
		$timeup = $this->setTimestamp();
		$sql = "UPDATE $this->table SET name_cate ='$categoryname', status ='$status', time_update ='$timeup' where id = $id";
		// echo "<pre>";
		// var_dump($sql); die();
		$this->query($sql);

	}

	public function insert($categoryname,$status){
		$datetime = $this->setTimestamp();
		//echo $datetime;
		//echo date('H:i:s', $datetime) ; die();		
		$file = "(name_cate,status,time_create,time_update)";	
		$values = "('$categoryname',$status,$datetime,'$datetime')";
		// echo "<pre>";
		// var_dump($values); die();
		$sql = "INSERT INTO $this->table $file VALUES $values";
		
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
	
	public function active($checkid){
		$sql = "UPDATE $this->table SET status='0' WHERE id IN ($checkid)";
		$this->query($sql);
	}
	public function deactive($checkid){
		$sql = "UPDATE $this->table SET status='1' WHERE id IN ($checkid)";
		//echo $sql; die();
		$this->query($sql);
	}

	public function search($search){
		$sql = "SELECT * FROM $this->table WHERE name_cate LIKE '%$search%'";
		$this->query($sql);
	}

}




 ?>