<?php
    
require('..//admin/inc/essentials.php');
require('..//admin/inc/db_config.php');

// Start output buffering to capture any unwanted output
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $full_name = htmlspecialchars($_POST['full_name']);
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $perm_street = htmlspecialchars($_POST['perm_street']);
    $perm_city = htmlspecialchars($_POST['perm_city']);
    $perm_state = htmlspecialchars($_POST['perm_state']);
    $perm_postal_code = $_POST['perm_postal_code'];
    $desired_course = htmlspecialchars($_POST['desired_course']);
    $desired_branch = htmlspecialchars($_POST['desired_branch']);
    $highest_qualification = $_POST['highest_qualification'];
    $institution_name = htmlspecialchars($_POST['institution_name']);
    $year_of_passing = $_POST['year_of_passing'];
    $grade = $_POST['grade'];
    
    // Handle file upload
    $photograph_name = null;
    if (isset($_FILES['photograph']) && $_FILES['photograph']['error'] === UPLOAD_ERR_OK) {
        $upload_result = uploadUserImage($_FILES['photograph']);
        if ($upload_result === 'inv_img' || $upload_result === 'upd_failed') {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
            exit;
        } else {
            $photograph_name = $upload_result;
        }
    }

    // Construct address fields
    $permanent_address = "$perm_street, $perm_city, $perm_state, $perm_postal_code";

    // Prepare data array for database insertion
    $data = [
        'full_name' => $full_name,
        'date_of_birth' => $date_of_birth,
        'gender' => $gender,
        'contact_number' => $contact_number,
        'email' => $email,
        'permanent_address' => $permanent_address,
        'desired_course' => $desired_course,
        'desired_branch' => $desired_branch,
        'highest_qualification' => $highest_qualification,
        'institution_name' => $institution_name,
        'year_of_passing' => $year_of_passing,
        'grade' => $grade,
        'photograph' => $photograph_name
    ];

    // Insert data into database
    $result = createStudent($data); // Assuming createStudent() function handles database insertion
    
    if ($result) {
        $response = ['status' => 'error', 'message' => 'Form submission Failed.'];
    } else {
        $response = ['status' => 'success', 'message' => 'Form submitted successfully.Thankyou for filling admission form'];
    }

    // End output buffering and clean output
    ob_end_clean();
    
    // Output JSON response
    echo json_encode($response);
    exit();
}

// End output buffering and discard any remaining output
ob_end_clean();
?>


