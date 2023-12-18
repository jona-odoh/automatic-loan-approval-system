<?php
session_start();
include('includes/connect.php');
$id = $_GET['id'];
$a = $_POST['firstname'];
$b = $_POST['email'];
$c = $_POST['state'];
$d = $_POST['phone'];
$e = $_POST['address'];
$f = $_POST['lastname'];

// Initialize arrays to store duplicate field names
$duplicateFields = array();

// Check if email, phone already exist
$query = "SELECT * FROM admin WHERE (email = :email OR phone = :phone) AND id != :id";
$stmt = $db->prepare($query);
$stmt->execute(array(':email' => $b, ':phone' => $d, ':id' => $id));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    if ($row['email'] == $b) {
        $duplicateFields[] = 'Email';
    }
    if ($row['phone'] == $d) {
        $duplicateFields[] = 'Phone Number';
    }
    
}

if (!empty($duplicateFields)) {
    $message = "Oops " . implode(', ', $duplicateFields) . ". already exist, Please choose different one(s).";
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href ='users.php'</script>";
    $_SESSION['error'] = "Oops " . implode(', ', $duplicateFields) . ". already exist, Please choose different one(s).";
} else {
    // Check if a file was uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_info = getimagesize($_FILES['photo']['tmp_name']);
        $allowed_mime_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

        if ($file_info !== false && in_array($file_info[2], $allowed_mime_types)) {
            $file_name = strtolower($_FILES['photo']['name']);
            $file_ext = substr($file_name, strrpos($file_name, '.'));
            $prefix = 'users' . md5(time() * rand(1, 9999));
            $file_name_new = $prefix . $file_ext;
            $path = '../uploads/' . $file_name_new;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
                $sql = "UPDATE admin SET firstname = :a, email = :b, state = :c, phone = :d, address = :e, lastname = :f, photo = :g WHERE id = :id";
                $q = $db->prepare($sql);
                $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $file_name_new, ':id' => $id));

                if ($q) {
                    $_SESSION['message'] = 'Your account is updated successfully!';
                } else {
                    $_SESSION['error'] = 'Something went wrong. Please try again.';
                }
            } else {
                $_SESSION['error'] = 'Failed to upload the image. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Invalid file type. Please upload a valid image file (JPEG, PNG).';
        }
    } else {
        $sql = "UPDATE admin SET firstname = :a, email = :b, state = :c, phone = :d, address = :e, lastname = :f WHERE id = :id";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':id' => $id));

        if ($q) {
            $_SESSION['message'] = 'Your account is updated successfully!';
            
        } else {
            $_SESSION['error'] = 'Something went wrong, please try again';
            
            
        }
    }

}

header("Location: profile.php");
exit();
?>
