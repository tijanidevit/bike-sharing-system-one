<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/users.class.php';
include_once '../core/core.function.php';
$user_obj = new users();
$users = $user_obj->fetch_users();

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
                            <h4 class="mb-1 mt-0">users</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <!-- stats + charts -->
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary btn-sm float-right">
                                        <i class='uil uil-export ml-1'></i> Users
                                    </a>
                                    <h5 class="card-title mt-0 mb-0">Users</h5>

                                    <div class="table-responsive mt-4">
                                        <table id="datatable-buttons" class="table table-hover table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Matric Number</th>
                                                    <th scope="col">Total Bookings</th>
                                                    <th scope="col">Joined Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sn = 1; foreach ($users as $user): ?>
                                                <tr>
                                                    <td>#<?php echo $sn ?></td>
                                                    <td><?php echo $user['fullname'] ?></td>
                                                    <td><?php echo $user['phone'] ?></td>
                                                    <td><?php echo $user['matric_number'] ?></td>
                                                    <td><?php echo $user_obj->user_bookings_num($user['id']) ?> </td>
                                                    <td><?php echo format_date($user['created_at']) ?></td>
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