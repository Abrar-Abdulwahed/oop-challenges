<?php
  require_once 'Classes/CRUD.php';
  $crudObj = new CRUD();

if(isset($_POST['btn-del']))
{
   $crudObj->deleteRecordById("tbl_users", 'ID', $_GET['delete_id']);
   header("Location: delete.php?deleted"); 
}

?>

<?php include_once 'includes/header.php'; ?>

<div class="clearfix"></div>

<div class="container">

 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>Success!</strong> record was deleted... 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>Sure !</strong> to remove the following record ? 
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">
  
  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>E - mail ID</th>
         <th>Gender</th>
         </tr>
         
         <?php 
          $id = $_GET['delete_id'];
            $row=$crudObj->getRecordById("tbl_users", "*", " WHERE id = '$id'");
         ?>
               <tr>
               <td><?php print($row['id']); ?></td>
               <td><?php print($row['first_name']); ?></td>
               <td><?php print($row['last_name']); ?></td>
               <td><?php print($row['email_id']); ?></td>
            <td><?php print($row['contact_no']); ?></td>
               </tr>
         </table>
      <?php
         }
         ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'includes/footer.php'; ?>