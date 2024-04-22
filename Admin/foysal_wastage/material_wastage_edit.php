<?php
require_once("../header.php");

$data=$con->query("select * from  raw_materials");

$mn=$con->query('select * from material_wastage where id='.$_GET['id'])->fetch_assoc();

?>
<script>
       function fj() {
        let name = (document.querySelector('#name').value).trim();
        let quantity = (document.querySelector('#quantity').value).trim();
        let date = (document.querySelector('#date').value).trim();


        if (name == '' || quantity == '' || date == '') {
            if (name == '') {
                document.querySelector('#name').style.border = '1px solid red';
                document.querySelector('#name_error').innerHTML = 'material Required';

            } else {
                document.querySelector('#name').style.border = '1px solid green';
                document.querySelector('#name_error').innerHTML = '';

            }
            if (quantity == '') {
                document.querySelector('#quantity').style.border ='1px solid red';
                document.querySelector('#quantity_error').innerHTML = 'Quantity Required';
            } else {
                document.querySelector('#quantity').style.border = '1px solid green';
                document.querySelector('#quantity_error').innerHTML = ''
            }
            if (date == '') {
                document.querySelector('#date').style.border = '1px solid red';
                document.querySelector('#date_error').innerHTML = 'Date Required';
            } else {
                document.querySelector('#date').style.border = '1px solid green';
                document.querySelector('#date_error').innerHTML = '';
            }
            return false;
        } else {
            return true;
            document.querySelector('#name').style.border = 'green';
            document.querySelector('#name_error').innerHTML = '';

            document.querySelector('#quantity').style.border= 'green';
            document.querySelector('#quantity_error').innerHTML = '';

            document.querySelector('#date').style.border = 'green';
            document.querySelector('#date_error').innerHTML = '';

        }
    }

</script>


<?php
if (isset($_POST['material_id'])) {
    $material_id= $_POST['material_id'];
    $quantity=$_POST['quantity'];
    $Date= $_POST['date'];

    $mw=$con->query("update material_wastage set material_id='$material_id', quantity='$quantity', date='$Date' where id=".$_GET['id'])
?>
<script>
    window.location.assign('material_wastage_list.php')
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
                    <h1>material_wastage</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">material_wastage</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">material_wastage</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return fj()">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">material_id</label>
                                        <select name="material_id" id="name" class="form-control">
                                        
                                        <option value=""> select materials</option>
                                        <?php while ($raw=$data->fetch_assoc()) {?>
                                        <option value="<?php echo $raw['id']?>" <?php if($raw['id']==$mn['material_id']){echo "selected";}?>> 
                                            <?php echo $raw['name'] ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                    <span style="color: red;" id="name_error">*</span>
                                    </div>
                                <div class="form-group">
                                        <label for="exampleInputEmail1">quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity" value="<?php echo $mn['quantity'] ?>"> <span style="color: red;" id="quantity_error">*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="date" name="date" class="form-control" id="date" placeholder="Enter title" value="<?php echo $mn['date'] ?>"> <span style="color: red;" id="date_error">*</span>
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