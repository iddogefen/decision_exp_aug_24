<?php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($json_data);

    // Check if the JSON data is valid
    if ($data !== null && is_object($data)) {

        // Get the subject ID from the JSON data (replace 'your_subject_key' with the actual key)
        $subject_id = isset($data->subject_id) ? $data->subject_id : '';

        // Generate a unique ID for the CSV file using the subject ID and current date
        $csv_id = generateUniqueID($subject_id);

        // Define the path to store the CSV file
        $csv_path = "csv_files/{$csv_id}.csv"; // Adjust the file extension as needed

        // Convert JSON data to CSV format (assuming $data is an object with properties to be saved)
        $csv_data = csvFromObject($data);

        // Save the CSV data to the file
        file_put_contents($csv_path, $csv_data);

        // Respond with a JSON object containing the generated CSV ID
        echo json_encode(array('csv_id' => $csv_id));
    } else {
        // If JSON data is not valid
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Invalid JSON data'));
    }
} else {
    // If the request is not a POST request
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Method not allowed'));
}

// Function to generate a unique ID using the current date and subject ID
function generateUniqueID($subject_id) {
    return $subject_id . '-' . date('Y-m-d-H-i-s'); // Concatenate subject ID with date
}

// Function to convert object to CSV format
function csvFromObject($data) {
    if (!is_object($data)) {
        return '';
    }

    $csv = [];
    foreach ($data as $key => $value) {
        // Assuming $data properties are scalar values or simple arrays
        if (is_array($value)) {
            $value = implode(',', $value); // Convert arrays to comma-separated values
        }
        $csv[] = "{$key},{$value}";
    }
    return implode("\n", $csv);
}
?>
