<?php
class  Employees
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "company";
    public $sql;  //1
    //database connection 
    public function __construct()
    {
        $this->sql = new mysqli($this->servername, $this->username, $this->password, $this->db);
        if (mysqli_connect_error()) {
            trigger_error("failed to connect to mysql :" . mysqli_connect_error());
        } else {
            return $this->sql; // 1 or 0
        }
    }
    //insert customer data into
    public function insertData($POST)
    {
        $name = $this->sql->real_escape_string($_POST['name']);
        $email = $this->sql->real_escape_string($_POST['email']);
        $salary = $this->sql->real_escape_string($_POST['salary']);
        $query = "INSERT INTO customer(name,email,salary) VALUES('$name','$email','$salary')";
        $sql = $this->sql->query($query);
        if ($sql == true) {
            header("Location:index.php?msg1=insert");
        } else {
            echo "Registration failed try again!";
        }
    }
    public function displayData()
    {
        $query = "SELECT *FROM customer";
        $result = $this->sql->query($query); // []
        if ($result->num_rows>0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;  // [rows]
        } else {
            print "no found records";
        }
    }
    public function displyaRecordById($id)
    {
        $query = "SELECT * FROM customer WHERE id = '$id'";
        $result = $this->con->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
        }else{
        echo "Record not found";
        }
    }
    public function updateRecord($postData)
    {
        $name = $this->sql->real_escape_string($_POST['uname']);
        $email = $this->sql->real_escape_string($_POST['uemail']);
        $salary = $this->sql->real_escape_string($_POST['salary']);
        $id = $this->sql->real_escape_string($_POST['id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE customer SET name = '$name', email = '$email', salary = '$salary' WHERE id = '$id'";
            $sql = $this->sql->query($query);
            if ($sql==true) {
                header("Location:index.php?msg2=update");
            }else{
                echo "Registration updated failed try again!";
            }
            }
            
        }
        public function deleteRecord($id)
        {
            $query = "DELETE FROM customer WHERE id = '$id'";
            $sql = $this->sql->query($query);
        if ($sql==true) {
            header("Location:index.php?msg3=delete");
        }else{
            echo "Record does not delete try again";
            }
        }
        public function select_data($id){

        //     $query = "SELECT * FROM customer WHERE id = '$id'";
        //     $result = $this->con->query($query);
        // if ($result->num_rows > 0) {
        //     $row = $result->fetch_assoc();
        //     return $row;
        //     }else{
        //     echo "Record not found";
        //     }

            $query = "SELECT * FROM customer where id='$id'";
            $result = $this->sql->query($query); // []
            if ($result->num_rows>0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;  // [rows][0]
            } else {
                print "no found records";
            }
        }
    
}

?>