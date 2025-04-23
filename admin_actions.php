<?php
session_start();
require 'db_connect.php'; // Ensure this path is correct

// Check if user is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Optional: Set an error message
    $_SESSION['login_error'] = 'Unauthorized access.';
    header('Location: login.php');
    exit;
}

// Check if the request method is POST and an action is set
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action'])) {
    // Redirect back if accessed incorrectly
    header('Location: admin.php');
    exit;
}

// Get the action from the POST data
$action = $_POST['action'];

// --- Action: Add News ---
if ($action === 'add_news') {
    // Retrieve and trim form data, providing default empty strings
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $url = trim($_POST['url'] ?? '');

    // Basic validation: Ensure title and content are not empty
    if (empty($title) || empty($content)) {
        $_SESSION['admin_message'] = 'Error: Title and Content cannot be empty.';
        header('Location: admin.php');
        exit;
    }

    // Set default URL to '#' if it's empty or doesn't look like a valid URL
    // Consider more robust URL validation if strict format is required
    if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
        $url = '#'; // Default placeholder URL
    }

    // Prepare the SQL statement to insert news
    $sql = "INSERT INTO news (title, content, url, published_at) VALUES (?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        // Bind parameters (s = string)
        $stmt->bind_param("sss", $title, $content, $url);
        // Execute the statement
        if ($stmt->execute()) {
            // Set success message in session
            $_SESSION['admin_message'] = 'News item added successfully.';
        } else {
            // Log error and set error message if execution fails
            error_log("Error adding news: " . $stmt->error);
            $_SESSION['admin_message'] = 'Error: Could not add news item. ' . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        // Log error and set error message if preparation fails
        error_log("Error preparing add news statement: " . $mysqli->error);
        $_SESSION['admin_message'] = 'Error: Database prepare error. ' . $mysqli->error;
    }

// --- Action: Remove News ---
} elseif ($action === 'remove_news') {
    // Get and validate the news ID from POST data
    $news_id = filter_input(INPUT_POST, 'news_id', FILTER_VALIDATE_INT);

    // Redirect if the ID is invalid
    if (!$news_id) {
        $_SESSION['admin_message'] = 'Error: Invalid News ID.';
        header('Location: admin.php');
        exit;
    }

    // Prepare the SQL statement to delete news
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        // Bind parameter (i = integer)
        $stmt->bind_param("i", $news_id);
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected (i.e., if the item existed)
            if ($stmt->affected_rows > 0) {
                $_SESSION['admin_message'] = 'News item removed successfully.';
            } else {
                $_SESSION['admin_message'] = 'Error: News item not found or already removed.';
            }
        } else {
            // Log error and set error message if execution fails
            error_log("Error removing news: " . $stmt->error);
            $_SESSION['admin_message'] = 'Error: Could not remove news item. ' . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        // Log error and set error message if preparation fails
        error_log("Error preparing remove news statement: " . $mysqli->error);
        $_SESSION['admin_message'] = 'Error: Database prepare error. ' . $mysqli->error;
    }

// --- Action: Remove Contact Message ---
} elseif ($action === 'remove_message') {
    // Get and validate the message ID from POST data
    $message_id = filter_input(INPUT_POST, 'message_id', FILTER_VALIDATE_INT);

    // Redirect if the ID is invalid
    if (!$message_id) {
        $_SESSION['admin_message'] = 'Error: Invalid Message ID.';
        header('Location: admin.php');
        exit;
    }

    // Prepare the SQL statement to delete the contact message
    $sql = "DELETE FROM contact_messages WHERE message_id = ?";
    $stmt = $mysqli->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        // Bind parameter (i = integer)
        $stmt->bind_param("i", $message_id);
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $_SESSION['admin_message'] = 'Contact message removed successfully.';
            } else {
                $_SESSION['admin_message'] = 'Error: Message not found or already removed.';
            }
        } else {
            // Log error and set error message if execution fails
            error_log("Error removing contact message: " . $stmt->error);
            $_SESSION['admin_message'] = 'Error: Could not remove contact message. ' . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        // Log error and set error message if preparation fails
        error_log("Error preparing remove message statement: " . $mysqli->error);
        $_SESSION['admin_message'] = 'Error: Database prepare error. ' . $mysqli->error;
    }

// --- Action: Remove User ---
} elseif ($action === 'remove_user') {
    // Get and validate the user ID to remove from POST data
    $user_id_to_remove = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

    // Basic validation: ensure ID is valid and admin is not deleting themselves
    if (!$user_id_to_remove || $user_id_to_remove == $_SESSION['user_id']) {
        $_SESSION['admin_message'] = 'Error: Invalid User ID or cannot remove own admin account.';
        header('Location: admin.php');
        exit;
    }

    // Optional: Add extra checks here if needed, e.g., prevent deletion of other admin accounts

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt) {
        // Bind parameter (i = integer)
        $stmt->bind_param("i", $user_id_to_remove);
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any rows were affected
             if ($stmt->affected_rows > 0) {
                $_SESSION['admin_message'] = 'User removed successfully.';
            } else {
                $_SESSION['admin_message'] = 'Error: User not found or already removed.';
            }
        } else {
            // Log error and set error message if execution fails
            error_log("Error removing user: " . $stmt->error);
            $_SESSION['admin_message'] = 'Error: Could not remove user. ' . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        // Log error and set error message if preparation fails
        error_log("Error preparing remove user statement: " . $mysqli->error);
        $_SESSION['admin_message'] = 'Error: Database prepare error. ' . $mysqli->error;
    }

} else {
    // Handle any actions that are not recognized
    $_SESSION['admin_message'] = 'Error: Unknown action specified.';
}

// Close the database connection if it's still open and valid
if (isset($mysqli) && $mysqli instanceof mysqli && $mysqli->thread_id) {
     $mysqli->close();
}

// Redirect back to the admin dashboard page after performing the action
header('Location: admin.php');
exit; // Ensure script stops execution after redirect
?>
