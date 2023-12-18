<?php
function eligiable() {
     $desired_amount = $_POST['desired_amount']; // pick the form input value.. 
     $interest = $_POST['interest']; // pick the form input value..
     $loan_tenure = $_POST['loan_tenure']; // pick the form input value..
     $r1 = $interest / (12 * 100); // to calculate rate percentage..
     $pinterest = ($desired_amount * $r1 * pow((1 + $r1), $loan_tenure * 12)) / (pow((1 + $r1), $loan_tenure * 12) - 1); // to calculate compound interest..
     $emi1 = ceil($pinterest * 100) / 100; // to parse emi amount..
     $existing = $_POST['ExLoan'];
     $existingLoan = ($existing - ($existing * 60 / 100));
     $income = $_POST['NetIncome'];
     if ($income <= 14999) {
         $incomere = (($income) * 40 / 100) - $existingLoan;
     } else if ($income <= 29999) {
         $incomere = (($income) * 45 / 100) - $existingLoan;
     } else if ($income >= 30000) {
         $incomere = (($income) * 50 / 100) - $existingLoan;
     }
     $incomereq = floor($incomere / $emi1 * $desired_amount);
     $prate2 = ($incomereq * $r1 * pow((1 + $r1), $loan_tenure * 12)) / (pow((1 + $r1), $loan_tenure * 12) - 1); // to calculate compound interest2..
     $emi2 = ceil($prate2 * 100) / 100; // to parse emi2 amount..   //Check again Reminder
     // to assign value in field1 as fixed up to two decimal..
     if ($incomereq > $desired_amount) {
         echo "You are Eligible for this loan";
         echo "₦ " . $desired_amount . " at EMI " . "₦ " . number_format($emi1, 0);
         echo "You are Eligible for a maximum loan of " . "₦ " . $incomereq . " at EMI " . "₦ " . number_format($emi2, 0);
     } else {
         echo "You are not Eligible for this loan";
         echo "You are Eligible for a maximum loan of " . "₦ " . $incomereq . " at EMI " . "₦ " . number_format($emi2, 0);
     }
     //to assign value in field2.. 
}
?>
