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
                            <h4 class="mb-1 mt-0">Verify Booking Code</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Verify Booking Code</h4>
                                    <p class="sub-header">
                                        Verify Booking Code details
                                    </p>

                                    <form class="form-horizontal" id="bikeForm">
                                        <div id="result"></div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label" for="bike">Code</label>
                                                <div class="">
                                                    <input autofocus type="text" placeholder="Code" required class="form-control" name="code" id="code">
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
                    location.href = "code-found?code="+$('#code').val();
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