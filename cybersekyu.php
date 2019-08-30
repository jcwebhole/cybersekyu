<?php
/*
Plugin Name: CyberSekyu
Plugin URI: http://jsnbrn.com
Description: Password Checker
Author: Jason Bruno
Version: 1.0
Author URI: https://fb.com/jcbruno
*/

function cybersekyu_menu()
{
    include 'cybersekyu-admin.php';
}
 
function cybersekyu_admin_actions()
{
    add_management_page("CyberSekyu", "CyberSekyu Options", 1,
"CyberSekyu-Options", "cybersekyu_menu");
}
 
add_action('admin_menu', 'cybersekyu_admin_actions');



function cybersekyu_install() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'cybersekyu';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE `$table_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
//echo $sql;
}

function cybersekyu_install_data() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'cybersekyu';

$sql="INSERT INTO `".$table_name."` (`id`, `password`) VALUES
(1, '123456'),
(2, '12345'),
(3, '123456789'),
(4, 'password'),
(5, 'iloveyou'),
(6, 'princess'),
(7, '1234567'),
(8, 'rockyou'),
(9, '12345678'),
(10, 'abc123'),
(11, 'nicole'),
(12, 'daniel'),
(13, 'babygirl'),
(14, 'monkey'),
(15, 'lovely'),
(16, 'jessica'),
(17, '654321'),
(18, 'michael'),
(19, 'ashley'),
(20, 'qwerty'),
(21, '111111'),
(22, 'iloveu'),
(23, '000000'),
(24, 'michelle'),
(25, 'tigger'),
(26, 'sunshine'),
(27, 'chocolate'),
(28, 'password1'),
(29, 'soccer'),
(30, 'anthony'),
(31, 'friends'),
(32, 'butterfly'),
(33, 'purple'),
(34, 'angel'),
(35, 'jordan'),
(36, 'liverpool'),
(37, 'justin'),
(38, 'loveme'),
(39, 'fuckyou'),
(40, '123123'),
(41, 'football'),
(42, 'secret'),
(43, 'andrea'),
(44, 'carlos'),
(45, 'jennifer'),
(46, 'joshua'),
(47, 'bubbles'),
(48, '1234567890'),
(49, 'superman'),
(50, 'hannah'),
(51, 'amanda'),
(52, 'loveyou'),
(53, 'pretty'),
(54, 'basketball'),
(55, 'andrew'),
(56, 'angels'),
(57, 'tweety'),
(58, 'flower'),
(59, 'playboy'),
(60, 'hello'),
(61, 'elizabeth'),
(62, 'hottie'),
(63, 'tinkerbell'),
(64, 'charlie'),
(65, 'samantha'),
(66, 'barbie'),
(67, 'chelsea'),
(68, 'lovers'),
(69, 'teamo'),
(70, 'jasmine'),
(71, 'brandon'),
(72, '666666'),
(73, 'shadow'),
(74, 'melissa'),
(75, 'eminem'),
(76, 'matthew'),
(77, 'robert'),
(78, 'danielle'),
(79, 'forever'),
(80, 'family'),
(81, 'jonathan'),
(82, '987654321'),
(83, 'computer'),
(84, 'whatever'),
(85, 'dragon'),
(86, 'vanessa'),
(87, 'cookie'),
(88, 'naruto'),
(89, 'summer'),
(90, 'sweety'),
(91, 'spongebob'),
(92, 'joseph'),
(93, 'junior'),
(94, 'softball'),
(95, 'taylor'),
(96, 'yellow'),
(97, 'daniela'),
(98, 'lauren'),
(99, 'mickey'),
(100, 'princesa');
    ";

   // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

$wpdb->query($sql);
//    echo $sql;
//$wpdb->query($wpdb->prepare ($sql));
}


register_activation_hook( __FILE__, 'cybersekyu_install' );
register_activation_hook( __FILE__, 'cybersekyu_install_data' );




function cybersekyu_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cybersekyu';
     $sql = "DROP TABLE IF EXISTS $table_name;";
     $wpdb->query($sql);
}    
register_deactivation_hook( __FILE__, 'cybersekyu_uninstall' );
?>