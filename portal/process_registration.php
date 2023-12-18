<?php
session_start();
include('connect.php');

// Retrieve user input data
$a = $_POST['firstname'];
$b = $_POST['lastname'];
$c = $_POST['email'];
$d = $_POST['phone'];
$e = $_POST['national_id'];
$f = $_POST['dob'];
$g = $_POST['address'];
$h = $_POST['password'];
$i = 'USERS';
$j = 'cleared';
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($h !== $confirm_password) {
    $_SESSION['error'] = 'Password and Confirm Password do not match.';
    header("Location: register.php");
    exit();
}

// Initialize an array to store duplicate field names
$duplicateFields = array();

// Check if email, phone, or national_id already exist
$query = "SELECT * FROM admin WHERE email = :email OR phone = :phone OR national_id = :national_id ";
$stmt = $db->prepare($query);
$stmt->execute(array(':email' => $c, ':phone' => $d, ':national_id' => $e));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row['email'] == $c && !empty($c)) {
        $duplicateFields[] = 'Email';
    }
    if ($row['phone'] == $d && !empty($d)) {
        $duplicateFields[] = 'Phone Number';
    }
    if ($row['national_id'] == $e && !empty($e)) {
        $duplicateFields[] = 'National ID';
    }
}

if (!empty($duplicateFields)) {
    $message = "The following field(s) already exist: " . implode(', ', $duplicateFields) . ". Please choose different one(s).";
    $_SESSION['error'] = $message;
    header("Location: register.php");
    exit();
} else {
    // Check if a file was uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_name = strtolower($_FILES['photo']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'users' . md5(time() * rand(1, 9999));
        $file_name_new = $prefix . $file_ext;
        $path = 'uploads/' . $file_name_new;

        // Move the uploaded file to the destination
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
            // Insert a new record into the database

            // Insert a new record into the database with hashed password
            $sql = "INSERT INTO admin (firstname, lastname, email, phone, national_id, dob, address, password, role, loan_status, photo) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k)";
            $q = $db->prepare($sql);
            $q->execute(array(
                ':a' => $a,
                ':b' => $b,
                ':c' => $c,
                ':d' => $d,
                ':e' => $e,
                ':f' => $f,
                ':g' => $g,
                ':h' => $h,  
                ':i' => $i,
                ':j' => $j,
                ':k' => $file_name_new,
            ));

            if ($q) {
                $_SESSION['message'] = 'Your registration account has been created successfully!';
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Something went wrong. Please try again.';
                header("Location: register.php");
                exit();
            }
        }
    } else {
        // Insert a new record into the database without a photo
        $sql = "INSERT INTO admin (firstname, lastname, email, phone, national_id, dob, address, password, role, loan_status) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
        $q = $db->prepare($sql);
        $q->execute(array(
            ':a' => $a,
            ':b' => $b,
            ':c' => $c,
            ':d' => $d,
            ':e' => $e,
            ':f' => $f,
            ':g' => $g,
            ':h' => $h,
            ':i' => $i,
            ':j' => $j
        ));
        if ($q) {
            $_SESSION['message'] = 'User account has been created successfully!';
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = 'Something went wrong. Please try again.';
            header("Location: register.php");
            exit();
        }
    }
}
?>
