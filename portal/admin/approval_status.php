<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action']; // 'reject' or 'pay'

    if ($action === 'reject') {
        $approval_status = 'rejected';
    } elseif ($action === 'pay') {
        $approval_status = 'paid';
    } else {
        $_SESSION['error'] = 'Invalid action.';
        header("Location: pending_loans.php");
        exit();
    }

    $sql = "UPDATE borrower SET approval_status = :approval_status WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':approval_status', $approval_status);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        if ($action === 'reject') {
            $_SESSION['message'] = 'Loan rejected successfully!';
        } elseif ($action === 'pay') {
            $_SESSION['message'] = 'Loan marked as paid successfully!';
        }
    } else {
        $_SESSION['error'] = 'Failed to update the status.';
    }

    header("Location: pending_loans.php");
    exit();
} else {
    $_SESSION['error'] = 'Invalid request.';
    header("Location: pending_loans.php");
    exit();
}
?>
