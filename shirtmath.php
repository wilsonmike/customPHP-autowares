<?php
// The shortcode function
function user_info_echo() { 

$users = get_users(array(
    'role' => 'employee'
));
$userwarehouse = get_users(array(
	'role' => 'warehouse'
));

	
echo '<li>' . 'First Name' . ' ' . 'Current Date' . ' | ' . 'Hire Date'  .' Shirt Qty</li>' . PHP_EOL;	
foreach ($users as $user) {

	$first_name = $user->user_firstname;
	$last_name = $user->user_lastname; 	
	$hire_date = get_user_meta($user->ID, 'wpcf-hire-date', true);
	$hire_date = date("m-d", strtotime($hire_date));
	$shirt_quantity = get_user_meta($user->ID, 'wpcf-shirt-quantity', true);
	$current_date = date("m-d");

if($current_date ==$hire_date)
{
	echo '<li>Match ' . $first_name . ' ' . $last_name . ' ' . $current_date . ' | ' . $hire_date . ' ' . $shirt_quantity . '</li>' . PHP_EOL;
	$shirt_quantity_new = $shirt_quantity +1;
	update_user_meta( $user->ID, 'wpcf-shirt-quantity', $shirt_quantity_new );
}else {
	echo '<li>No Match ' . $first_name . ' ' . $last_name . ' ' . $current_date . ' | ' . $hire_date . ' ' . $shirt_quantity . '</li>' . PHP_EOL;
}	
	
	
}
	//warehouse
foreach ($userwarehouse as $userware) {

	$first_name = $userware->user_firstname;
	$last_name = $userware->user_lastname; 	
	$hire_date = get_user_meta($userware->ID, 'wpcf-hire-date', true);
	$hire_date = date("m-d", strtotime($hire_date));
	$shirt_quantity = get_user_meta($userware->ID, 'wpcf-shirt-quantity', true);
	$current_date = date("m-d");

if($current_date ==$hire_date)
{
	echo '<li>Match ' . $first_name . ' ' . $last_name . ' ' . $current_date . ' | ' . $hire_date . ' ' . $shirt_quantity . '</li>' . PHP_EOL;
	$shirt_quantity_new = $shirt_quantity +2;
	update_user_meta( $userware->ID, 'wpcf-shirt-quantity', $shirt_quantity_new );
}else {
	echo '<li>No Match ' . $first_name . ' ' . $last_name . ' ' . $current_date . ' | ' . $hire_date . ' ' . $shirt_quantity . '</li>' . PHP_EOL;
}	
	
	
}

	
}
// Register shortcode
add_shortcode('echo_userinfo', 'user_info_echo'); 

?>