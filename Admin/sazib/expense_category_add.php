<?php
require_once("../header.php");
?>
<script>
    function fn(){
        let name= document.getElementById('name').value;
        if(name==''){
            if(name==''){
                    document.getElementById('name')
                    document.getElementById('name').style.border='1px solid red';
                    document.getElementById('name_error').innerHTML='Please input category name';
                    document.getElementById('name_error').style.color='red';
                }else{
                    document.getElementById('name').style.border='1px solid green';
                    document.getElementById('name_error').innerHTML=' ';
                }
                return false;
            } else{
                    document.getElementById("name").style.border = '1px solid green';
                    document.getElementById("name_error").innerHTML = '';
                    return true;
            }
        }
            
        
    
</script>

<?php
//$con = new mysqli('localhost', 'root', '', 'production_automation');
if(isset($_POST['submit'])){
    $name=trim($_POST['name']);
    $con->query("INSERT INTO `expense_category`( `name`) VALUES ('$name')")
    ?>
    <script>
        window.location.assign('expense_category_list.php')
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
                    <h1>Expense Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense Category Add</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Expense Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return fn()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                                    </div>
                                    <span id="name_error"></span>
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