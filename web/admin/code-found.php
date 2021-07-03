<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/bookings.class.php';
include_once '../core/core.function.php';
$booking_obj = new bookings();
$booking_code = $_GET['code'];
$booking = $booking_obj->fetch_booking($booking_code);
if (!$booking) {
    $notFound = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'components/head.php'; ?>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php include_once 'components/header.php'; ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php include_once 'components/sidebar.php'; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row page-title align-items-center">
                        <div class="col-sm-4 col-xl-6">
                            <h4 class="mb-1 mt-0">Booking Code Found</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Booking Code  Found</h4>
                                    <p class="sub-header">
                                        Booking Code
                                    </p>

                                    <table class="table table-striped">
                                        <tr>
                                            <th>Bike</th>
                                            <td><?php echo $booking['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>User</th>
                                            <td><?php echo $booking['fullname'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>User's Phone</th>
                                            <td><?php echo $booking['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>User's Matric Number</th>
                                            <td><?php echo $booking['matric_number'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Price Per Minute</th>
                                            <td>&#8358;<?php echo $booking['price_per_minute'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Booking Date</th>
                                            <td><?php echo format_date($booking['created_at']) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Start Time</th>
                                            <td>

                                                <?php if (format_date($booking['start_time']) != "") : ?>
                                                    <?php echo format_date($booking['start_time']) ?>
                                                <?php else: ?>
                                                    <a href="start_trip?bc=<?php echo $booking['id'] ?>">Start Trip</a>
                                                <?php endif ?>                                                    
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Returned Time</th>
                                            <td>

                                                <?php if (format_date($booking['return_time']) != "" && format_date($booking['start_time']) != "") : ?>
                                                    <?php echo format_date($booking['return_time']) ?>
                                                <?php else: ?>
                                                    <?php if (format_date($booking['start_time']) != "") : ?>
                                                        <a href="stop_trip?bc=<?php echo $booking['id'] ?>">Returned Trip</a>
                                                    <?php endif ?> 
                                                <?php endif ?>                                                    
                                            </td>
                                        </tr>
                                    </table>

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div><!-- end col -->
                    </div>
                    <!-- row -->


                </div>
            </div> <!-- content -->



            <!-- Footer Start -->
            <?php include_once 'components/footer.php'; ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->
    <?php include_once 'components/scripts.php'; ?>

</body>
</html>

<script>
    $('#bikeForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url:'ajax/verify_booking_code.php',
            type: 'POST',
            data :  {code: $('#code').val()},
            cache: false,
            beforeSend: function() {
                $('.spinner').show();
                $('.btnText').hide();
            },
            success: function(data){

                $('.spinner').hide();
                $('.btnText').show();

                if (data) {
                    location.href = "code-found";
                }
                else{
                    $('#result').html('<div class="alert alert-warning"> Booking code not found </div>');
                    $('#result').fadeIn();
                }

                console.log(data);
                
            }
        })
    });
</script>