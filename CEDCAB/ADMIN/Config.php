<?php
/**
 * Template File Doc Comment
 * 
 * PHP version 7
 * 
 * @category Template_Class
 * @package  Template_Class
 * @author   Author <author@domain.com>
 * @license  https://opensource.org/license/MIT MIT License
 * @link     https://localhost/ 
 */
class Config {
    public $srever_name;
    public $user_name;
    public $password;
    public $dbname ; 

    public function __construct() {
        $this->srever_name = "localhost" ;
        $this->user_name = "root" ;
        $this->password = "";
        $this->dbname = "cabbooking";
    }
    public function Connect() {
        $this->conn = new mysqli($this->srever_name, $this->user_name, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failled " . $this->conn->connect_error);
        } else {
            return $this->conn;
        }
    }
}

?>
