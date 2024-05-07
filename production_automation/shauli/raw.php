<?php
require_once("../header.php");
$cate=$con->query("select * from category");
$unit=$con->query("select * from units");
//require_once('../database_con.php');
?>
<script>
    $(document).ready(function(){
        $('#raw').validate({
            rules:{
                name:"required",
                price:"required",
                category:"required",
                unit:"required"
            },
            messages:{
                name:"Please select Name",
                price:"Please select Price",
                category:"Please select category",
                unit:"Please select an unit"
            }
        })
    })

</script>
<?php
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $price=trim($_POST['price']);
    $unit=trim($_POST['unit']);
    $category=trim($_POST['category']); 

  $con->query("insert into raw_materials(name,price,unit_id,category_id)values('$name','$price','$unit','$category')");
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
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="raw_list.php" class="btn btn-primary btn-md">Add Raw materials</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" id="raw" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"><span id="name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="Enter Name"><span id="price_error"></span>
                                    </div>
                                </div>



                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category" id="cname" class="form-control">
                                            <option value="">select Category</option>
                                            <?php while($c=$cate->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                                            <?php }?>
                                        </select><span id="cname_error"></span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Unit</label>
                                        <select name="unit" id="uname" class="form-control">
                                            <option value="">select Unit</option>
                                            <?php while($c=$unit->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?></option>
                                            <?php }?>
                                        </select><span id="uname_error"></span>
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