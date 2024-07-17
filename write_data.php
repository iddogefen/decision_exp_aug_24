<?php

// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
if (!$post_data) {
    http_response_code(400);
    echo 'Invalid JSON input';
    exit;
}

// Retrieve and validate filedata
$filedata = isset($post_data['filedata']) ? $post_data['filedata'] : null;
if (!$filedata) {
    http_response_code(400);
    echo 'Missing filedata';
    exit;
}

// Decode the filedata to get the subject_id
$filedata_decoded = json_decode($filedata, true);
if (!$filedata_decoded || !isset($filedata_decoded['subject_id'])) {
    http_response_code(400);
    echo 'Invalid filedata or missing subject_id';
    exit;
}

// Set the subject_id from the decoded filedata
$subject_id = $filedata_decoded['subject_id'];

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
if (file_put_contents($name, $filedata) === false) {
    http_response_code(500);
    echo 'Failed to write file';
    exit;
}

echo 'File saved successfully';
?>
