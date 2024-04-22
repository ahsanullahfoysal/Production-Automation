<?php
require_once("../header.php");
$cate=$con->query("select * from category");
$unit=$con->query("select * from units");
$id=$_GET['id'];
$edit=$con->query("select * from raw_materials where id=$id")->fetch_assoc();
// echo "<pre>";
// print_r($edit);
// exit;
//$con = new mysqli('localhost', 'root', '', 'production_automation');
?>
<script>
    const validation=()=>{
        let name = document.getElementById('name').value;
        let price = document.getElementById('price').value;
        let cname = document.getElementById('cname').value;
        let uname = document.getElementById('uname').value;
        if(name=="" || price =="" || cname=="" || uname==""){
            if(name==""){
                document.getElementById("name").style.border='1px solid red';
                document.getElementById("name_error").innerHTML='please!Enter Name';
                document.getElementById("name_error").style.color='red';

            }else{
                document.getElementById('name').style.border='1px solid green';
                document.getElementById('name_error').innerHTML='';
            }
            if(price==""){
                document.getElementById("price").style.border='1px solid red';
                document.getElementById("price_error").innerHTML='please!Enter Price';
                document.getElementById("price_error").style.color='red';
             }else{
                document.getElementById('price').style.border='1px solid green';
                document.getElementById('price_error').innerHTML='';
             }
             if(cname==""){
                document.getElementById("cname").style.border='1px solid red';
                document.getElementById("cname_error").innerHTML='please!Enter Category';
                document.getElementById("cname_error").style.color='red';
             }else{
                document.getElementById('cname').style.border='1px solid green';
                document.getElementById('cname_error').innerHTML='';
             }
             if(uname==""){
                document.getElementById("uname").style.border='1px solid red';
                document.getElementById("uname_error").innerHTML='please!Enter Unit';
                document.getElementById("uname_error").style.color='red';
             }else{
                document.getElementById('uname').style.border='1px solid green';
                document.getElementById('uname_error').innerHTML='';
             }
             return false;
        }else{
            document.getElementById('name').style.border='1px solid green';
            document.getElementById(name_error).innerHTML='';
            document.getElementById('price').style.border='1px solid green';
            document.getElementById(price_error).innerHTML='';
            document.getElementById('cname').style.border='1px solid green';
            document.getElementById(cname_error).innerHTML='';
            document.getElementById('uname').style.border='1px solid green';
            document.getElementById(uname_error).innerHTML='';
            return true;
        }

    }

</script>
<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $unit=$_POST['unit'];
    $category=$_POST['category'];
    $raw = $con->query("update raw_materials set name='$name',price='$price',unit_id='$unit',category_id='$category' where id=$id ");
    ?>
    <script>
        window.location.assign('raw_list.php')
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
                    <h1>Raw Materials</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Raw Materials</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="raw_list.php" class="btn btn-primary btn-md">Add Raw List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $edit['name'] ?>"><span id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="Enter Name" value="<?php echo $edit['price'] ?>"><span id="price_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Unit</label>
                                        <select name="unit" id="uname" class="form-control">
                                            <option value="">select Unit</option>
                                            <?php while($c=$unit->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>"<?php if($c['id']==$edit['unit_id']) {echo "selected";}?>><?php echo $c['name'] ?></option>
                                            <?php }?>
                                        </select><span id="uname_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                        <select name="category" id="cname" class="form-control">
                                            <option value="">select Category</option>
                                            <?php while($c=$cate->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>"<?php if($c['id'] == $edit['category_id']) {echo "selected";}?>><?php echo $c['name'] ?></option>
                                            <?php }?>
                                        </select><span id="cname_error"></span>
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