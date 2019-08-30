<?php
// cybersekyu_install();
// cybersekyu_install_data();
?>
<div class="wrap">
<h2>CyberSekyu</h2>
by <a href="http://jsnbrn.com">Jason Bruno</a>


<div>
<form action="" method="get">
<h2>Check hash</h2>
<input type="text" name="search"><br>
<input type="hidden" name="page" value="CyberSekyu-Options">
<input type="submit" value="Search">
</form>
<?php

// require_once('/wordpress/wp-load.php');
// require_once('cybersekyu-phpass.php');
require_once( ABSPATH . 'wp-includes/class-phpass.php' );


$wp_hasher = new PasswordHash(8, TRUE);
 
// $password_hashed = '$P$B55D6LjfHDkINU5wF.v2BuuzO0/XPk/';
// $plain_password = 'test';
 
// if($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
//     echo "YES, Matched";
// } else {
//     echo "No, Wrong Password";
// }


// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "rockyou";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

if(isset($_GET['search'])){
    global $wpdb;
    $table_name = $wpdb->prefix . 'cybersekyu';
    $sql = "SELECT * FROM `$table_name`";
// WHERE `password` ='".$_GET['search']."'";

// $result = $conn->query($sql);
$result = $wpdb->get_results($sql);
$good=true;
// var_dump($result);
// echo $result[0]->password;
foreach($result as $item) {
    // while($row = $result) {
      if($wp_hasher->CheckPassword($item->password, $_GET['search'])) {
        $good = false;
        echo 'Password found in database: '.$item->password;
      }
    }
if($good) echo 'Password not found.';

}

$search = wp_hash_password($_GET['search']);

?>

<form action="" method="get">
<h2>Make hash</h2>
<input type="text" name="make"><br>
<input type="hidden" name="page" value="CyberSekyu-Options">
<input type="submit" value="Search">
</form>
<?php
if(isset($_GET['make'])){
$hashedPassword = wp_hash_password($_GET['make']);
echo $hashedPassword;
}
?>

</div>

