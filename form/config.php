<?php
class Model{
    private $servername='localhost';
    private $username='root';
    private $password='';
    private $dbname='student_details';
    private $conn;
    function __construct(){
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error){
            echo'Connection failed';
        }else{
            return $this->conn;
        }
    }

    public function insertRecord($post){
        $name = $post['name'];
        $email = $post['email'];
        $password = $post['password'];
        $phone = $post['phone'];
        $address = $post['address'];

        $sql ="INSERT INTO data(name,email,password,phone,address)VALUES('$name','$email','$password','$phone','$address')";        
        $result = $this->conn->query($sql);
        
        if($result){
            header('location:index.php?msg=ins');
        }else{
            echo"Error".$sql."<br>".$this->conn->error;
        }
    }

    public function updateRecord($post){
        $name = $post['name'];
        $email = $post['email'];
        $password = $post['password'];
        $phone = $post['phone'];
        $address = $post['address'];
        $editid=$post['hid'];

        $sql ="UPDATE data SET name='$name',email='$email',password='$password',phone='$phone',address='$address' WHERE id='$editid'";        
        $result = $this->conn->query($sql);
        
        if($result){
            header('location:index.php?msg=ups');
        }else{
            echo"Error".$sql."<br>".$this->conn->error;
        }
    }

    public function deleteRecord($delid){
        $sql ="DELETE FROM data WHERE id='$delid'";
        $result =$this->conn->query($sql);
        if ($result){
            header('location:index.php?msg=del');
        }else{
            echo "Error".$sql."<br>".$this->conn->error;
        }
    }

    public function displayRecord(){
        $sql = "SELECT * FROM data";
        $result = $this->conn->query($sql);
        if ($result->num_rows>0){
            while($row =$result->fetch_assoc()){
                $data[] =$row;
            }
            return $data;
        }

    }
    public function displayRecordById($editid){
        $sql = "SELECT * FROM data WHERE id ='$editid'";
        $result = $this->conn->query($sql);
        if($result->num_rows==1){
            $row = $result->fetch_assoc();
            return $row;
        }
    }
}


?>
