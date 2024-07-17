<?php

// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
if (!$post_data) {
    http_response_code(400);
    echo 'Invalid JSON input';
    exit;
}

// Set the subject_id to a fixed value
$subject_id = 'iddo1992';

// Retrieve and validate filedata
$data = isset($post_data['filedata']) ? $post_data['filedata'] : null;
if (!$data) {
    http_response_code(400);
    echo 'Missing filedata';
    exit;
}

// Generate a unique filename with subject_id and the current date
$file = $subject_id . '-' . date("Y-m-d-H-i-s") . '.csv';

// The directory "data" must be writable by the server
$directory = 'data';
if (!is_dir($directory) || !is_writable($directory)) {
    http_response_code(500);
    echo 'Directory not writable';
    exit;
}

// Write the file to disk
$name = "{$directory}/{$file}";
if (file_put_contents($name, $data) === false) {
    http_response_code(500);
    echo 'Failed to write file';
    exit;
}

echo 'File saved successfully';
?>
