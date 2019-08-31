<?php
global $wpdb;
$table_name = $wpdb->prefix . 'cybersekyu';
$current_page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$uri_parts = explode('?', $current_page, 2);
$current_page = $uri_parts[0].'?page=CyberSekyu-Options&subpage=';

?>
<div class="wrap">
<h2>CyberSekyu</h2>
by <a href="http://jsnbrn.com">Jason Bruno</a>
<br><hr>
<h2>What to do?</h2>
<h3><a href="<?php echo $current_page.'list'; ?>">List and Check All Users</a></h3>
<h3><a href="<?php echo $current_page.'check'; ?>">Check Hash Manually</a></h3>
<h3><a href="<?php echo $current_page.'create'; ?>">Create Hash</a></h3>
<h3><a href="<?php echo $current_page.'strength'; ?>">Check Password</a></h3>

<br><hr><br>
<?php
if(isset($_GET['subpage']) && $_GET['subpage']=='list'){
?>
<div>
<h2>Listing all users</h2>
<?php
// $users = get_users( array( 'fields' => array( 'ID' ) ) );
// // var_dump($users);
// foreach($users as $user_id){
//         var_dump(get_user_meta ( $user_id->ID));
//         $user = get_user_meta ( $user_id->ID);
//         echo $user['nickname'][0].'<br>';
//     }

  $sql = "SELECT * FROM `".$wpdb->prefix . 'users'."`";
  $result = $wpdb->get_results($sql);
  echo '<h3>Number of users: '.count($result).'</h3>';
  foreach($result as $item) {
    echo $item->user_login;
    echo ' | '.checkP($item->user_pass);
    echo '<br>';
  }


?>
</div>
<?php
}
?>

<?php
if(isset($_GET['subpage']) && $_GET['subpage']=='check'){
?>

<div>
<h2>Check hash</h2>
<form action="" method="get">
<input type="text" name="search"><br>
<input type="hidden" name="page" value="CyberSekyu-Options">
<input type="hidden" name="subpage" value="check">
<input type="submit" value="Search">
</form>
<?php
if(isset($_GET['search'])){
echo checkP($_GET['search']);
}

?>
<div>
<?php
}
if(isset($_GET['subpage']) && $_GET['subpage']=='create'){
?>
<div>
<h2>Make hash</h2>
<form action="" method="get">
<input type="text" name="make"><br>
<input type="hidden" name="page" value="CyberSekyu-Options">
<input type="hidden" name="subpage" value="create">
<input type="submit" value="Search">
</form>
<?php
if(isset($_GET['make'])){
$hashedPassword = wp_hash_password($_GET['make']);
echo '<h3>'.$hashedPassword.'</h3>';
}
?>
</div>
<?php
}
if(isset($_GET['subpage']) && $_GET['subpage']=='strength'){

wp_enqueue_script( 'password-strength-meter' );
?>
<div>
<h2>Check Password</h2>
<input type="text" name="pw">
<span id="password-strength"></span>
<input type="submit" style="display: none">
</div>
<script>

jQuery( document ).ready( function( $ ) {
// trigger the wdmChkPwdStrength
$( 'body' ).on( 'keyup', 'input[name=pw], input[name=pw]', function( event ) {
    wdmChkPwdStrength(
        // password field
        $('input[name=pw]'),
        // confirm password field
        $('input[name=pw]'),
        // strength status
        $('#password-strength'),
       // Submit button
       $('input[type=submit]'),
       // blacklisted words which should not be a part of the password
       ['admin', 'happy', 'hello', '1234']
    );
  });
});



function wdmChkPwdStrength( $pwd,  $confirmPwd, $strengthStatus, $submitBtn, blacklistedWords ) {
    var pwd = $pwd.val();
    var confirmPwd = $confirmPwd.val();

    // extend the blacklisted words array with those from the site data
    blacklistedWords = blacklistedWords.concat( wp.passwordStrength.userInputBlacklist() )

    // every time a letter is typed, reset the submit button and the strength meter status
    // disable the submit button
    $submitBtn.attr( 'disabled', 'disabled' );
    $strengthStatus.removeClass( 'short bad good strong' );

    // calculate the password strength
    var pwdStrength = wp.passwordStrength.meter( pwd, blacklistedWords, confirmPwd );

// check the password strength
switch ( pwdStrength ) {

    case 2:
    $strengthStatus.addClass( 'bad' ).html( pwsL10n.bad );
    break;

    case 3:
    $strengthStatus.addClass( 'good' ).html( pwsL10n.good );
    break;

    case 4:
    $strengthStatus.addClass( 'strong' ).html( pwsL10n.strong );
    break;

    case 5:
    $strengthStatus.addClass( 'short' ).html( pwsL10n.mismatch );
    break;

    default:
    $strengthStatus.addClass( 'short' ).html( pwsL10n.short );

}
// set the status of the submit button
}




</script>


<?php
}


function checkP($p){
global $wpdb;
$table_name = $wpdb->prefix . 'cybersekyu';

require_once( ABSPATH . 'wp-includes/class-phpass.php' );
$wp_hasher = new PasswordHash(8, TRUE);

  $sql = "SELECT * FROM `$table_name`";
  $result = $wpdb->get_results($sql);
  $good=true;
  foreach($result as $item) {
    if($wp_hasher->CheckPassword($item->password, $p)) {
        $good = false;
        return '<div style="color:#8B0000;">Password found in database: '.$item->password.'</div>';
      }
    }
  if($good) return '<div class="color:#008000;">Password not found.</div>';
}

?>


