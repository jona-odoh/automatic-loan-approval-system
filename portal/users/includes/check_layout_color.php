<?php
include("connect.php");
$query = "SELECT color FROM admin WHERE {$_SESSION['SESS_MEMBER_ID']} = :user_id"; // Modify your SQL query accordingly

//$user_id = $_SESSION['SESS_MEMBER_ID'];

try {
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $layoutColor = $result['color_column'];
        echo json_encode(['layoutColor' => $layoutColor]);
    } else {
        echo json_encode(['layoutColor' => '0']); 
    }
} catch (PDOException $e) {
    echo json_encode(['layoutColor' => 'error']);
}
