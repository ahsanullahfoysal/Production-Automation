<?php
require_once("../header.php");
?>

<?php
if (isset($_POST['submit'])) {
    $machine_id = trim($_POST['machine_id']);
    $error_time = trim($_POST['error_time']);
    $error = trim($_POST['error']);
    $note = trim($_POST['note']);
    $con->query("INSERT INTO error_reports (machine_id, error_time, error,note) VALUES('$machine_id', '$error_time', '$error','$note')");
    ?>

    <script>
        window.location.assign('error_report_list.php')
    </script>

<?php }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Machine Error</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Machine Error Report</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Machine</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data"
                        id="frm_valid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="machine_id">Machine Id</label>
                                        <input type="number" name="machine_id" class="form-control" id="machine_id"
                                            placeholder="Enter Machine machine_id"><span id="machine_id_error"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="error_time">Error Time</label>
                                        <input type="datetime-local" name="error_time" class="form-control"
                                            id="error_time" placeholder="Enter Machine error_time"><span
                                            id="error_time_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="error">Error</label>
                                        <input type="text" name="error" class="form-control" id="error"
                                            placeholder="Enter Machine error"><span id="error_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <textarea type="text" name="note" class="form-control" id="note"
                                            placeholder="Enter Machine note" value=""></textarea><span id="note_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card-footer">
                                        <label for="model"></label>
                                        <button type="submit" name="submit"
                                            class="btn btn-success btn-block">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>
<script>
   $(document).ready(function () {
        $('#frm_valid').validate({
            rules: {
                machine_id: "required",
                error_time: "required",
                error: "required",
                note: "required",
            },
            messages: {

            }
        })
    })
</script>