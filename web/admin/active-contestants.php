<?php 
session_start();
if (!isset($_SESSION['pes_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/contestants.class.php';
include_once '../core/matches.class.php';
include_once '../core/core.function.php';
$contestant_obj = new Contestants();
$match_obj = new Matches();
$contestants = $contestant_obj->fetch_contestants(1);

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
                                <h4 class="mb-1 mt-0">Active Contestants</h4>
                            </div>
                        </div>

                        <!-- content -->
                        <!-- stats + charts -->
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary btn-sm float-right">
                                            <i class='uil uil-export ml-1'></i> Contestants
                                        </a>
                                        <h5 class="card-title mt-0 mb-0">Active Contestants</h5>

                                        <div class="table-responsive mt-4">
                                            <table id="datatable-buttons" class="table table-hover table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fullname</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Selected Team</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">State</th>
                                                        <th scope="col">Last Stage Played</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($contestants as $contestant): ?>
                                                    <?php 
                                                        $last_match = $match_obj->fetch_contestant_last_match($contestant['id']); 
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $contestant['fullname'] ?></td>
                                                            <td><img height="50" src="../img/contestants/<?php echo $contestant['image'] ?>"></td>
                                                            <td><?php echo $contestant['nickname'] ?></td>
                                                            <td><?php echo $contestant['phone'] ?></td>
                                                            <td><?php echo $contestant['team_name'] ?></td>
                                                            <td><?php echo $contestant['category'] ?></td>
                                                            <td><?php echo $contestant['state'] ?></td>
                                                            <td><?php echo $last_match['stage'] ?></td>
                                                            <td>
                                                                <a class="btn btn-sm btn-primary" href="disqualify_contestant?c=<?php echo $contestant['id'] ?>">Set as disqualified</a>
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