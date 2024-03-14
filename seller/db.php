<?php
class dbConn{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "ecsbs";
 /*    private $host = "sql208.epizy.com";
    private $username = "epiz_25373149";
    private $password = "UuCEpaWc4CP1BeB";
    private $dbName = "epiz_25373149_gpstore"; */

    private $con_status = false ;
    public $con = '';
    public function __construct(){
        if(!$this->con_status){
        $this->con = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName,$this->username, $this->password);
        $this->con_status = true;
        }else{

        }
    }

    public function create($table, $args = array()){
        $table_col = implode(', ', array_keys($args));
        $temp = array();
        foreach($args as $value) {
            array_push($temp, '?');
        }
        $table_val = implode(", ", $temp);
        
        try {
            $sql = "INSERT INTO $table ($table_col) VALUES ($table_val)";
            $query = $this->con->prepare($sql);
            $query->execute(array_values($args));
            return 1;
            
          } catch(PDOException $e) {
            
            return "Error: " . $e->getMessage();
            //return 0;
          }
    }
    public function createGetId($table, $args = array()){
        $table_col = implode(', ', array_keys($args));
        $temp = array();
        foreach($args as $value) {
            array_push($temp, '?');
        }
        $table_val = implode(", ", $temp);
        try {
            $sql = "INSERT INTO $table ($table_col) VALUES ($table_val)";
            $query = $this->con->prepare($sql);
            $query->execute(array_values($args));
            //return ['status'=> 1 , 'data'=>$this->read_specific($table, "id = ?", [$this->con->lastInsertId()])[0]];
            return ['status'=> 1 , 'data'=>$this->con->lastInsertId()];
            
          } catch(PDOException $e) {
            
            return ['status'=> 0 , 'data'=>["messege"=>$e->getMessage()]];
            //return 0;
          }
    }
    public function read($table){
        $sql = "SELECT * FROM $table";
        $result = $this->con->query($sql);
        if($result->rowCount() > '0'){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return 0;
        }
    }
    public function read_single($table, $table_id){
        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$table_id]);
        if($stmt->rowCount() > '0'){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return 0;
        }
    }
    public function read_specific($table, $query, $args_val){
    // coloumn Should also provide in this method EX.- g_id =1 ,or  name = 'aman'
        $sql = "SELECT * FROM $table WHERE $query";
        $result = $this->con->prepare($sql);
        $result->execute($args_val);
        $holdResult = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result->rowCount() > '0'){
            return $holdResult;
        }else{
            return 0;
        }
    }
    public function update($table, $update, $where, $redirect=null){
        $sql = "UPDATE $table SET $update WHERE $where";
        if($this->con->query($sql)){
            //header ('location: '.urldecode($redirect));
            return 1;
        }else{
            return 0;
        }
    }
    public function delete(){

    }

    public function __destruct(){
        if($this->con_status){
            $this->con = null;
            $this->con_status = false;
        }
    }

}


$db = new dbConn();
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function random_strings($length_of_string = 10){
 
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}

date_default_timezone_set("Asia/Calcutta"); 

session_start();

//$_POST = json_decode(file_get_contents('php://input'), true);

function res($status, $data){
    return json_encode(['status'=>$status,'data'=>$data]);
}


?>

