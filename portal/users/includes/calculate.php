<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lplan = $_POST["lplan"];
    $amount = $_POST["amount"];

    // Perform the loan calculation here
    // Example calculation:
    $months = (float)$lplan; // You need to parse the selected option accordingly
    $interest = 5.0; // Example interest rate
    $penalty = 2.0; // Example penalty rate

    $monthly = ($amount + ($amount * ($interest / 100))) / $months;
    $totalAmount = $amount + $monthly;

    $response = [
        "totalAmount" => number_format($totalAmount, 2),
        "monthlyAmount" => number_format($monthly, 2),
        "penaltyAmount" => number_format($monthly * ($penalty / 100), 2)
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    // Handle non-POST requests or direct script access
    http_response_code(400); // Bad Request
    echo "Invalid request.";
}
?>
