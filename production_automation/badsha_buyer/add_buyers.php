<?php
require_once("../header.php");
?>


<script>
    const fn = () => {
        let company_name = document.getElementById('company_name').value.trim();
        let email = document.getElementById('email').value.trim();
        let phone = document.getElementById('phone').value.trim();
        let address = document.getElementById('address').value.trim();
        let contract_person = document.getElementById('contract_person').value.trim();
        let bank_info = document.getElementById('bank_info').value.trim();

        if (company_name == '' || email == '' || phone == '' || address == '' || contract_person == '' || bank_info == '') {
            if (company_name == '') {
                document.getElementById('company_name').style.border = '1px solid red'
                document.getElementById('nameError').innerHTML = 'Required Company Name'
            } else {
                document.getElementById('company_name').style.border = '1px solid green'
                document.getElementById('nameError').innerHTML = ''

            }
            if (email == '') {
                document.getElementById('email').style.border = '1px solid red'
                document.getElementById('emailError').innerHTML = 'Required email'
            } else {
                document.getElementById('email').style.border = '1px solid green'
                document.getElementById('emailError').innerHTML = ''
            }

            if (phone == '') {
                document.getElementById('phone').style.border = '1px solid red'
                document.getElementById('phoneError').innerHTML = 'Phone must be 11 digit'
            } else {
                document.getElementById('phone').style.border = '1px solid green'
                document.getElementById('phoneError').innerHTML = ''
            }

            if (address == '') {
                document.getElementById('address').style.border = '1px solid red'
                document.getElementById('addressError').innerHTML = 'Required address'
            } else {
                document.getElementById('address').style.border = '1px solid green'
                document.getElementById('addressError').innerHTML = ''
            }

            if (contract_person == '') {
                document.getElementById('contract_person').style.border = '1px solid red'
                document.getElementById('contactError').innerHTML = 'Required contact'
            } else {
                document.getElementById('contract_person').style.border = '1px solid green'
                document.getElementById('contactError').innerHTML = ''
            }

            if (bank_info == '') {
                document.getElementById('bank_info').style.border = '1px solid red'
                document.getElementById('bankError').innerHTML = 'Required bank'
            } else {
                document.getElementById('bank_info').style.border = '1px solid green'
                document.getElementById('bankError').innerHTML = ''
            }
            return false;
        } else {

            document.getElementById('company_name').style.border = '1px solid green'
            document.getElementById('nameError').innerHTML = ''
            document.getElementById('email').style.border = '1px solid green'
            document.getElementById('emailError').innerHTML = ''
            document.getElementById('phone').style.border = '1px solid green'
            document.getElementById('phoneError').innerHTML = ''
            document.getElementById('address').style.border = '1px solid green'
            document.getElementById('addressError').innerHTML = ''
            document.getElementById('contract_person').style.border = '1px solid green'
            document.getElementById('contactError').innerHTML = ''
            document.getElementById('bank_info').style.border = '1px solid green'
            document.getElementById('bankError').innerHTML = ''

            let emailValid = /[a-z0-9]+@[a-z0-9]+\.[a-z0-9]/;
            let emailResult = emailValid.test(email);
            let c =false;
            let d=false;
            if (emailResult == '') {
                document.getElementById('email').style.border = '1px solid red'
                document.getElementById('emailError').innerHTML = 'Email Must be Contain example@gmail.com'
                c = false;
            } else {
                document.getElementById('email').style.border = '1px solid green'
                document.getElementById('emailError').innerHTML = '';
                c = true;
            }
            let a = phone.length;
            let b = phone.substring(0, 2);
            if (a == '11' && b == '01') {
                document.getElementById('phone').style.border = '1px solid green'
                document.getElementById('phoneError').innerHTML = '';
                d=  true;
            } else {
                document.getElementById('phone').style.border = '1px solid red'
                document.getElementById('phoneError').innerHTML = 'Phone must be 11 digit'
                d= false;
            }
            if(c==true && d==true){
                return true;
            }else{
               return false;
            }
            
        }

    }
</script>
<?php
if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $contract_person = $_POST['contract_person'];
    $bank_info = $_POST['bank_info'];

    $con->query("INSERT INTO `buyers`( `company_name`, `email`, `phone`, `address`, `contract_person`, `bank_info`) VALUES ('$company_name',' $email',' $phone',' $address','$contract_person','$bank_info')");

?>
    <script>
        window.location.assign('buyer_list.php')
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
                    <h1>Add Buyers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buyers</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buyer List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return fn()" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name"><span id="nameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email"><span id="emailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"><span id="phoneError"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address"><span id="addressError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contact Person</label>
                                        <input type="text" name="contract_person" class="form-control" id="contract_person" placeholder="Enter Contact Person"><span id="contactError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bank Information</label>
                                        <input type="text" name="bank_info" class="form-control" id="bank_info" placeholder="Enter Bank Information"><span id="bankError"></span>
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
