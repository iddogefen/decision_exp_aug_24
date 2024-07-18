<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");
    // Decode the JSON data
    $data = json_decode($json_data);
    // Check if the 'audio_base64' key exists in the decoded data
    if (isset($data->audio_base64)) {
        // Decode the base64-encoded audio data
        $audio_data = base64_decode($data->audio_base64);

        // Generate a unique ID for the audio file based on subject_id
        $audio_id = generateUniqueID($data->subject_id);
        // Get the subject ID from the JSON data (replace 'your_subject_key' with the actual key)
        $subject_id = $data->subject_id;

        // Generate a unique ID for the audio file using the subject ID and current date
        $audio_id = generateUniqueID($subject_id);

        // Define the path to store the audio file
        $audio_path = "audio_files/{$audio_id}.wav"; // Adjust the file extension as needed
@@ -37,9 +40,7 @@
    echo json_encode(array('error' => 'Method not allowed'));
}

// Function to generate a unique ID based on the subject_id
// Function to generate a unique ID using the current date and subject ID
function generateUniqueID($subject_id) {
    return $subject_id . '-' . date('Y-m-d-H-i-s'); // Concatenate subject_id with date
    return $subject_id . '-' . date('Y-m-d-H-i-s'); // Concatenate subject ID with date
}

?>