<?php
// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];

// Ensure $data is an array
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data format']);
    exit;
}

$subject_id = $data['subject_id'];

// Generate a unique ID for the file
$file = uniqid($subject_id . '-'); // or use time() for uniqueness
$name = "data/{$file}.csv"; 

// Open the file for writing
if ($fp = fopen($name, 'w')) {
    // Write the data to the file as CSV
    fputcsv($fp, $data); // If $data is an array
    fclose($fp);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to write file']);
}
?>
