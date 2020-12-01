<?php
/**
 * Template File Doc Comment
 *
 *  PHP version 7
 * 
 * @category Template_Class
 * @package  Template_Class
 * @author   Author <author@domain.com>
 * @license  https://opensource.org/licenses/MIT MIT license
 * @link     http://localhost/
 */
?>
<?php
$dbhost="localhost";
$dbuser='root';
$dbpass='';
$dbname='cabbooking';

//create connection
$conn=new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//check connection
if ($conn->connect_error) {
    die("connection failed:".$conn->connect_error);
} else {
    //echo "connection successful";
}