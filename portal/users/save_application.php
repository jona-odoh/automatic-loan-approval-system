<?php
session_start();
include('includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user inputs
    $user_id = $_SESSION['SESS_MEMBER_ID']; 
    $ref_no = rand(1, 99999999);
    $balance = filter_input(INPUT_POST, 'desired_amount', FILTER_VALIDATE_FLOAT);
    $fullname = $_SESSION['SESS_FIRST_NAME'] . ' ' . $_SESSION['SESS_LAST_NAME'];
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);

    // Check if the user is at least 18 years old
    if (!isUserAtLeast18($dob)) {
        $_SESSION['error'] = "You must be at least 18 years old to apply for a loan.";
        header("Location: index.php");
        exit();
    }

    $email = $_SESSION['SESS_EMAIL'];
    $contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING);
    $national_id = filter_input(INPUT_POST, 'national_id', FILTER_SANITIZE_STRING);
    $tax_id = filter_input(INPUT_POST, 'tax_id', FILTER_SANITIZE_STRING);
    $employer = filter_input(INPUT_POST, 'employer', FILTER_SANITIZE_STRING);
    $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_STRING);
    $income = filter_input(INPUT_POST, 'income', FILTER_SANITIZE_STRING);
    $e_duration = filter_input(INPUT_POST, 'e_duration', FILTER_SANITIZE_STRING);
    $expenses = filter_input(INPUT_POST, 'expenses', FILTER_SANITIZE_STRING);
    $loan_type = filter_input(INPUT_POST, 'loan_type', FILTER_SANITIZE_STRING);
    $loan_tenure = filter_input(INPUT_POST, 'loan_tenure', FILTER_SANITIZE_STRING);
    $interest = filter_input(INPUT_POST, 'interest', FILTER_SANITIZE_STRING);
    $exLoan = filter_input(INPUT_POST, 'exLoan', FILTER_SANITIZE_STRING);
    $desired_amount = filter_input(INPUT_POST, 'desired_amount', FILTER_VALIDATE_FLOAT);
    $guarantor_name = filter_input(INPUT_POST, 'guarantor_name', FILTER_SANITIZE_STRING);
    $guarantor_no = filter_input(INPUT_POST, 'guarantor_no', FILTER_SANITIZE_STRING);
    $guarantor_national_id = filter_input(INPUT_POST, 'guarantor_national_id', FILTER_SANITIZE_STRING);
    $purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);
    $acct_no = filter_input(INPUT_POST, 'acct_no', FILTER_SANITIZE_STRING);
    $bank = filter_input(INPUT_POST, 'bank', FILTER_SANITIZE_STRING);
    $bvn = filter_input(INPUT_POST, 'bvn', FILTER_SANITIZE_STRING);
    $acct_name = filter_input(INPUT_POST, 'acct_name', FILTER_SANITIZE_STRING);
    $job_status = filter_input(INPUT_POST, 'job_status', FILTER_SANITIZE_STRING);

    // Initialize status and payment_status as placeholders
    $status = 'Not approved';
    $payment_status = 'Not paid';

    // File Uploads
    $uploadDir = '../uploads/';  // Path to the uploads folder
    $up_national_id = '';
    $bank_statement = '';
    $gurantor_pic = '';

    if (!empty($_FILES['up_national_id']['name'])) {
        $prefix = 'national-id' . md5(time() * rand(1, 9999));
        $up_national_id = $uploadDir . $prefix . '_' . $_FILES['up_national_id']['name'];
        move_uploaded_file($_FILES['up_national_id']['tmp_name'], $up_national_id);
    }

    if (!empty($_FILES['bank_statement']['name'])) {
        $prefix = 'bank-statment' . md5(time() * rand(1, 9999));
        $bank_statement = $uploadDir . $prefix . '_' . $_FILES['bank_statement']['name'];
        move_uploaded_file($_FILES['bank_statement']['tmp_name'], $bank_statement);
    }

    if (!empty($_FILES['gurantor_pic']['name'])) {
        $prefix = 'gurantor-pic' . md5(time() * rand(1, 9999));
        $gurantor_pic = $uploadDir . $prefix . '_' . $_FILES['gurantor_pic']['name'];
        move_uploaded_file($_FILES['gurantor_pic']['tmp_name'], $gurantor_pic);
    }
    
    // Check if required files are uploaded
    if (empty($up_national_id) || empty($bank_statement) || empty($gurantor_pic)) {
        $_SESSION['error'] = "Please upload all required documents: National ID, Bank Statement, and Guarantor Picture.";
        header("Location: index.php");
        exit();
    }

    // Check eligibility and job status
    $eligibilityData = eligiable($desired_amount, $interest, $loan_tenure, $exLoan, $income, $job_status);
    
    // Update status and payment_status based on eligibility
    $status = $eligibilityData['status'];
    $payment_status = $eligibilityData['payment_status'];
    $installment_amount = $eligibilityData['installment_amount'];

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO borrower (user_id, ref_no, fullname, dob, email, contact_no, national_id, tax_id, employer, job, income, e_duration, 
    expenses, loan_type, loan_tenure, interest, exLoan, desired_amount, guarantor_name, guarantor_no, 
    guarantor_national_id, purpose, acct_no, 
    bank, bvn, acct_name, up_national_id, bank_statement, gurantor_pic, payment_status, status, job_status, emi) 
    VALUES (:user_id, :ref_no, :fullname, :dob, :email, :contact_no, :national_id, :tax_id, :employer, :job, :income, :e_duration, :expenses,
     :loan_type, :loan_tenure, :interest, :exLoan, :desired_amount, :guarantor_name, :guarantor_no, :guarantor_national_id, :purpose, :acct_no, 
     :bank, :bvn, :acct_name, :up_national_id, :bank_statement, :gurantor_pic, :payment_status, :status, :job_status, :emi)";
    $stmt = $db->prepare($sql);

    // Bind parameters to prevent SQL injection
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':ref_no', $ref_no);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':national_id', $national_id);
    $stmt->bindParam(':tax_id', $tax_id);
    $stmt->bindParam(':employer', $employer);
    $stmt->bindParam(':job', $job);
    $stmt->bindParam(':income', $income);
    $stmt->bindParam(':e_duration', $e_duration);
    $stmt->bindParam(':expenses', $expenses);
    $stmt->bindParam(':loan_type', $loan_type);
    $stmt->bindParam(':loan_tenure', $loan_tenure);
    $stmt->bindParam(':interest', $interest);
    $stmt->bindParam(':exLoan', $exLoan);
    $stmt->bindParam(':desired_amount', $desired_amount);
    $stmt->bindParam(':guarantor_name', $guarantor_name);
    $stmt->bindParam(':guarantor_no', $guarantor_no);
    $stmt->bindParam(':guarantor_national_id', $guarantor_national_id);
    $stmt->bindParam(':purpose', $purpose);
    $stmt->bindParam(':acct_no', $acct_no);
    $stmt->bindParam(':bank', $bank);
    $stmt->bindParam(':bvn', $bvn);
    $stmt->bindParam(':acct_name', $acct_name);
    $stmt->bindParam(':up_national_id', $up_national_id);
    $stmt->bindParam(':bank_statement', $bank_statement);
    $stmt->bindParam(':gurantor_pic', $gurantor_pic);

    // Ensure that payment_status and status are set
    $stmt->bindParam(':payment_status', $payment_status);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':job_status', $job_status);
    $stmt->bindParam(':emi', $installment_amount);

    if ($stmt->execute() && $status === 'Approved' && is_numeric($desired_amount) && is_numeric($interest)) {
        // Calculate loan expiration date based on user-inputted loan tenure
        $loanTenureDays = intval($loan_tenure) * 30; // Assuming a month has 30 days

        $loanExpiryDate = new DateTime();
        $loanExpiryDate->add(new DateInterval("P{$loanTenureDays}D")); // Loan tenure in days

        // Format the date as per your requirement (you can customize this)
        $formattedLoanExpiryDate = $loanExpiryDate->format('Y-m-d');

        // Update the database with the loan expiration date
        $updateExpiryDateSQL = "UPDATE borrower 
        SET loan_expiry_date = :loan_expiry_date, balance = :balance 
        WHERE ref_no = :ref_no";
        $updateExpiryDateStmt = $db->prepare($updateExpiryDateSQL);
        $updateExpiryDateStmt->bindParam(':loan_expiry_date', $formattedLoanExpiryDate);
        $updateExpiryDateStmt->bindParam(':balance', $balance);
        $updateExpiryDateStmt->bindParam(':ref_no', $ref_no);
        $updateExpiryDateStmt->execute();

        // Notify the user about the loan approval and expiration date
        $_SESSION['message'] = "Your loan application of ₦$desired_amount with $interest% interest is approved. We will credit your account: $acct_no, $bank, $acct_name within the next 14 working days.";
        $_SESSION['message'] .= " Your monthly installment amount is ₦" . number_format($installment_amount, 2) . ".";
        $_SESSION['message'] .= " Your loan will expire on: $formattedLoanExpiryDate";
    } elseif ($status === 'Not Approved') {
        $_SESSION['error'] = "We're sorry, your loan application of ₦$desired_amount with $interest% interest is not approved.";
        $_SESSION['error'] .= " Reason: " . $eligibilityData['rejection_reason'];
        $_SESSION['error'] .= " Instructions: " . $eligibilityData['instructions'];
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again later.";
    }
    header("Location: index.php");
    exit();
}

