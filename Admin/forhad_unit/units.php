<?php
require_once("../header.php");
// $con = new mysqli('localhost', 'root', '', 'production_automation');
$name=$con->query("select * from units");

?>
    <script>
        function validate(){
            let name=(document.querySelector(".name").value).trim();
            if(name==''){
                document.querySelector(".name").style.border='1px solid red';
                document.querySelector(".nameError").innerHTML='Required Name';
                return false;
            }else{
                return true;
                document.querySelector(".name").style.border='1px solid green';
                document.querySelector(".nameError").innerHTML='';
            }
          
        }


    </script>


 <?php
    
if(isset($_POST['submit'])){ 
    $name=$_POST['name'];
    
    $con->query("INSERT INTO units(name) VALUES ('$name')");
  
    ?>

    <script>
        window.location.assign('unit_list.php');
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
                    <h1>Units</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Units</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="unit_list.php" class="btn btn-primary btn-md">Units</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control name" id="exampleInputEmail1" placeholder="Enter Name" > <span class="nameError"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
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