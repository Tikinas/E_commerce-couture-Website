<?php
class DBController
{
    //creat database connection proprities
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'projet';

    //connection proprety
    public $con = null;
    //call constructor
    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->con->connect_error) {
            echo "fail..".$this->con->connect_error;
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    //MYSQL closing connection
    protected function closeConnection(){
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }
}