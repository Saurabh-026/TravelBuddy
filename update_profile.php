<?php
// update_profile.php
session_start();
require_once 'db_connect.php'; // Ensure this path is correct

// --- Check if user is logged in ---
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login
    header('Location: login.php');
    exit();
}

// --- Check if the form was submitted ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Not a POST request, redirect back to profile
    header('Location: profile.php');
    exit();
}

// --- Get User ID from Session ---
$user_id = $_SESSION['user_id'];

// --- Retrieve Form Data ---
$name = trim($_POST['name'] ?? '');
$current_password = $_POST['current_password'] ?? ''; // Don't trim passwords
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// --- Basic Validation ---
$errors = [];
if (empty($name)) {
    $errors[] = "Name cannot be empty.";
}

// --- Password Change Logic ---
$update_password = false;
$new_password_hash = null;

// Check if the user intends to change the password
// They intend to change if current_password OR new_password is filled
if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {

    // If they started filling password fields, current password becomes required
    if (empty($current_password)) {
        $errors[] = "Current password is required to change your password.";
    }
    // New password is required if current is provided
    if (empty($new_password)) {
         $errors[] = "New password cannot be empty if you intend to change it.";
    }
    // Check if new passwords match
    if ($new_password !== $confirm_password) {
        $errors[] = "New password and confirmation password do not match.";
    }
    // Optional: Add password strength validation here if desired
    if (strlen($new_password) < 6 && !empty($new_password)) { // Example: Minimum 6 characters
         $errors[] = "New password must be at least 6 characters long.";
    }


    // If there are no password-related errors so far, verify the current password
    if (empty($errors)) {
        // Fetch the current password hash from the database
        $query = "SELECT password_hash FROM users WHERE user_id = ?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
             error_log("Update Profile Prepare Error (fetch hash): " . $mysqli->error);
             $errors[] = "Database error checking password. Please try again.";
        } else {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($user_data = $result->fetch_assoc()) {
                // Verify the provided current password against the stored hash
                if (password_verify($current_password, $user_data['password_hash'])) {
                    // Current password is correct, proceed to hash the new one
                    $update_password = true;
                    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    if ($new_password_hash === false) {
                         error_log("Update Profile Error: password_hash failed.");
                         $errors[] = "Error processing new password. Please try again.";
                         $update_password = false; // Prevent update
                    }
                } else {
                    // Current password verification failed
                    $errors[] = "Incorrect current password.";
                }
            } else {
                // Should not happen if user_id from session is valid
                $errors[] = "User data not found.";
            }
            $stmt->close();
        }
    }
} // End password change check


// --- Proceed with Update if No Errors ---
if (empty($errors)) {
    // Decide which SQL query to use
    if ($update_password && $new_password_hash !== null) {
        // Update both name and password
        $sql = "UPDATE users SET name = ?, password_hash = ? WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
             error_log("Update Profile Prepare Error (name & pass): " . $mysqli->error);
             $_SESSION['update_message'] = "Error preparing update. Please try again.";
             $_SESSION['update_message_type'] = 'error';
        } else {
            $stmt->bind_param("ssi", $name, $new_password_hash, $user_id);
            if ($stmt->execute()) {
                $_SESSION['update_message'] = "Profile updated successfully!";
                $_SESSION['update_message_type'] = 'success';
                // Optional: Update name in session if you display it elsewhere
                $_SESSION['user_name'] = $name;
            } else {
                 error_log("Update Profile Execute Error (name & pass): " . $stmt->error);
                $_SESSION['update_message'] = "Error updating profile. Please try again.";
                $_SESSION['update_message_type'] = 'error';
            }
            $stmt->close();
        }
    } else {
        // Update only the name
        $sql = "UPDATE users SET name = ? WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
         if (!$stmt) {
             error_log("Update Profile Prepare Error (name only): " . $mysqli->error);
             $_SESSION['update_message'] = "Error preparing update. Please try again.";
             $_SESSION['update_message_type'] = 'error';
        } else {
            $stmt->bind_param("si", $name, $user_id);
             if ($stmt->execute()) {
                $_SESSION['update_message'] = "Profile name updated successfully!";
                $_SESSION['update_message_type'] = 'success';
                 // Optional: Update name in session
                 $_SESSION['user_name'] = $name;
            } else {
                 error_log("Update Profile Execute Error (name only): " . $stmt->error);
                $_SESSION['update_message'] = "Error updating profile name. Please try again.";
                $_SESSION['update_message_type'] = 'error';
            }
            $stmt->close();
        }
    }
} else {
    // --- Store errors in session and redirect back ---
    $_SESSION['update_message'] = "Could not update profile. Please fix the errors below.";
    $_SESSION['update_message_type'] = 'error';
    $_SESSION['form_errors'] = $errors;
    // Optional: Store submitted name value to repopulate form (though JS handles this now)
    // $_SESSION['form_data'] = ['name' => $name];
}

// --- Close the database connection ---
$mysqli->close();

// --- Redirect back to the profile page ---
header('Location: profile.php');
exit();
?>
