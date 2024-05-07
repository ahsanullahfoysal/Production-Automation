<?php 
  require_once('../header.php');
  $id=$_GET['id'];
  $p_name=$con->query('SELECT processing_steps.*,projects.name,projects.details FROM `processing_steps` INNER JOIN projects ON projects.id=processing_steps.project_id WHERE project_id='.$id)->fetch_assoc();
  $project=$con->query('select * from projects where id='.$id)->fetch_all(MYSQLI_ASSOC);
  $projecta=$con->query('select * from projects where id='.$id)->fetch_assoc();
  $prossesing_step=$con->query('select * from processing_steps where project_id='.$id)->fetch_all(MYSQLI_ASSOC);



  
   ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Production Step Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header"> <h3 class="card-title">Project Step Details</h3></div>
        <table class="table table-bordered col-md-10 table-striped table-sucess">
             <h2 style="text-align:center; color:blue"><span style="text-align:center; color:black">Project Name :</span> <?php echo $projecta['name'] ?> </h2>
             <h2 style="text-align:center; color:blue"><span style="text-align:center; color:black">Project Details :</span> <?php echo $projecta['details'] ?> </h2>
        <thead>
            <tr> <th style="width: 10px">SL</th>
                    <th>Prossesing Steps</th>
                   <th>Total Item</th>
                   <th>Complete Item</th>
                   <th>Due Item</th>
                    <th style="width: 200px">Action</th>
                </tr>
            </thead>
            <tbody>
               <tr>
                    
                    <?php 
                    $sr="";
                    if(count($prossesing_step)>0){
                    foreach($prossesing_step as $ui=>$ul){ ?>
                    
                    <td> <?php echo ++$ui ?></td>
                    <td><h4> <?php echo $ul['title']  ?> <?php $id_s=$ul['id']?></h3></td>
                   
                    <td>
                    <?php $count_total=$con->query('SELECT * FROM `transfers` WHERE processing_steps_id='.$id_s)->fetch_all(); 
                    echo count($count_total); ?>
                   </td>

                   <td>
                    <?php $count_transper=$con->query('SELECT * FROM `transfers` WHERE  transfer_date!="" and processing_steps_id='.$id_s)->fetch_all(); 
                    echo count($count_transper); ?>
                   </td>

                   <td>
                    <?php $count_due=$con->query('SELECT * FROM `transfers` WHERE  transfer_date="" and processing_steps_id='.$id_s)->fetch_all(); 
                    echo count($count_due); ?>
                   </td>

                   
                    <td> 
                                        <!-- <a href="edit_prossesing_step.php?id=<?php echo $ul['id'] ?>" class="btn btn-success">Update</a> -->
                                        
                                        <a href="details_step.php?id=<?php echo $ul['id'] ?>" class="btn btn-info" >Details</a>

                                        <!-- <a href="delete_prossesing_step.php?id=<?php echo $ul['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure!')">Delete</a> -->
                                    </td>
                </tr>
                 <?php } }else{
                  $r='No step available';
?>
                  <h3 style="color:red"> <?php echo  $r ?></h3>
                  <a href="edit_project.php?id=<?php echo $id ?>" class="btn btn-success btn-sm" style="width: 200px" >Add step</a>  

                <?php }
                 ?>
            </tbody>
        </table>
      </div>
      <!-- /.card -->
      <!-- <div class="container" style="background-image: url('tailoring-processs.jpg'); background-size: cover;width: 800px;height: 300px; " > </div> -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
<?php 
  require_once('../footer.php')
   ?>