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


// Check if username, email, or phone already exist excluding the current ID
$query = "SELECT * FROM admin WHERE (email = :email OR phone = :phone) AND id != :id";
$stmt = $db->prepare($query);
$stmt->execute(array(':email' => $b, ':phone' => $d, ':id' => $id));

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Email, or phone number already exists. Please choose a different one.');</script>";
    echo "<script>window.location.href ='profile.php'</script>";
} else {
    // check if a file was uploaded
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_name  = strtolower($_FILES['photo']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'admin'.md5(time()*rand(1, 9999));
        $file_name_new = $prefix.$file_ext;
        $path = 'uploads/'.$file_name_new;

        // move uploaded file to destination
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
            // update record in the database with the new values and filename
            $sql = "UPDATE admin SET firstname = :a, email = :b, state = :c,  phone = :d, address = :e, lastname = :f, photo = :g WHERE id = :id";
            $q = $db->prepare($sql);
            $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $file_name_new, ':id' => $id));
            if($q){
                $_SESSION['message'] = 'Your account is updated successfully!';
            } else {
                $_SESSION['error'] = 'Something went wrong, please try again';
            }
        }
    } else {
        // update record in the database with the new values without changing the filename
        $sql = "UPDATE admin SET firstname = :a, email = :b, state = :c, phone = :d, address = :e, lastname = :f WHERE id = :id";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':id' => $id));
        if($q){
            $_SESSION['message'] = 'Your account is updated successfully!';
        } else {
            $_SESSION['error'] = 'Something went wrong, please try again';
        }
        
    }
}
header("Location: profile.php");
exit();
?>