function isUserAtLeast18($dob) {
    $today = new DateTime();
    $dobDate = new DateTime($dob);
    $age = $today->diff($dobDate);
    return $age->y >= 18;
}

function eligiable($desired_amount, $interest, $loan_tenure, $exLoan, $income, $job_status) {
    $desired_amount = floatval($_POST['desired_amount']);
    $interest = floatval($_POST['interest']);
    $loan_tenure = floatval($_POST['loan_tenure']);
    $r1 = $interest / (12 * 100);
    
    // Check if values are not empty
    if (empty($desired_amount) || empty($interest) || empty($loan_tenure) || empty($exLoan) || empty($income)) {
        return array(
            'status' => 'Not Approved',
            'emi' => 0,
            'payment_status' => 'Not paid',
            'rejection_reason' => 'Your application is incomplete or contains invalid data.',
            'instructions' => 'Please provide complete and accurate information.'
        );
    }

    $pinterest = ($desired_amount * $r1 * pow((1 + $r1), $loan_tenure * 12)) / (pow((1 + $r1), $loan_tenure * 12) - 1);
    $emi1 = ceil($pinterest * 100) / 100;
    $existing = floatval($_POST['exLoan']);
    $existingLoan = ($existing - ($existing * 60 / 100));
    $income = floatval($_POST['income']);

    if ($income <= 14999) {
        $incomere = (($income) * 40 / 100) - $existingLoan;
    } elseif ($income <= 29999) {
        $incomere = (($income) * 45 / 100) - $existingLoan;
    } elseif ($income >= 30000) {
        $incomere = (($income) * 50 / 100) - $existingLoan;
    }

    $incomereq = floor($incomere / $emi1 * $desired_amount);
    $prate2 = ($incomereq * $r1 * pow((1 + $r1), $loan_tenure * 12)) / (pow((1 + $r1), $loan_tenure * 12) - 1);
    $emi2 = ceil($prate2 * 100) / 100;

    if ($incomereq > $desired_amount) {
        return array(
            'status' => 'Approved',
            'emi' => $emi1,
            'payment_status' => 'Not paid',
            'installment_amount' => $emi1,
        );
    } else {
        return array(
            'status' => 'Not Approved',
            'emi' => $emi2,
            'payment_status' => 'Not paid',
            'installment_amount' => $emi2,
            'rejection_reason' => 'Your application does not meet our eligibility criteria.',
            'instructions' => 'To increase your chances of approval next time, consider improving your income and reducing existing loans.'
        );
    }
}
?>
