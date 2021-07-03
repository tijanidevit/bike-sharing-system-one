<?php 
session_start();
if (!isset($_SESSION['pes_admin'])) {
    header('location: ./');
    exit();
}

include_once '../core/settings.class.php';
$setting_obj = new Settings();
$about = $setting_obj->fetch_about();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" />
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
                            <h4 class="mb-1 mt-0">Update About</h4>
                        </div>
                    </div>

                    <!-- content -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Update About</h4>
                                    <p class="sub-header">
                                        Enter about us details
                                    </p>

                                    <form class="form-horizontal" id="aboutForm">
                                        <div id="result"></div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label" for="about">About</label>
                                                <div id="summernote-editor" required class="form-control" name="about">
                                                    <?php echo $about['about_text'] ?>
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

    <script src="assets/libs/summernote/summernote-bs4.min.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/form-editor.init.js"></script>  

</body>
</html>

<script>
    $('#aboutForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url:'ajax/update_about.php',
            type: 'POST',
            data : {
                about_text : $('#summernote-editor').summernote('code')
            },
            cache: false,
            beforeSend: function() {
                $('.spinner').show();
                $('.btnText').hide();
            },
            success: function(data){

                $('.spinner').hide();
                $('.btnText').show();
                
                $('#result').html(data);
                $('#result').fadeIn();
                $('.spinner').hide();
                
            }
        })
    });
</script>