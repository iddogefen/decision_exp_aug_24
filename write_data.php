<?php
// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];
$subject_id = $post_data['subject_id']; // Extract the subject ID

// Check if subject_id is provided
if (!$subject_id) {
    http_response_code(400);
    echo json_encode(array('error' => 'subject_id is missing'));
    exit;
}

// Generate a unique filename using subject_id and current date
$file = "{$subject_id}-" . date("Y-m-d-H-i-s"); 
// The directory "data" must be writable by the server
$name = "data/{$file}.csv"; 

// Write the file to disk
file_put_contents($name, $data);
?>
