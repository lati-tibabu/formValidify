<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validify Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/cfee536f6f.js" crossorigin="anonymous" async></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=Josefin+Sans&family=Mulish&family=Source+Code+Pro&family=VT323&display=swap" rel="stylesheet">
    <script>
        function openform() {
            var form_area = document.querySelector(".form_area");
            var view_button_area = document.querySelector(".view_button_area");
            view_button_area.style.display = "none";
            form_area.style.display = "flex";
            form_area.style.height = "fit-content";

            var please_area = document.querySelector(".please_area");
            please_area.style.display = "none";
        }

        function closeform() {
            var form_area = document.querySelector(".form_area");
            var view_button_area = document.querySelector(".view_button_area");

            view_button_area.style.display = "flex";
            form_area.style.display = "none";
            form_area.style.height = "0";
        }

        function noOpenform() {
            var view_button_area = document.querySelector(".view_button_area");
            view_button_area.style.display = "none";

            var please_area = document.querySelector(".please_area");
            please_area.style.display = "flex";
        }

        function suggestion() {
            var view_button_area = document.querySelector(".view_button_area");
            view_button_area.style.display = "none";

            var form_area = document.querySelector(".form_area");
            form_area.style.display = "flex";
            form_area.style.height = "fit-content";
        }
    </script>
</head>

<body>
    <div class="view_button_area">
        <div class="view_btn">
            wanna see the form?
        </div>

        <div class="option_buttons">
            <div class="_option no" onclick="openform()">Yes, ofcourse</div>
            <div class="_option no" onclick="noOpenform()">No, not now</div>
        </div>
    </div>

    <div class="form_area">
        <div class="close_button" onclick="closeform()">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <form action="" method="POST" id="mainform">
            <h1>Validify</h1>
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
                if (empty($_POST['email'])) {
                    $errors[] = "Email is required.";
                } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                // // Validate feedback
                // if (empty($_POST['feedback'])) {
                //     $errors[] = "Feedback is required.";
                // } elseif (strlen($_POST['feedback']) > MAX_FEEDBACK_LENGTH) {
                //     $errors[] = "Feedback must not exceed " . MAX_FEEDBACK_LENGTH . " characters.";
                // }

                if (empty($_POST['feedback'])) {
                    $errors[] = "Feedback is required.";
                  } else {
                    $wordCount = str_word_count($_POST['feedback']);
                    if ($wordCount < 20) {
                      $errors[] = "Feedback must be at least 20 words long.";
                    } elseif ($wordCount > 50) {
                      $errors[] = "Feedback must not exceed 50 words.";
                    }
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

                    // Here you can save the data to a database or perform other actions (replace with your logic)
                    echo "Form submitted successfully!<br>";
                    echo "Name: $name<br>";
                    echo "Email: $email<br>";
                    echo "Feedback: $feedback<br>";
                    echo "Gender: $gender<br>";

                    // Optional: Redirect to a success page
                    // header('Location: success.php');
                    // exit;
                } else {
                    // Display errors
                    echo "<p style='color: red;'>Error(s):</p>";
                    echo "<ul style='color: red;'>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                }
            }
            ?>

            <input type="text" id="name" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
            <input type="text" id="email" name="email" placeholder="Email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <textarea name="feedback" id="feedback" maxlength="250" placeholder="Your feedback (max 250 characters)"><?php echo isset($_POST['feedback']) ? $_POST['feedback'] : ''; ?></textarea>
            <div class="gender_area">
                <label for="gender">Gender</label>
                <input type="radio" id="gender" name="gender" value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male') echo 'checked'; ?>>
                <label for="male">Male</label>
                <input type="radio" id="gender" name="gender" value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'female') echo 'checked'; ?>>
                <label for="female">Female</label>
            </div>
            <button id="suggstion_button" type="submit" onclick = "suggestion()">Add Suggestion</button>
        </form>
    </div>

    <div class="please_area">
        <img src="please.png" class="please" alt="">
        <h1 class="pleasetxt">pleeeese see it</h1>
        <div class="_option yes" onclick="openform()">Ok, let me see</div>
    </div>
</body>

</html>
