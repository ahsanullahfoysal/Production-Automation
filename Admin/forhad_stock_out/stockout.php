<?php
require_once("../header.php");
$material=$con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$user=$con->query('select * from users')->fetch_all(MYSQLI_ASSOC);
$project=$con->query('select * from projects')->fetch_all(MYSQLI_ASSOC);
//$con = new mysqli('localhost', 'root', '', 'production_automation');
?>
<script>
        function validate(){
            let material_id=(document.querySelector("#material_id").value).trim();
            let quantity=(document.querySelector("#quantity").value).trim();
            let users=(document.querySelector("#users").value).trim();
            let date=(document.querySelector("#date").value).trim();
            let order=(document.querySelector("#order").value).trim();
            if(material_id=='' || quantity== '' || users =='' || date =='' || order ==''){
                if(material_id==''){
                    document.querySelector('#material_id').style.border='1px solid red'
                    document.querySelector('#error1').innerHTML='please select a material name'
                }else{
                    document.querySelector('#material_id').style.border='1px solid green'
                    document.querySelector('#error1').innerHTML=''
                }
                if(quantity==''){
                    document.querySelector('#quantity').style.border='1px solid red'
                    document.querySelector('#error2').innerHTML='please select a material name'
                }else{
                    document.querySelector('#quantity').style.border='1px solid green'
                    document.querySelector('#error2').innerHTML=''
                }
                if(users==''){
                    document.querySelector('#users').style.border='1px solid red'
                    document.querySelector('#error3').innerHTML='please select a material name'
                }else{
                    document.querySelector('#users').style.border='1px solid green'
                    document.querySelector('#error3').innerHTML=''
                }
                if(date==''){
                    document.querySelector('#date').style.border='1px solid red'
                    document.querySelector('#error4').innerHTML='please select a material name'
                }else{
                    document.querySelector('#date').style.border='1px solid green'
                    document.querySelector('#error4').innerHTML=''
                }
                if(order==''){
                    document.querySelector('#order').style.border='1px solid red'
                    document.querySelector('#error5').innerHTML='please select a material name'
                }else{
                    document.querySelector('#order').style.border='1px solid green'
                    document.querySelector('#error5').innerHTML=''
                }
                return false;
            }else{
                return true;
                document.querySelector('#material_id').style.border='1px solid green'
                document.querySelector('#error1').innerHTML=''
                document.querySelector('#quantity').style.border='1px solid green'
                document.querySelector('#error2').innerHTML=''
                document.querySelector('#users').style.border='1px solid green'
                document.querySelector('#error3').innerHTML=''
                document.querySelector('#date').style.border='1px solid green'
                document.querySelector('#error4').innerHTML=''
                document.querySelector('#order').style.border='1px solid green'
                document.querySelector('#error5').innerHTML=''
            }
               
        }


    </script>

<?php
if (isset($_POST['submit'])) {
    $material_id = $_POST['material_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $project_id = $_POST['project_id'];

    $con->query("INSERT INTO `stock_out`(`material_id`, `quantity`, `user_id`, `date`, `project_id`) VALUES ('$material_id','$quantity','$user_id','$date','$project_id')");

?>
    <script>
        window.location.assign('stockout_list.php');
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
                    <h1>Stock Out</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Stock Out List</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="stockout_list.php" class="btn btn-primary btn-md"> Stock Out List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- <div class="row-"> -->

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Material</label>
                                        <select name="material_id" id="material_id" class="form-control">
                                            <option value="">select material</option>
                                            <?php foreach($material as $m){?>
                                            <option value="<?php echo $m['id'] ?>"><?php echo $m['name'] ?></option>
                                                <?php }?>
                                        </select>
                                       <span id="error1"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity">
                                        <span id="error2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Users</label>
                                        <select name="user_id" id="users" class="form-control">
                                            <option value="">select users</option>
                                            <?php foreach($user as $u){?>
                                            <option value="<?php echo $u['id'] ?>"><?php echo $u['name'] ?></option>
                                                <?php }?>
                                        </select>
                                        <span id="error3"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Date</label>
                                    <input type="datetime-local" name="date" id="date" class="form-control">
                                    <span id="error4"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order</label>
                                        <select name="project_id" id="order" class="form-control">
                                            <option value="">select project</option>
                                            <?php foreach($project as $p){?>
                                            <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                                                <?php }?>
                                        </select>
                                        <span id="error5"></span>
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