<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $a = $_POST['ltype_name'];
  $b = $_POST['ltype_desc'];
  $c = $_POST['status'];

    // Check if loan type already exists
  $query = "SELECT * FROM loan_type WHERE ltype_name = :ltype_name";
  $stmt = $db->prepare($query);
  $stmt->execute(array(':ltype_name' => $a));

  if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "The loan type $a already exists. Please choose a different one.";
  } else {
        // If the loan type doesn't exist, proceed with insertion
    $sql = "INSERT INTO loan_type (ltype_name, ltype_desc, status) VALUES (:a, :b, :c)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c));
    
    if ($q) {
      $_SESSION['message'] = "$a is added successfully!";
    } else {
      $_SESSION['error'] = 'Something went wrong, please try again';
    }
  }

  header("Location: loan_type.php");
  exit();
}
?>

