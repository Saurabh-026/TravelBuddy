<?php
// fetch_news.php
ini_set('display_errors', 1); // Temporarily enable errors for debugging
error_reporting(E_ALL);     // Report all errors

// Include your database connection script
// Adjust the path if db_connect.php is in a different directory
require_once 'db_connect.php'; // <--- Make sure this path is correct

// *** Check if the $mysqli variable exists and if there was a connection error ***
// (The die() in db_connect.php should prevent script continuation on error,
// but this is an extra safeguard)
if (!isset($mysqli) || $mysqli->connect_errno) {
    // Output a more specific error if $mysqli exists but failed
    $error_message = isset($mysqli) ? "({$mysqli->connect_errno}) {$mysqli->connect_error}" : "Connection object not found.";
    error_log("Fetch News Error: Database connection issue - " . $error_message); // Log the specific error
    echo '<p class="text-red-500 text-center px-4 py-2">Error: Could not connect to the database.</p>';
    exit; // Stop script execution
}

// --- Use $mysqli variable from now on ---

// Fetch the latest 5 news items (adjust LIMIT as needed)
$sql = "SELECT title, content, published_at, url FROM news ORDER BY published_at DESC LIMIT 5";
$result = $mysqli->query($sql); // <--- Use $mysqli here

$output = ''; // Initialize output string

if ($result && $result->num_rows > 0) {
    // Start an unordered list for the news items
    $output .= '<ul class="space-y-4 news-list">';
    while ($row = $result->fetch_assoc()) {
        $output .= '<li class="border-b border-gray-200 pb-3">';
        $output .= '<h4 class="font-semibold text-md mb-1">' . htmlspecialchars($row['title']) . '</h4>';
        // Format the date
        $formatted_date = date("M d, Y H:i", strtotime($row['published_at']));
        $output .= '<p class="text-xs text-gray-500 mb-2">Published: ' . $formatted_date . '</p>';
        $output .= '<p class="text-sm text-gray-700">' . nl2br(htmlspecialchars($row['content'])) . '</p>';
        // Add a link if URL exists and is not '#'
        if (!empty($row['url']) && $row['url'] !== '#') {
            $output .= '<a href="' . htmlspecialchars($row['url']) . '" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 inline-block">Read more...</a>';
        }
        $output .= '</li>';
    }
    $output .= '</ul>';
} else if ($result) {
    // No news found
    $output .= '<p class="text-center text-gray-500">No recent news available.</p>';
} else {
    // SQL Query Error - Log the error for debugging
    error_log("Fetch News Error: SQL query failed - " . $mysqli->error); // <--- Use $mysqli here
    $output .= '<p class="text-red-500 text-center px-4 py-2">Error fetching news. Please check server logs.</p>';
}

// Close the connection
$mysqli->close(); // <--- Use $mysqli here

// Echo the generated HTML
echo $output;
?>