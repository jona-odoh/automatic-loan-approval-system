<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $lplan_month = $_POST['lplan_month'];
  $lplan_interest = $_POST['lplan_interest'];
  $lplan_penalty = $_POST['lplan_penalty'];
  $status = $_POST['status'];

  $sql = "UPDATE loan_plan SET lplan_month = :lplan_month, lplan_interest = :lplan_interest, lplan_penalty = :lplan_penalty, status = :status WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':lplan_month', $lplan_month);
  $stmt->bindParam(':lplan_interest', $lplan_interest);
  $stmt->bindParam(':lplan_penalty', $lplan_penalty);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':id', $id);

  if ($stmt->execute()) {
    $_SESSION['message'] = 'Interest updated successfully!';
  } else {
    $_SESSION['error'] = 'Failed to update the Interest.';
  }


  header("Location: loan_plan.php"); 
  exit();
} else {
  $_SESSION['error'] = 'Invalid request.';
  header("Location: loan_plan.php"); 
  exit();
}
?>
