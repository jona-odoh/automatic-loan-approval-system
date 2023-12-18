<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_SESSION['SESS_MEMBER_ID'];
  $current_password = $_POST['password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if the current password is correct
  $sql = "SELECT password FROM admin WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result && $current_password === $result['password']) {
    if ($new_password === $confirm_password) {
      // Update the password in the database (still storing it in plain text)
      $sql = "UPDATE admin SET password = :password WHERE id = :id";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':password', $new_password); // Store the new password in plain text
      $stmt->bindParam(':id', $id);

      if ($stmt->execute()) {
        $_SESSION['message'] = 'Password updated successfully!';
      } else {
        $_SESSION['error'] = 'Failed to update the password.';
      }
    } else {
      $_SESSION['error'] = 'New password and confirm password do not match.';
    }
  } else {
    $_SESSION['error'] = 'Current password is incorrect.';
  }

  header("Location: profile.php");
  exit();
} else {
  $_SESSION['error'] = 'Invalid request.';
  header("Location: profile.php");
  exit();
}
?>
