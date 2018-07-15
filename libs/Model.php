<?php
class Model{

	protected $DB_HOST = __HOST;
	protected $DB_NAME = __DB_NAME;
	protected $DB_USER = __USER;
	protected $DB_PASSWORD = __PASS;
	//protected $tableName;
	protected $conn;
    public function __construct(){//kết nối
		if ($this->conn == NULL){
	       	$this->conn = mysqli_connect($this->DB_HOST,$this->DB_USER,$this->DB_PASSWORD,$this->DB_NAME) or die ('Lỗi kết nối');
	        mysqli_set_charset($this->conn, 'UTF8'); 
	    }	
	}

	public function disconnect(){//ngắt kết nối
		
		if ($this->connect) {
			mysqli_close($this->connect);
		}
	}

	public function queryfetch(){
		if($this->result)
		{
			if($this->num_rows()!=0){
				while($row=mysqli_fetch_array($this->result)){
					$this->data2[]=$row;
				}
			}else{
				$this->data2=0;
			}
		}
		return $this->data2;
	}
	public function query($sql){//truy vấn
		
		
		$this->result = mysqli_query($this->conn,$sql);
		// echo "<pre>";
		// var_dump($this->result);die("chet di");
		// if ($this->result=mysqli_query($sql,$this->conn)) {
		// 	echo "truy van thanh cong du lieu"; die();
		// }
	}
	public function num_rows(){//đếm số dòng trả về từ câu lệnh truy vấn
		if($this->result){
		    $rows=mysqli_num_rows($this->result);
		}
		else{
		    $rows=0;
		}
		return $rows;
	}
	public function fetch()
	{
		if($this->result)
		{
			if($this->num_rows()!=0){
				while($row=mysqli_fetch_array($this->result)){
					$this->data[]=$row;
				}
			}else{
				$this->data=0;
			}
		}
		return $this->data;
	 }
	public function select($table, $where='')
	{
		
		if($where != "")
		{
			if(is_array($where))
			{
				foreach($where as $k => $v)
				{
					$sql[]= "$k='$v'";
				}
				$where=implode(" and ",$sql);
				$where="where $where";
			}
			else
			{
				$where="where $where";
			}
		}
		$sql="select * from $table $where";

		$this->query($sql);
	}

	public function delete($id){
		$sql = "DELETE FROM $this->table WHERE id = $id";
	}

	public function setTimestamp(){
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		return strtotime(date("d-m-Y H:i:s"));
	}

	public function checkLogin()
    {
        if(Session::get("login")==true){
        	return true;
        }else{
        	return false;
        }
    }

}
?>