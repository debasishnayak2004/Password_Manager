<?php
class database{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db_name = "password_maneger";
    public $conn;
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
       
    }

    private function table($table){
        $sql = "show tables from $this->db_name like '$table'";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            echo "wrong table name";
        }

    }
    public function insert($table, $data = array()){
        if($this->table($table)){
            $row = implode(",", array_keys($data));
            $rowValue = implode("','",$data);
            $sql = "insert into $table ($row) values ('$rowValue')";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

    }

    public function update($table, $values=array(), $id){
        if($this->table($table)){
            $data =[];
            foreach($values as $key=>$value){
                $data[] = "$key = '$value'";
            }
            $info = implode(",", $data);
            $sql = "update  $table set $info where id = $id";
            $result = mysqli_query($this->conn, $sql);
            return $result;
            
        }
    }

    public function delete($table, $id){
        if($this->table($table)){
            $sql = "delete from $table where id = $id";
            $result = mysqli_query($this->conn, $sql);
            if($result){
                return $result;
            }else{
                return "0";
            }
        }
    }

    public function selectAll($table){
        if($this->table($table)){
            $sql = "select * from $table";
            $result = mysqli_query($this->conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                return $row;
            }
            
        }
    }

    public function selectId($table, $id){
        if($this->table($table)){
            $sql = "select * from $table where id = $id";
            $result = mysqli_query($this->conn, $sql);
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }
    }
}
?>