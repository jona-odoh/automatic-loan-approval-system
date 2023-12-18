<?php
session_start();
include('includes/connect.php');
$a = $_POST['firstname'];
$b = $_POST['lastname'];
$c = $_POST['email'];
$d = $_POST['contact_no'];
$e = $_POST['national_id'];
$f = $_POST['dob'];
$g = $_POST['address'];
$h = $_POST['password'];
$i = $_POST['photo'];
$j = 'Active';

// Initialize arrays to store duplicate field names
$duplicateFields = array();

// Check if email, contact_no, or national_id already exist
$query = "SELECT * FROM users WHERE email = :email OR contact_no = :contact_no OR national_id = :national_id ";
$stmt = $db->prepare($query);
$stmt->execute(array(':email' => $c, ':contact_no' => $d, ':national_id' => $e));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    if ($row['email'] == $g) {
        $duplicateFields[] = 'Email';
    }
    if ($row['contact_no'] == $b) {
        $duplicateFields[] = 'Phone Number';
    }
    if ($row['national_id'] == $d) {
        $duplicateFields[] = 'National ID';
    }
}

if (!empty($duplicateFields)) {
    $message = "The following field(s) already exist: " . implode(', ', $duplicateFields) . ". Please choose different one(s).";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href ='users.php'</script>";
    $_SESSION['error'] = "The following field(s) already exist: " . implode(', ', $duplicateFields) . ". Please choose different one(s).";
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
            $sql = "INSERT INTO admin (firstname, lastname, email, contact_no, national_id, dob, address, password, status, photo) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k)";
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
                ':k' => $file_name_new
            ));
            if ($q) {
                $_SESSION['message'] = 'User account is created successfully!';
            } else {
                $_SESSION['error'] = 'Something went wrong, please try again';
            }
        }
    } else {
        // Insert a new record into the database without a photo
        $sql = "INSERT INTO admin (firstname, lastname, email, contact_no, national_id, dob, address, password, status) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
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
            $_SESSION['message'] = 'User account is created successfully!';
        } else {
            $_SESSION['error'] = 'Something went wrong, please try again';
        }
    }
    header("Location: users.php");
    exit();
}
?>

