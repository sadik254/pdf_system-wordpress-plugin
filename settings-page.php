<?php
// Settings page to display collected information
function user_info_settings_page() {
    $user_id = get_current_user_id();

    // Retrieve user meta values
    $user_gender = get_user_meta($user_id, 'user_gender', true);
    $user_dob = get_user_meta($user_id, 'user_dob', true);
    $user_email = get_user_meta($user_id, 'user_email', true);
    $user_nicename = get_user_meta($user_id, 'user_nicename', true);
    $user_displayname = get_user_meta($user_id, 'display_name', true);
    $user_firstname = get_user_meta($user_id, 'first_name', true);
    $user_lastname = get_user_meta($user_id, 'last_name', true);
    $user_website = get_user_meta($user_id, 'user_url', true);
    $user_description = get_user_meta($user_id, 'description', true);

    echo '<h2>User Information</h2>';
    echo '<strong>Gender:</strong> ' . $user_gender . '<br>';
    echo '<strong>Date of Birth:</strong> ' . $user_dob . '<br>';
    echo '<strong>Email:</strong> ' . $user_email . '<br>';
    echo '<strong>Nicename:</strong> ' . $user_nicename . '<br>';
    echo '<strong>Display Name:</strong> ' . $user_displayname . '<br>';
    echo '<strong>First Name:</strong> ' . $user_firstname . '<br>';
    echo '<strong>Last Name:</strong> ' . $user_lastname . '<br>';
    echo '<strong>Website:</strong> ' . $user_website . '<br>';
    echo '<strong>Description:</strong> ' . $user_description . '<br>';
    
    echo 'to get Gender use [collect_gender] shortcode';
    echo 'to get DOB use [collect_dob] shortcode';
    echo "<br>";
    echo 'to use the certificate generation option use [adult_drive_course] shortcode';
    echo "<br>";
    echo 'to use the Parent Taught certificate generation use [parent_taught_drive_course] shortcode';
    echo "<br>";
    echo 'to use the Learner License certificate generation use [learner_license_course] shortcode';
    echo "<br>";
    echo 'to use Uniform License certificate generation use [uniform_license_course] shortcode';

    // Display control numbers from API
    echo '<h2>Control Numbers</h2>';
    $control_numbers = get_control_numbers_from_api();
    if (isset($control_numbers['error'])) {
        // Handle error
        echo 'Error: ' . $control_numbers['error'];
    } else {
        // Display control numbers
        foreach ($control_numbers as $control_number) {
            echo '<strong>Control No:</strong> ' . $control_number['control_no'];
            echo '&nbsp;&nbsp;';
            echo '<strong>Status:</strong> ' . ($control_number['used'] == 0 ? 'Not Used' : 'USED') . '<br>';
        }
    }


    // Form to add control number
    echo '<h2>Add Control Number</h2>';
    echo '<form method="post">';
    echo '<label for="control_no">Control Number:</label>';
    echo '<input type="text" name="control_no" id="control_no" required><br>';
    echo '<label for="used">Used:</label>';
    echo '<select name="used" id="used" required>';
    echo '<option value="0">Not Used</option>';
    echo '<option value="1">Used</option>';
    echo '</select><br>';
    echo '<input type="submit" name="add_control_number" value="Add Control Number">';
    echo '</form>';

    // Handle form submission
    if (isset($_POST['add_control_number'])) {
        $control_no = sanitize_text_field($_POST['control_no']);
        $used = intval($_POST['used']);
        $result = add_control_number_via_api($control_no, $used);
        if (isset($result['error'])) {
            // Handle error
            echo 'Error: ' . $result['error'];
        } else {
            // Display success message
            echo 'Control number added successfully with ID: ' . $result['id'];
        }
    }
    
    // Display Licnese numbers from API
    echo '<h2>License Numbers</h2>';
    $license_numbers = get_license_numbers_from_api();
    if (isset($license_numbers['error'])) {
        // Handle error
        echo 'Error: ' . $license_numbers['error'];
    } else {
        // Display control numbers
        foreach ($license_numbers as $license_number) {
            echo '<strong>license No:</strong> ' . $license_number['license_no'];
            echo '&nbsp;&nbsp;';
            echo '<strong>Status:</strong> ' . ($license_number['used'] == 0 ? 'Not Used' : 'USED') . '<br>';
        }
    }
    // Form to add License number
    echo '<h2>Add License Number</h2>';
    echo '<form method="post">';
    echo '<label for="control_no">License Number:</label>';
    echo '<input type="text" name="license_no" id="license_no" required><br>';
    echo '<label for="used">Used:</label>';
    echo '<select name="used" id="used" required>';
    echo '<option value="0">Not Used</option>';
    echo '<option value="1">Used</option>';
    echo '</select><br>';
    echo '<input type="submit" name="add_license_number" value="Add License Number">';
    echo '</form>';

    // Handle form submission
    if (isset($_POST['add_license_number'])) {
        $license_no = sanitize_text_field($_POST['license_no']);
        $used = intval($_POST['used']);
        $result = add_license_number_via_api($license_no, $used);
        if (isset($result['error'])) {
            // Handle error
            echo 'Error: ' . $result['error'];
        } else {
            // Display success message
            echo 'License number added successfully with ID: ' . $result['id'];
        }
    }
}

// Add settings page directly to the admin menu
function add_user_info_settings_page() {
    add_menu_page(
        'User Information',
        'User Information',
        'manage_options',
        'user-info-settings',
        'user_info_settings_page'
    );
}
add_action('admin_menu', 'add_user_info_settings_page');

