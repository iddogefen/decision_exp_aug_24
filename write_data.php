<?php

// get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];

// retrieve the subject_id from the POST data
$subject_id = $post_data['subject_id'];

// generate a unique filename with subject_id and the current date
$file = $subject_id . '-' . date("Y-m-d-H-i-s");

// the directory "data" must be writable by the server
$name = "data/{$file}.csv";

// write the file to disk
file_put_contents($name, $data);
?>
