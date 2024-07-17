<?php
// Get the JSON data from the POST request
$post_data = json_decode(file_get_contents('php://input'), true);

// Check if filedata exists in the JSON data
if (isset($post_data['filedata'])) {
    $filedata = $post_data['filedata'];

    // Assuming $filedata['subject_id'] contains the subject ID
    $subject_id = isset($filedata['subject_id']) ? $filedata['subject_id'] : '';

    // Function to generate a unique ID (replace with your actual implementation)
    function generateUniqueID($subject_id) {
        return 'session-' . uniqid() . '-' . $subject_id . '-' . date('Y-m-d-H-i-s');
    }

    // Generate a unique ID for the file
    $file = generateUniqueID($subject_id);

    // Define the path to store the file
    $name = "data/{$file}.csv";

    // Encode $filedata to JSON before writing to file
    $json_data = json_encode($filedata);

    // Write the JSON data to the file
    if (file_put_contents($name, $json_data)) {
        echo "File saved successfully.";
    } else {
        echo "Error saving file.";
    }
} else {
    echo "No filedata found in the POST request.";
}
?>
