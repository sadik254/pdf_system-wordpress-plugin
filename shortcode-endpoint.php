<?php

function send_data_to_endpoint_shortcode() {
    // Get the current user ID
    $user_id = get_current_user_id();

    // Retrieve user meta values
    $firstname = get_user_meta($user_id, 'first_name', true);
    $lastname = get_user_meta($user_id, 'last_name', true);
    $email = get_user_meta($user_id, 'user_email', true);
    $gender = get_user_meta($user_id, 'user_gender', true);
    $dob = get_user_meta($user_id, 'user_dob', true);
    $control_no = get_user_meta($user_id, 'user_control_no', true);
    $wp_id = get_user_meta($user_id, 'user_wp_id', true);

    // Prepare data to send to the endpoint
    $data = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'gender' => $gender,
        'dob' => $dob,
        'control_no' => $control_no,
        'wp_id' => $wp_id
    ];

    // Check if the button is clicked
    if (isset($_POST['trigger_api'])) {
        // Endpoint URL
        $endpoint = 'https://yoururl/cert1api.php';

        // Set up the request
        $args = [
            'body' => json_encode($data),
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'timeout' => 30,
        ];

        // Make a POST request to the endpoint
        $response = wp_remote_post($endpoint, $args);
        // var_dump($response);

        // Check if the request was successful
        if (!is_wp_error($response) && $response['response']['code'] === 200) {
            // Get the HTML response from the endpoint
            $html_response = $response['body'];
            
            // var_dump($html_response);
            return $html_response;
            
        } else {
            return 'Failed to retrieve Certificate data from the endpoint. Please refresh the page and try again.';
        }
    }

    // Display form with a button
    // Display form with a button
    $output = '<style>
                .generate-button {
                    background-color: #4CAF50; /* Green */
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    cursor: pointer;
                    border-radius: 10px;
                }
                .generate-button:hover {
                    background-color: #45a049; /* Darker Green */
                }
              </style>';
    $output .= '<form method="post">';
    $output .= '<input class="generate-button" type="submit" name="trigger_api" value="Generate Certificate">';
    $output .= '</form>';


    return $output;
}
add_shortcode('adult_drive_course', 'send_data_to_endpoint_shortcode');
