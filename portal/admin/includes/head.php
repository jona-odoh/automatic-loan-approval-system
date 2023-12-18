<?php 
include 'connect.php';
session_start();
if(!isset($_SESSION['SESS_MEMBER_ID'])){
    header("location: ../");
}
?> 
<!DOCTYPE html>
<html lang="en">
<?php
              $result = $db->prepare("SELECT * FROM settings");
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
               ?> 
<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SME - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../uploads/<?php echo $row['photo']; ?>' />
</head>
<?php } ?>