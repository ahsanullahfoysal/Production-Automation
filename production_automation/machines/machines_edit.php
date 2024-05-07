<?php
require_once("../header.php");
$id = $_GET['id'];
$edit = $con->query("SELECT * from machines where id = $id")->fetch_assoc();


?>
<script>
    $(document).ready(function () {
        $('#frm_valid').validate({
            rules: {
                name: "required",
                type: "required",
                model: "required",
                error: "required",
                error_time: "required",

            },
            messages: {

            }
        })
    })
</script>
<?php
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $model = trim($_POST['model']);
    $error = trim($_POST['error']);
    $error_time = trim($_POST['error_time']);
    $con->query("UPDATE `machines` SET name='$name',type='$type',model='$model',error='$error',error_time=' $error_time' WHERE id =$id");
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
                    <h1>Machines</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Machines Edit</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buyers</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data"
                        id="frm_valid">
                        <div class="card-body">
                            <?php //foreach($edit as $v){ ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Enter Machine name" value="<?php echo $edit['name'] ?>" ><span id="name_error"></span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" name="type" class="form-control" id="type"
                                            placeholder="Enter Machine type" value="<?php echo $edit['type'] ?>"><span id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" name="model" class="form-control" id="model"
                                            placeholder="Enter Machine model" value="<?php echo $edit['model'] ?>" ><span id="model_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Error </label>
                                        <select name="error" id="error" class="form-control">
                                            <option value="">Select Option </option>
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                        <!-- <span class="text-danger" id="supervisor_error"></span> -->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="error_time">Error Time</label>
                                        <input type="datetime-local" name="error_time" class="form-control" id="error_time"
                                            placeholder="Enter Machine error_time" value="<?php echo $edit['error_time'] ?>" ><span id="error_time_error"></span>
                                    </div>
                                </div>
                            </div>
                            <?php  //} ?>


                        </div>
                        <!-- /.card-body -->
                        <div class="row">
                            <div class="col-6">
                                <div class="card-footer">
                                    <button type="submit" name="submit"
                                        class="btn btn-success btn-block">Submit</button>
                                </div>
                            </div>
                        </div>

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