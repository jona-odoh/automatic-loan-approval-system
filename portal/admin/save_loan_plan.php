<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $a = $_POST['lplan_month'];
  $b = $_POST['lplan_interest'];
  $c = $_POST['lplan_penalty']; 
  $d = $_POST['status'];

  // Check if loan type already exists
  $query = "SELECT * FROM loan_plan WHERE lplan_month = :lplan_month AND lplan_interest = :lplan_interest AND lplan_penalty = :lplan_penalty";
  $stmt = $db->prepare($query);
  $stmt->execute(array(':lplan_month' => $a, ':lplan_interest' => $b, ':lplan_penalty' => $c));

  if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "The loan plan $a plan(month), $b.%. interest and $c.%. penalty  already exists. Please choose a different one.";
  } else {
        // If the loan type doesn't exist, proceed with insertion
    $sql = "INSERT INTO loan_plan (lplan_month, lplan_interest,lplan_penalty, status) VALUES (:a, :b, :c, :d)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d));
    
    if ($q) {
      $_SESSION['message'] = " Loan plan is added successfully!";
    } else {
      $_SESSION['error'] = 'Something went wrong, please try again';
    }
  }

  header("Location: loan_plan.php");
  exit();
}
?>

