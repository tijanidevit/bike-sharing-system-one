<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/bikes.class.php';
include_once '../core/core.function.php';
$bike_obj = new Bikes();
$bikes = $bike_obj->fetch_bikes();

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
                                <h4 class="mb-1 mt-0">Bikes</h4>
                            </div>
                        </div>

                        <!-- content -->
                        <!-- stats + charts -->
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary btn-sm float-right">
                                            <i class='uil uil-export ml-1'></i> Bikes
                                        </a>
                                        <h5 class="card-title mt-0 mb-0">Bikes</h5>

                                        <div class="table-responsive mt-4">
                                            <table id="datatable-buttons" class="table table-hover table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Bike Name</th>
                                                        <th>Image</th>
                                                        <th>Price per Minute</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($bikes as $bike): ?>
                                                        <tr>
                                                            <td><?php echo $bike['name'] ?></td>
                                                            <td><img height="80" src="<?php echo $bike['image'] ?>"></td>
                                                            <td><?php echo $bike['price_per_minute'] ?></td>
                                                            <td><?php echo substr($bike['description'], 0,80) ?></td>
                                                            <td>
                                                                <?php if ($bike['status']): ?>
                                                                    <span class="text-success">Available</span>
                                                                <?php else: ?>
                                                                    <span class="text-warning">Not available</span>
                                                                <?php endif ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
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