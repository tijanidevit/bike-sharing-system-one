<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/bookings.class.php';
include_once '../core/core.function.php';
$booking_obj = new bookings();
$bookings = $booking_obj->fetch_bookings();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
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
                            <h4 class="mb-1 mt-0">Bookings</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <!-- stats + charts -->
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary btn-sm float-right">
                                        <i class='uil uil-export ml-1'></i> Bookings
                                    </a>
                                    <h5 class="card-title mt-0 mb-0">Bookings</h5>

                                    <div class="table-responsive mt-4">
                                        <table id="datatable-buttons" class="table table-hover table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Bike</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Users' Phone</th>
                                                    <th scope="col">Price Per Minute</th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Booking Date</th>
                                                    <th scope="col">Start Time</th>
                                                    <th scope="col">Return Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1; foreach ($bookings as $booking): ?>
                                                <tr>
                                                    <td>#<?php echo $sn ?></td>
                                                    <td><?php echo $booking['name'] ?></td>
                                                    <td><?php echo $booking['fullname'] ?></td>
                                                    <td><?php echo $booking['phone'] ?></td>
                                                    <td><?php echo $booking['price_per_minute'] ?></td>
                                                    <td><?php echo $booking['code'] ?> </td>
                                                    <td><?php echo format_date($booking['created_at']) ?></td>
                                                    <td>
                                                        <?php if (format_date($booking['start_time']) != "") : ?>
                                                            <?php echo format_date($booking['start_time']) ?>
                                                        <?php else: ?>
                                                            <a href="start_trip?bc=<?php echo $booking['id'] ?>">Start Trip</a>
                                                        <?php endif ?>  
                                                    </td>
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
                                                <?php $sn++; endforeach ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                    </div>
                    <!-- row -->

                </div>
            </div> <!-- content -->

            

            <!-- Footer Start -->
            <?php include_once 'components/footer.php'; ?>
            <!-- end Footer -->

        </div>

    </div>
    <!-- END wrapper -->


    <!-- datatable js -->
    <!-- Right bar overlay-->
    <?php include_once 'components/scripts.php'; ?>


    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    
    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>

    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.select.min.js"></script>

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

</body>
</html>     