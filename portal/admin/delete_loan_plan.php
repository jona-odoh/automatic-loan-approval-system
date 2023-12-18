<?php
include 'includes/connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $db->prepare("DELETE FROM loan_plan WHERE id = :id");
    $result->bindParam(':id', $id);

    if ($result->execute()) {
        echo 'success'; // Return 'success' on successful deletion
    } else {
        echo 'error'; // Return 'error' if the deletion fails
    }
} else {
    echo 'error'; // Return 'error' if the 'id' parameter is not set
}
