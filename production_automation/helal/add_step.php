<?php
require_once('../header.php');
$sr = "";
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $si = $_POST['title'];
    if (empty($_POST['title'])) {
        $sr = "pls fill the step";
    } else {
        if ($si != "") {
            $add_project_step = $con->query("INSERT INTO processing_steps(project_id,title)VALUES('$id','$si')");
        ?>
        <script>
        window.location.assign('edit_project.php?id=<?php echo $id ?>');
    </script>
        
       <?php } 
    
    }
    ?>
    

<?php } ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ADD MORE STEP</h3>
                        </div>
                        <!-- /.card-header --><!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Step Name">
                                    <span style="color:red">
                                        <?php echo $sr ?>
                                    </span>
                                </div>

                            </div> <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form><!-- general form elements -->
                    </div> <!-- /.card -->
                </div><!--/.col (right -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
require_once('../footer.php')
    ?>