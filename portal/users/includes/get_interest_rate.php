<?php
include 'includes/connect.php';

if (isset($_POST['loan_type'])) {
    $loanType = $_POST['loan_type'];

    $result = $db->prepare("SELECT interest FROM loan_type WHERE ltype_name = :loanType");
    $result->bindParam(':loanType', $loanType);

    if ($result->execute()) {
        $interestRate = $result->fetch(PDO::FETCH_ASSOC);

        // Return the interest rate as JSON
        echo json_encode($interestRate);
    } else {
        echo json_encode(array('error' => 'Unable to fetch interest rate.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request.'));
}
?>
