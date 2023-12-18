<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php
              $result = $db->prepare("SELECT * FROM settings");
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
               ?> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Borrow - is the loan company website template.">
    <meta name="keywords" content="loan, bad credit, EMI Calculator, credit cars, home loan, car loan, education loan">
    <title>Borrow - A Loan Company Website</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simple-slider.css">
    <link rel="stylesheet" type="text/css" href="../../../code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel='shortcut icon' type='image/x-icon' href='portal/uploads/<?php echo $row['photo']; ?>' />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CMerriweather:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- owl Carousel Css -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php } ?>