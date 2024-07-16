<?php
// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];

// Check if subject_id is present
if (!isset($data['subject_id'])) {
    http_response_code(400);
    echo json_encode(array('error' => 'subject_id is required'));
    exit;
}

$subject_id = $data['subject_id'];

// Generate a unique filename using subject_id and current timestamp
$file = "{$subject_id}-" . date("Y-m-d-H-i-s") . ".csv"; 
// The directory "data" must be writable by the server
$name = "data/{$file}"; 

// Write the file to disk
if (file_put_contents($name, json_encode($data))) {
    echo json_encode(array('message' => 'File saved successfully', 'filename' => $file));
} else {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to write file'));
}
?>
