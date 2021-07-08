<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/bookings.class.php';
include_once '../core/bikes.class.php';
include_once '../core/core.function.php';
$booking_obj = new Bookings();
$bike_obj = new Bikes();
$id = $_GET['bc'];
$booking = $booking_obj->fetch_booking($id);
if ($booking) {
	$bike_obj->update_bike_status($status,$booking['bike_id']);
    $booking_obj->change_booking_return_time($id);
}

echo "<script>history.back()</script>";
?>