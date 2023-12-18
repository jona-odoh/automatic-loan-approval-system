<?php
include 'includes/connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $result = $db->prepare("SELECT * FROM admin WHERE id = :id");
    $result->bindParam(':id', $id);

    if ($result->execute()) {
        $applicantData = $result->fetch(PDO::FETCH_ASSOC);

        // Fetch document URLs associated with the applicant
        $documentUrls = array();

        // Fetch the URL for 'up_national_id'
        $upNationalIDResult = $db->prepare("SELECT photo FROM admin WHERE id = :id");
        $upNationalIDResult->bindParam(':id', $id);
        if ($upNationalIDResult->execute()) {
            $document = $upNationalIDResult->fetch(PDO::FETCH_ASSOC);
            $documentUrls['../uploads'] = $document['photo'];
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
