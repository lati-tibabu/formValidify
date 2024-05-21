<?php
// Define max length for the feedback
define('MAX_FEEDBACK_LENGTH', 250);

// Function to validate form data
function validateFormData() {
    $errors = [];

    // Validate name
    if (empty($_POST['name'])) {
        $errors[] = "Name is required.";
    }

    // Validate email
    // if (empty($_POST['email'])) {
    //     $errors[] = "Email is required.";
    // } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    //     $errors[] = "Invalid email format.";
    // }

    // Email validation
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = htmlspecialchars($_POST["email"]);
    // Check if email contains "@" symbol followed by a string
    $emailParts = explode("@", $email);
    if (count($emailParts) !== 2 || empty($emailParts[1])) {
      $emailErr = "Invalid email format (missing '@' or characters after '@')";
    }
  }
  

    // Validate feedback
    if (empty($_POST['feedback'])) {
        $errors[] = "Feedback is required.";
    } elseif (strlen($_POST['feedback']) > MAX_FEEDBACK_LENGTH) {
        $errors[] = "Feedback must not exceed " . MAX_FEEDBACK_LENGTH . " characters.";
    }

    // Validate gender
    if (empty($_POST['gender'])) {
        $errors[] = "Gender is required.";
    }

    return $errors;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = validateFormData();

    if (empty($errors)) {
        // Process the form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $feedback = htmlspecialchars($_POST['feedback']);
        $gender = htmlspecialchars($_POST['gender']);

        // Here you can save the data to a database or perform other actions

        echo "Form submitted successfully!";
        // Redirect to a success page (optional)
        // header('Location: success.php');
        // exit;
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>
