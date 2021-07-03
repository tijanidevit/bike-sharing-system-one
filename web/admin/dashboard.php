<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/users.class.php';
include_once '../core/bikes.class.php';
include_once '../core/bookings.class.php';
include_once '../core/core.function.php';
$user_obj = new Users();
$bike_obj = new Bikes();
$booking_obj = new Bookings();

$users_num = $user_obj->users_num();
$bikes_num = $bike_obj->bikes_num();
$bookings_num = $booking_obj->bookings_num();

$bikes = $bike_obj->fetch_limited_bikes(10);
$bookings = $booking_obj->fetch_limited_bookings(10);
$users = $user_obj->fetch_limited_users(10);
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
                                <h4 class="mb-1 mt-0">Dashboard</h4>
                            </div>
                        </div>

                        <!-- content -->
                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">
                                                 All users</span>
                                                <h2 class="mb-0"><?php echo $users_num ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-revenue-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-up'></i> 10.21%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">All bikes</span>
                                                <h2 class="mb-0"><?php echo $bikes_num ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-product-sold-chart" class="apex-charts"></div>
                                                <span class="text-danger font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-down'></i> 5.05%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="media p-3">
                                            <div class="media-body">
                                                <span class="text-muted text-uppercase font-size-12 font-weight-bold">All Bookings</span>
                                                <h2 class="mb-0"><?php echo $bookings_num ?></h2>
                                            </div>
                                            <div class="align-self-center">
                                                <div id="today-new-customer-chart" class="apex-charts"></div>
                                                <span class="text-success font-weight-bold font-size-13"><i
                                                        class='uil uil-arrow-up'></i> 25.16%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- stats + charts -->
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary btn-sm float-right">
                                            <i class='uil uil-export ml-1'></i> Bookings
                                        </a>
                                        <h5 class="card-title mt-0 mb-0">List of Recent Bookings</h5>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover table-nowrap mb-0">
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
                                                            <td><?php echo format_date($booking['start_time']) ?></td>
                                                            <td><?php echo format_date($booking['start_time']) ?></td>
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

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <?php include_once 'components/scripts.php'; ?>

    </body>
</html>