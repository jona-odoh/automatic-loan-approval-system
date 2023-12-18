<?php
session_start();
include('includes/connect.php');

$a = $_POST['firstname'];
$b = $_POST['lastname'];
$c = $_POST['contact_no'];
$d = $_POST['email'];
$e = $_POST['tax_no'];
$f = $_POST['national_id'];
$g = $_POST['occupation'];
$h = $_POST['address'];
$i = $_POST['password'];


// Check if contact_no, email, national id or tax id already exist
$query = "SELECT * FROM borrower WHERE contact_no = :contact_no OR email = :email OR tax_no = :tax_no OR national_id = :national_id";
$stmt = $db->prepare($query);
$stmt->execute(array(':contact_no' => $c, ':email' => $d, ':tax_no' => $e, ':national_id' => $f));

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Contact Number, email, tax number or national ID already exists. Please choose a different one.');</script>";
    echo "<script>window.location.href ='borrower.php'</script>";
} else {
    // check if a file was uploaded
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_name  = strtolower($_FILES['photo']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'borrowers'.md5(time()*rand(1, 9999));
        $file_name_new = $prefix.$file_ext;
        $path = '../uploads/'.$file_name_new;
 
        // move uploaded file to destination
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
            // insert record into database with filename
            $sql = "INSERT INTO borrower (firstname,lastname,contact_no,email,tax_no,national_id,occupation,address,password,photo) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j)";
            $q = $db->prepare($sql);
            $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$file_name_new));
            if($q){
                echo "<script>alert('Borrower account is created successfully! Login');</script>";
                echo "<script>window.location.href ='borrower.php'</script>";
            } else {
                echo "<script>alert('Something went wrong please try again');</script>";
                echo "<script>window.location.href ='borrower.php'</script>";
            } 
        }
    } else {
        // insert record into database without filename
        $sql = "INSERT INTO borrower (firstname,lastname,contact_no,email,tax_no,national_id,occupation,address,password) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i)";
        $q = $db->prepare($sql);
        $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i));
        if($q){
            echo "<script>alert('Borrower account is created successfully! Login');</script>";
            echo "<script>window.location.href ='borrower.php'</script>";
        } else {
            echo "<script>alert('Something went wrong please try again');</script>";
            echo "<script>window.location.href ='borrower.php'</script>";
        } 
    }
}

?>
