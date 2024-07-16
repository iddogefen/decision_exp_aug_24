<?php
// Get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];
$subject_id = $post_data['subject_id']; // Extract the subject ID

// Generate a unique filename using subject_id and current date
$file = "{$subject_id}-" . date("Y-m-d-H-i-s"); 
// The directory "data" must be writable by the server
$name = "data/{$file}.csv"; 

// Write the file to disk
file_put_contents($name, $data);
?>
