<?php
session_start();

include('includes/connect.php');
$id = $_GET['id'];
$a = $_POST['name'];
$b = $_POST['email'];
$c = $_POST['state'];
$d = $_POST['contact_no'];
$e = $_POST['address'];
$f = $_POST['title'];

if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $file_name  = strtolower($_FILES['photo']['name']);
    $file_ext = substr($file_name, strrpos($file_name, '.'));
    $prefix = 'settings'.md5(time()*rand(1, 9999));
    $file_name_new = $prefix.$file_ext;
    $path = '../uploads/'.$file_name_new;

    // move uploaded file to destination
    if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
        // update record in the database with the new values and filename
        $sql = "UPDATE settings SET name = :a, email = :b, state = :c, contact_no = :d, address = :e, title = :f, photo = :g WHERE id = :id";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $file_name_new, ':id' => $id));
        if($q){
            $_SESSION['message'] = 'Setting is updated successfully!';
        } else {
            $_SESSION['error'] = 'Something went wrong, please try again';
        }
        
    }
    
} else {
    // update record in the database with the new values without changing the filename
    $sql = "UPDATE settings SET name = :a, email = :b, state = :c, contact_no = :d, address = :e, title = :f WHERE id = :id";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':id' => $id));
    if($q){
        $_SESSION['message'] = 'Setting is updated successfully!';
    } else {
        $_SESSION['error'] = 'Something went wrong, please try again';
    }
    
}
header("Location: settings.php");
    exit();
?>
