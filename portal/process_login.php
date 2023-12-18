<?php
include 'connect.php';
session_start();

function clean($str, $conn) {
    return mysqli_real_escape_string($conn, trim($str));
}

// Initialize error message
$error_message = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the POST values
    $login = clean($_POST['username'], $conn);
    $password = clean($_POST['password'], $conn);

    // Input Validations
    if (empty($login) || empty($password)) {
        $error_message = "Both username and password are required.";
    } else {
        // Create and execute the query
        $qry = "SELECT * FROM admin WHERE username='$login' AND role = 'administrator' OR email='$login' AND role = 'user' ";
        $result = mysqli_query($conn, $qry);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $member = mysqli_fetch_assoc($result);
                if ($password === $member['password']) {
                    // Login Successful
                    session_regenerate_id();
                    $_SESSION['SESS_MEMBER_ID'] = $member['id'];
                    $_SESSION['SESS_ROLE'] = $member['role'];
                    $_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
                    $_SESSION['SESS_LAST_NAME'] = $member['lastname'];
                    $_SESSION['SESS_EMAIL'] = $member['email'];
                    $_SESSION['SESS_PHONE_NUMBER'] = $member['phone'];
                    $_SESSION['SESS_STATE'] = $member['state'];
                    $_SESSION['SESS_ADDRESS'] = $member['address'];
                    $_SESSION['SESS_PRO_PIC'] = $member['photo'];
                    $_SESSION['SESS_USERNAME'] = $member['username'];

                    switch ($_SESSION['SESS_ROLE']) {
                        case 'administrator':
                            header("Location: admin/");
                            exit;
                        case 'lender':
                            header("Location: lender/");
                            exit;
                        case 'user':
                            header("Location: users/");
                            exit;
                        default:
                            $error_message = "Something went wrong. Please try again or contact the company.";
                            break;
                    }
                } else {
                    $error_message = "Incorrect password. Please try again.";
                }
            } else {
                $error_message = "User not found. Please check your username.";
            }
        } else {
            $error_message = "Query failed: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);

// Display the error message and redirect back to the login page
if (!empty($error_message)) {
    $_SESSION['error'] = $error_message;
    header("Location: index.php");
    exit;
}
?>
