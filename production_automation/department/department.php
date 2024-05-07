<?php
require_once("../header.php");
?>
<script>
    function validate() {
        let department = document.getElementById('dipt').value.trim();
        if (department == '') {
                document.getElementById('dipt').style.border = '1px solid red';
                document.getElementById('d_Error').innerHTML='Please Select a Buyer';
                return false;
            } else {
                return true;
                document.getElementById('dipt').style.border ='1px solid green';
                document.getElementById('d_Error').innerHTML='';
            }
          
        } 
</script>

<?php

//require_once('../database_con.php');
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    
    $con->query("INSERT INTO `departments`( `name`) VALUES ('$name')");
    ?>
    <script>
        window.location.assign('department_list.php');
    </script>
<?php
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Department</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="department_list.php" class="btn btn-primary btn-md">Add Department List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="dipt" placeholder="Enter Name"><span id="d_Error"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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