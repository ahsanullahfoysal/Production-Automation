<?php
require_once('../header.php');
$id=$_GET['id'];

$step_data=$con->query("select * from processing_steps where project_id=".$id)->fetch_all(MYSQLI_ASSOC);
// $step_data_id=['id'];
$data=$con->query("select * from projects where id=$id")->fetch_assoc();


$valid_ = "";
$valid_a = "";
$valid_b = "";
$valid_c = "";
if(isset($_POST['submit'])){
  $name = trim( $_POST['name']);
  $details = trim($_POST['details']);
  $p_step = trim($_POST['prossesing_steps']);
  if(empty($name) ||empty($details) || empty($p_step) ){
    if (empty($p_step)) {
      $valid_ = "pls fill up step@ ";
    } 
    if (empty($name)) {
      $valid_a = "pls fill up name@ ";
    } 
    if (empty($details)) {
      $valid_b = "pls fill up detail@ ";
    } }else{
    if(!empty($_POST['title'])){
      // $valid_c = "pls fill up ss ";
$add_project=$con->query("update projects set name='$name', details='$details', prossesing_steps='$p_step' where id=$id");
$con->query("delete from processing_steps where project_id=$id");

$step_title = $_POST['title'];
      if ($step_title != "") {
        foreach ($step_title as $i => $si) {
         if(!empty($step_title[$i])){
          $con->query("INSERT INTO processing_steps(project_id,title)VALUES('$id','$si')"); 
        ?>

<script>
  window.location.assign('project_manage.php');
</script>

<?php }
}
} ?>

<script>
  window.location.assign('project_manage.php');
</script>

<?php 
}
}
}?>


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
              <h3 class="card-title">Quick Example</h3></div>
              <!-- /.card-header --><!-- form start -->
            <form action="" method="post">
              <div class="card-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter project Name" value="<?php echo $data['name'] ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">details</label>
                  <input type="text" name="details" class="form-control" id="exampleInputPassword1" placeholder="Enter project Details" value="<?php echo $data['details'] ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Prossesing Steps</label>
                  <input type="number" name="prossesing_steps" class="form-control" id="exampleInputPassword1" placeholder="Enter Prossesing Steps" value="<?php echo count($step_data) ?>" onkeyup="add(this.value)" >
                </div>
                <span id="step"> </span>
                            
                <?php foreach($step_data as $si=>$sl){ ?>
                              <div class="col-sm-6" >
                              <div class="form-group" >
                                <label for="exampleInputPassword1"><?php echo 'Steps:'.++ $si ?> </label>
                                <input type="text" name="title[]" class="form-control" id="exampleInputPassword1" placeholder="Enter Prossesing name" value="<?php echo $sl['title'] ?>">
                                
                              </div>
                          </div>
                          <?php }?>
                                <a href="add_step.php?id=<?php echo $id ?>" class="btn btn-success " >ADD More Step</a> 

            </div> <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
              </div>
            </form><!-- general form elements --></div> <!-- /.card --></div><!--/.col (right --></div><!-- /.row --></div><!-- /.container-fluid -->
  </section><!-- /.content --></div><!-- /.content-wrapper -->

<?php
require_once('../footer.php')
  ?>
