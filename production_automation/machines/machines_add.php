<?php
require_once("../header.php");
?>

<?php
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $model = trim($_POST['model']);
    $con->query("INSERT INTO machines (name, type, model) VALUES('$name', '$type', '$model')");
    ?>

    <script>
        window.location.assign('machines_list.php')
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
                    <h1>Add Machine</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Machine</li>
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
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Enter Machine name"><span id="name_error"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" name="type" class="form-control" id="type"
                                            placeholder="Enter Machine type"><span id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" name="model" class="form-control" id="model"
                                            placeholder="Enter Machine model"><span id="model_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                
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
                name: "required",
                type: "required",
                model: "required"
            },
            messages: {

            }
        })
    })
</script>