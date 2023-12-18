<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $ltype_name = $_POST['ltype_name'];
  $ltype_desc = $_POST['ltype_desc'];
  $status = $_POST['status'];

  $sql = "UPDATE loan_type SET ltype_name = :ltype_name, ltype_desc = :ltype_desc, status = :status WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':ltype_name', $ltype_name);
  $stmt->bindParam(':ltype_desc', $ltype_desc);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':id', $id);

  if ($stmt->execute()) {
    $_SESSION['message'] = 'Loan type updated successfully!';
  } else {
    $_SESSION['error'] = 'Failed to update the loan type.';
  }

  header("Location: loan_type.php"); 
  exit();
} else {
  $_SESSION['error'] = 'Invalid request.';
  header("Location: loan_type.php"); 
  exit();
}
?>
