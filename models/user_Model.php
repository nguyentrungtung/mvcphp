<?php
class user_Model extends Model{
	public $table="tb_user";
	public function __construct(){
		 parent::__construct();
    }
	public function login(){
		$user=$_POST['user'];
		$pass=md5($_POST['password']);
		$where=array('user'=>$user,'password'=>$pass);
		$this->select($this->table,$where);
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
		$sql = "SELECT * FROM $this->table WHERE user LIKE '%$file%'";
		$this->query($sql);
		if($this->num_rows()==0){
         return false;
		}else{
		return true;
		}
	}

	public function insert($user,$password,$status){
		$password = md5($password);
		$datetime = $this->setTimestamp();
		$file = "(user,password,status,time_create,time_update)";	
		$values = "('$user','$password',$status,$datetime,$datetime)";
		$sql = "INSERT INTO $this->table $file VALUES $values";
		
		$this->query($sql);
	}


	public function getdata(){
		$this->select($this->table);
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

	public function update($user, $status, $id){
		$timeup = $this->setTimestamp();
		$sql = "UPDATE $this->table SET user ='$user', status ='$status', time_update ='$timeup' where id = $id";
		// echo "<pre>";
		// var_dump($sql); die();
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
		$sql = "SELECT * FROM $this->table WHERE user LIKE '%$search%'";
		$this->query($sql);
	}


}
?>