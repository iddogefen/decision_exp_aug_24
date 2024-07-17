<?php
// get the data from the POST message
$post_data = json_decode(file_get_contents('php://input'), true);
$data = $post_data['filedata'];
// generate a unique ID for the file, e.g., session-6feu833950202 
// Get the subject ID from the JSON data (replace 'your_subject_key' with the actual key)
$subject_id = $data->subject_id;
        
                // Generate a unique ID for the audio file using the subject ID and current date
$file= generateUniqueID($subject_id);

// the directory "data" must be writable by the server
$name = "data/{$file}.csv"; 
// write the file to disk
file_put_contents($name, $data);
?>



