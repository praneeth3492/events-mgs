<?php

// Check if mandatory fields are set
if (!isset($_POST['academic_year']) || !isset($_POST['student_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Mandatory fields are missing']);
    exit;
}

// Capture form data from the incoming request
$academic_year = $_POST['academic_year'];
$student_name = $_POST['student_name'];
$student_last_name = $_POST['student_last_name'] ?? NULL;
$gender = $_POST['gender'] ?? NULL;
$parent_name = $_POST['parent_name'] ?? NULL;
$mobile_number = $_POST['mobile_number'] ?? NULL;
$email = $_POST['email'] ?? NULL;
$class_id = $_POST['class_id'] ?? NULL;
 
$source = $_POST['source'];
$current_city = $_POST['current_city']?? NULL;
$api_key = "1fEkQiYkD7Fqyrid06BFXccK1QdiIaXh";

// Build the JSON payload
$post_data = json_encode(array(
    "academic_year" => $academic_year,
    "student_name" => $student_name,
    "student_last_name" => $student_last_name,
    "gender" => $gender,
    "parent_name" => $parent_name,
    "mobile_number" => $mobile_number,
    "email" => $email,
    "class_id" => $class_id,     
    "source" => $source,
    "current_city" => $current_city,
    "api_key" => $api_key
));

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://manchesterglobal.schoolelement.in/api/enquiry/add',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $post_data,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: ci_session=u0ka89agbaggv6nm4q5t7iaka1k2afrf'
    ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo json_encode(['status' => 'error', 'message' => $error_msg]);
    exit;
}

curl_close($curl);
echo $response;

?>
