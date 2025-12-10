<?php
/*
 * Database Connection Configuration File (connect.php)
 * Uses the procedural mysqli interface to establish a connection.
 * The connection object is stored in $conn, as expected by the main application.
 */

// --- 1. Configuration Settings ---
$hostname = "localhost";
$username = "root";
$password = ""; 
$database = "trade license"; // WARNING: Spaces in database names are discouraged.

// --- 2. Establish Connection ---
// Note: We use the variable $conn as required by Password_Recovery_Flow.php
$conn = mysqli_connect($hostname, $username, $password, $database);

// --- 3. Immediate Error Handling ---
if (mysqli_connect_errno()) {
    // Fails fast if the server cannot be reached or credentials are bad.
    // Use the die() function to stop execution and display the connection error.
    // For production, you would log this error and display a generic message.
    die("❌ FATAL DB CONNECTION ERROR: Could not connect to MySQL server. Reason: " . mysqli_connect_error());
}

// --- 4. Post-Connection Configuration (Optional but Recommended) ---
// Set the character set to UTF-8 for proper text encoding
if (!mysqli_set_charset($conn, "utf8")) {
    // If setting charset fails, report it.
    // This is less critical than the main connection error.
    printf("Warning: Error loading character set utf8: %s\n", mysqli_error($conn));
}

// Connection is successful and ready to use via the $conn variable.

?>