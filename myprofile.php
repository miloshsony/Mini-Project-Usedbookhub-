<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>myprofile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   
   <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: 0;
        }

        

        .container {
            text-align: center;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .profile-section {
            margin-bottom: 20px;
        }

        img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-top: 10px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #8e44ad;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        .edit-buttons {
            margin-top: 20px;
        }

        .edit-buttons input {
            margin-right: 10px;
        }
        
    </style>

</head>
<body>
   
<?php include 'header.php'; ?>



    <?php

    // Replace the following with your actual database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming you have the user's ID stored in a session variable, replace it with your actual variable
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
        

        // Handle form submission for each section
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Edit Name
            if (isset($_POST['edit_name'])) {
                // Display the form for editing the name
                echo '<div class="container">';
                echo '<div class="profile-section">';
                echo '<h1>Edit User Name</h1>';
                echo '<form method="post" action="">';
                // echo '<label for="name">New Name:</label>';
                echo '<input type="text" name="name" value="' . ($row['name'] ?? '') . '" required><br>';
                echo '<input type="submit" name="update_name" value="Update Name">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }

            // Edit Gender
            if (isset($_POST['edit_gender'])) {
                // Display the form for editing gender
                echo '<div class="container">';
                echo '<div class="profile-section">';
                echo '<h1>Edit Gender</h1>';
                // Add form elements for editing gender
                echo '<form method="post" action="">';
                // echo '<label for="gender">New Gender:</label>';
                echo '<input type="text" name="gender" value="' . ($row['gender'] ?? '') . '" required><br>';
                echo '<input type="submit" name="update_gender" value="Update Gender">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }

            // Edit Phone Number
            if (isset($_POST['edit_phone'])) {
                // Display the form for editing phone number
                echo '<div class="container">';
                echo '<div class="profile-section">';
                echo '<h1>Edit Phone Number</h1>';
                // Add form elements for editing phone number
                echo '<form method="post" action="">';
                // echo '<label for="phone">New Phone Number:</label>';
                echo '<input type="text" name="phone" value="' . ($row['phone_no'] ?? '') . '" required><br>';
                echo '<input type="submit" name="update_phone" value="Update Phone Number">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }

            // Edit Address
            if (isset($_POST['edit_address'])) {
                // Display the form for editing address
                echo '<div class="container">';
                echo '<div class="profile-section">';
                echo '<h1>Edit Address</h1>';
                // Add form elements for editing address
                echo '<form method="post" action="">';
                // echo '<label for="address">New Address:</label>';
                echo '<input type="text" name="address" value="' . ($row['address'] ?? '') . '" required><br>';
                echo '<input type="submit" name="update_address" value="Update Address">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }

            // Handle the specific update based on the submitted form
            if (isset($_POST['update_name'])) {
                // Handle updating the name
                $newName = $_POST['name'] ?? '';
                $updateSql = $conn->prepare("UPDATE users SET name=? WHERE id=?");
                $updateSql->bind_param("si", $newName, $userID);
                if ($updateSql->execute()) {
                    echo '<script>';
                    echo 'alert("User name updated successfully");';
                    echo '</script>';
                } else {
                    echo "Error updating user name: " . $conn->error;
                }
            }
        }

           
    if (isset($_POST['update_gender'])) {
        // Handle updating the gender
        $newGender = $_POST['gender'] ?? '';
        $updateSql = $conn->prepare("UPDATE users SET gender=? WHERE id=?");
        $updateSql->bind_param("si", $newGender, $userID);
        if ($updateSql->execute()) {
            echo '<script>';
            echo 'alert("Gender updated successfully");';
            echo '</script>';
        } else {
            echo "Error updating gender: " . $conn->error;
        }
    }

    // Handle updating phone number based on the submitted form
    if (isset($_POST['update_phone'])) {
        // Handle updating the phone number
        $newPhone = $_POST['phone'] ?? '';
        $updateSql = $conn->prepare("UPDATE users SET phone_no=? WHERE id=?");
        $updateSql->bind_param("si", $newPhone, $userID);
        if ($updateSql->execute()) {
            echo '<script>';
            echo 'alert("Phone number updated successfully");';
            echo '</script>';
        } else {
            echo "Error updating phone number: " . $conn->error;
        }
    }

    // Handle updating address based on the submitted form
    if (isset($_POST['update_address'])) {
        // Handle updating the address
        $newAddress = $_POST['address'] ?? '';
        $updateSql = $conn->prepare("UPDATE users SET address=? WHERE id=?");
        $updateSql->bind_param("si", $newAddress, $userID);
        if ($updateSql->execute()) {
            echo '<script>';
            echo 'alert("Address updated successfully");';
            echo '</script>';
        } else {
            echo "Error updating address: " . $conn->error;
        }
    }

            // Handle updating the profile picture
            if (isset($_POST['update_image'])) {
                if (isset($_FILES['image'])) {
                    $uploadDir = 'uploaded_img/';
                    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        // Update the database with the new image filename
                        $newImage = $_FILES['image']['name'];
                        $updateSql = $conn->prepare("UPDATE users SET image=? WHERE id=?");
                        $updateSql->bind_param("si", $newImage, $userID);

                        if ($updateSql->execute()) {
                            echo '<script>';
                            echo 'alert("Profile picture updated successfully");';
                            echo '</script>';
                        } else {
                            echo '<script>';
                            echo 'alert("Error updating profile picture: ' . $conn->error . '");';
                            echo '</script>';
                        }
                    } else {
                        echo '<script>';
                        echo 'alert("Error uploading file.");';
                        echo '</script>';
                    }
                }
            }
        // SQL query to retrieve user information
        $sql = "SELECT name, email, gender, phone_no, address, image FROM users WHERE id = $userID";

        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result) {
            // Check if there is at least one row in the result
            if ($result->num_rows > 0) {
                // Fetch the data from the result set
                $row = $result->fetch_assoc();

                // Display user information with internal styles
                echo '<div class="container">';
                echo '<div class="profile-section">';
                // echo '<h1>My Profile</h1>';

                // Display user information only if the keys exist in the $row array
                if (isset($row['name'])) {
                    echo '<h1><strong>Name:</strong> ' . $row['name'] . '</h1><br>';
                }
                if (isset($row['email'])) {
                    echo '<h1><strong>Email:</strong> ' . $row['email'] . '</h1><br>';
                }
                if (isset($row['gender'])) {
                    echo '<h1><strong>Gender:</strong> ' . $row['gender'] . '</h1><br>';
                }
                if (isset($row['phone_no'])) {
                    echo '<h1><strong>Phone Number:</strong> ' . $row['phone_no'] . '</h1><br>';
                }
                if (isset($row['address'])) {
                    echo '<h1><strong>Address:</strong> ' . $row['address'] . '</h1><br>';
                }

                // Display the image with passport size styling
                if (isset($row['image'])) {
                    echo '<div>';
                    echo '<img src="uploaded_img/' . $row['image'] . '" alt="Profile Picture">';
                    echo '</div>';
                }

                // Add an "Edit" button for the profile picture
                echo '<form method="post" action="" enctype="multipart/form-data">';
                // echo '<label for="image">Profile Picture:</label>';
                echo '<input type="file" name="image" accept="image/*">';
                echo '<input type="submit" name="update_image" value="Update Profile Picture">';
                echo '</form>';
                echo '</div>';

                // Display individual edit buttons for gender, phone, and address
                echo '<div class="edit-buttons">';
                echo '<h2>Edit My Profile</h2>';
                echo '<form method="post" action="">';
                echo '<input type="submit" name="edit_name" value="Edit Name">';
                echo '<input type="submit" name="edit_gender" value="Edit Gender">';
                echo '<input type="submit" name="edit_phone" value="Edit Phone Number">';
                echo '<input type="submit" name="edit_address" value="Edit Address">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "No user found with the specified ID";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "User ID not set in the session";
    }

    // Close the database connection
    $conn->close();
    ?>
    <!-- Rest of your HTML content and PHP code -->



<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>