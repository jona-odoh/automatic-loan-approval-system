<?php
include 'includes/connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $result = $db->prepare("SELECT * FROM borrower WHERE id = :id");
    $result->bindParam(':id', $id);

    if ($result->execute()) {
        $applicantData = $result->fetch(PDO::FETCH_ASSOC);

        // Fetch document URLs associated with the applicant
        $documentUrls = array();

        // Fetch the URL for 'up_national_id'
        $upNationalIDResult = $db->prepare("SELECT up_national_id FROM borrower WHERE id = :id");
        $upNationalIDResult->bindParam(':id', $id);
        if ($upNationalIDResult->execute()) {
            $document = $upNationalIDResult->fetch(PDO::FETCH_ASSOC);
            $documentUrls['up_national_id'] = $document['up_national_id'];
        }

        // Fetch the URL for 'bank_statement'
        $bankStatementResult = $db->prepare("SELECT bank_statement FROM borrower WHERE id = :id");
        $bankStatementResult->bindParam(':id', $id);
        if ($bankStatementResult->execute()) {
            $document = $bankStatementResult->fetch(PDO::FETCH_ASSOC);
            $documentUrls['bank_statement'] = $document['bank_statement'];
        }

        // Fetch the URL for 'guarantor_pic'
        $guarantorPicResult = $db->prepare("SELECT gurantor_pic FROM borrower WHERE id = :id");
        $guarantorPicResult->bindParam(':id', $id);
        if ($guarantorPicResult->execute()) {
            $document = $guarantorPicResult->fetch(PDO::FETCH_ASSOC);
            $documentUrls['gurantor_pic'] = $document['gurantor_pic'];
        }

        // Assign the document URLs to the 'documents' field in the data
        $applicantData['documents'] = $documentUrls;

        // Return the data as JSON
        echo json_encode($applicantData);
    } else {
        echo json_encode(array('error' => 'Unable to fetch data.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request.'));
}
?>
