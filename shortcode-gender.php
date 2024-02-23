<?php
// Shortcode for collecting and storing gender
function gender_shortcode() {
    ob_start();
    ?>
    <style>
        /* Style the form container */
        .gender-form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        /* Style the radio buttons */
        .gender-form label {
            margin-right: 10px;
        }

        /* Style the submit button */
        .gender-form input[type="submit"] {
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
        .gender-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <div class="gender-form">
    <form method="post">
        <label for="gender_male">
            <input type="radio" id="gender_male" name="user_gender" value="male"> Male
        </label>
        <label for="gender_female">
            <input type="radio" id="gender_female" name="user_gender" value="female"> Female
        </label>
        <input type="submit" value="Submit">
    </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gender = isset($_POST['user_gender']) ? sanitize_text_field($_POST['user_gender']) : '';
        if ($gender !== '') {
            save_user_gender($gender);
            echo 'Gender saved successfully!';
        } else {
            echo 'Please select a gender.';
        }
    }
    return ob_get_clean();
}
add_shortcode('collect_gender', 'gender_shortcode');
