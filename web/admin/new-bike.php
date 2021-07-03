<?php 
session_start();
if (!isset($_SESSION['bike_admin'])) {
    header('location: ./');
    exit();
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
                            <h4 class="mb-1 mt-0">Add New Bike</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">New Bike</h4>
                                    <p class="sub-header">
                                        Enter new Bike details
                                    </p>

                                    <form class="form-horizontal" enctype="multipart/form-data" id="bikeForm">
                                        <div id="result"></div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label" for="bike">Bike name</label>
                                                <div class="">
                                                    <input autofocus type="text" placeholder="bike name" required class="form-control" name="name" id="bike_name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label" for="bike">Price per minute</label>
                                                <div class="">
                                                    <input type="text" placeholder="Price per minute" required class="form-control" name="price_per_minute" id="price_per_minute">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label" for="bike">Bike Image</label>
                                                <div class="">
                                                    <input accept="image/*" type="file" placeholder="bike image" required class="form-control" name="image" id="bike_image">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label" for="bike">Description</label>
                                                <div class="">
                                                    <textarea rows="5" style="resize: none;" placeholder="Description" required class="form-control" name="description" id="description"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block">
                                                    <span class="spinner" style="display: none;">
                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                    </span>
                                                    <span class="btnText">
                                                        Submit
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

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
            url:'ajax/add_bike.php',
            type: 'POST',
            data :  new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.spinner').show();
                $('.btnText').hide();
            },
            success: function(data){

                $('.spinner').hide();
                $('.btnText').show();

                if (data.includes('successful')) {
                    $('input').val('');
                    $('textarea').val('');
                    $('#bike_name').attr('autofocus','true');
                }
                
                $('#result').html(data);
                $('#result').fadeIn();
                $('.spinner').hide();
                
            }
        })
    });
</script>