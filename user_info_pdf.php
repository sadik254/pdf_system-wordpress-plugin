<?php
/*
Plugin Name: User Info PDF Plugin
Description: Display current user info and generate certificate
Version: 1.0
Author: Saleh Sadik
Author URI: https://www.linkedin.com/in/sadik254/
*/

// Include shortcode files
include_once(plugin_dir_path(__FILE__) . 'shortcode-gender.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode-dob.php');
include_once(plugin_dir_path(__FILE__) . 'settings-page.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode-endpoint.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode-endpoint2.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode-endpoint3.php');
include_once(plugin_dir_path(__FILE__) . 'shortcode-endpoint4.php');

// Handler to save gender to user meta
function save_user_gender($gender) {
    // Get current user ID
    $user_id = get_current_user_id();

    // Update user meta with the provided gender
    update_user_meta($user_id, 'user_gender', $gender);
}

// Handler to save date of birth to user meta
function save_user_dob($dob) {
    // Get current user ID
    $user_id = get_current_user_id();

    // Update user meta with the provided date of birth
    update_user_meta($user_id, 'user_dob', $dob);
}


function get_control_numbers_from_api() {
    // API endpoint URL
    $api_url = 'https://yoururl/control.php';

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        // Handle error
        $error_message = curl_error($curl);
        curl_close($curl);
        return ['error' => $error_message];
    }

    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $control_numbers = json_decode($response, true);

    // Check if JSON decoding was successful
    if ($control_numbers === null) {
        return ['error' => 'Failed to decode JSON response'];
    }

    // Return control numbers array
    return $control_numbers;
}

function add_control_number_via_api($control_no, $used) {
    // API endpoint URL
    $api_url = 'https://yoururl/control.php';

    // Data to be sent in the POST request
    $data = array(
        'control_no' => $control_no,
        'used' => $used
    );

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        // Handle error
        $error_message = curl_error($curl);
        curl_close($curl);
        return ['error' => $error_message];
    }

    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $response_data = json_decode($response, true);

    // Check if JSON decoding was successful
    if ($response_data === null) {
        return ['error' => 'Failed to decode JSON response'];
    }

    // Return response data
    return $response_data;
}

function get_license_numbers_from_api() {
    // API endpoint URL
    $api_url = 'https://yoururl/license.php';

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        // Handle error
        $error_message = curl_error($curl);
        curl_close($curl);
        return ['error' => $error_message];
    }

    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $license_numbers = json_decode($response, true);

    // Check if JSON decoding was successful
    if ($license_numbers === null) {
        return ['error' => 'Failed to decode JSON response'];
    }

    // Return control numbers array
    return $license_numbers;
}

function add_license_number_via_api($license_no, $used) {
    // API endpoint URL
    $api_url = 'https://yoururl/license.php';

    // Data to be sent in the POST request
    $data = array(
        'license_no' => $license_no,
        'used' => $used
    );

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        // Handle error
        $error_message = curl_error($curl);
        curl_close($curl);
        return ['error' => $error_message];
    }

    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $response_data = json_decode($response, true);

    // Check if JSON decoding was successful
    if ($response_data === null) {
        return ['error' => 'Failed to decode JSON response'];
    }

    // Return response data
    return $response_data;
}
