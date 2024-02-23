<?php
// Shortcode for collecting and storing date of birth
function dob_shortcode() {
    ob_start();
    ?>
    <style>
        /* Style the input field */
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensure padding is included in width */
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Style the submit button */
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Change submit button color on hover */
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <form method="post">
        <label for="user_dob">
            <input type="date" id="user_dob" name="user_dob">
        </label>
        <input type="submit" value="Submit">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dob = isset($_POST['user_dob']) ? sanitize_text_field($_POST['user_dob']) : '';
        if ($dob !== '') {
            save_user_dob($dob);
            echo 'Date of birth saved successfully!';
        } else {
            echo 'Please enter a valid date of birth.';
        }
    }
    return ob_get_clean();
}
add_shortcode('collect_dob', 'dob_shortcode');
