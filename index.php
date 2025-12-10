<?php
session_start();
// Set error reporting to a minimum for a production environment, although E_ALL is good for development.
// Removed E_NOTICE suppression for cleaner code practice.
// NOTE: $error variable is retrieved from the session passed by loginn.php
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']); // Clear error after display
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade License Login</title>
    <link rel="shortcut icon" href="./images/6.png" />
    <style>
        /* Modern and Responsive CSS */
        :root {
            --primary-color: #007bff; /* Blue for primary actions */
            --accent-color: orange; /* Orange for alerts/dates */
            --error-color: #dc3545; /* Red for errors */
            --text-light: white;
            --background-dark: #343a40; /* Dark background color */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('images/mback.jpg');
            background-size: cover;
            background-position: center;
        }

        #login-container {
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        #login-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            text-align: left;
        }

        #login-header img {
            width: 70px;
            height: 70px;
            margin-right: 15px;
            border-radius: 50%;
        }

        #login-header h3 {
            color: var(--text-light);
            font-size: 1.1em;
            line-height: 1.4;
            margin: 0;
            flex-grow: 1;
        }

        .date-message-span {
            display: block;
            color: var(--accent-color);
            font-size: 0.9em;
            margin-top: 5px;
        }

        #login h2 {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 25px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
        }

        form label {
            display: block;
            color: var(--text-light);
            font-size: 1.1em;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Padding is inside the width */
        }

        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: var(--text-light);
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #00b35aff;
        }

        .error-message {
            display: block;
            color: var(--error-color);
            font-size: 1.1em;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password-link {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password-link a {
            color: var(--accent-color);
            font-size: 1em;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password-link a:hover {
            color: yellow;
            text-decoration: underline;
        }

        /* Home link button */
        .home-link-container {
            position: absolute;
            top: 20px;
            left: 50px;
        }
        .home-link-container a {
            background-color: var(--background-dark);
            color: var(--primary-color);
            padding: 10px 15px;
            display: inline-block;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: background-color 0.5s ease;
        }
        .home-link-container a:hover {
            background-color: yellowgreen;
        }

        /* --- Loader CSS (Removed absolute positioning) --- */
        /* Loader is often unnecessary on a static login page, but kept here for potential use */
        /* Loader styles are kept but not displayed in the current structure unless specifically added back */
        .loader { display: none; } /* Hide loader by default in this context */

        /* Media Queries for Responsiveness */
       /* --- Default Styles (Applies to all screens, generally large desktops) --- */
/* The main #login-container should have a max-width and be centered. 
   (Assuming this is already set in your general CSS, e.g., max-width: 400px;) */

/* --- Media Query for Tablets and Smaller Desktops (Up to 1024px) --- */
@media (min-width: 601px) {
    /* Restore normal header display (side-by-side) */
    #login-header {
        flex-direction: row;
        text-align: left;
        gap: 15px;
    }
  
    /* Center the container but give it a fixed max-width */
    #login-container {
        max-width: 400px; /* Assuming this was the target width */
        width: 100%;
        padding: 40px; /* Restore desktop padding */
        margin: auto; /* Ensure it stays centered */
    }

    #login-header img {
        width: 60px; /* Slightly larger image */
        height: 60px;
        margin-right: 15px;
    }

    #login-header h3 {
        font-size: 1.0em; /* Slightly larger text */
    }
}


/* --- Media Query for Large Desktops and Above (Starting at 1025px) --- */
@media (min-width: 1025px) {
    /* Restore the largest desktop styles */
    #login-container {
        padding: 40px; /* Full padding */
    }

    #login-header img {
        width: 70px; /* Largest image size */
        height: 70px;
    }

    #login-header h3 {
        font-size: 1.1em; /* Full text size */
    }
    
    .date-message-span {
        font-size: 0.9em; /* Full date size */
    }
}
    </style>
</head>
<body>

<div id="login-container">
    <div id="login">
        <h2>User Login</h2>

        <div id="login-header">
            
            <img src="images/capture31.png" alt="Trade License Logo"/>

            <?php
            // Get the current date and time
            $current_date = date('l, F d, Y');
            ?>
            
            <h3>
                Get Registration here! Today, please read the proclamation about License and list of trade codes to continue. 
                <span class="date-message-span">
                    Right now, the date is: <?php echo $current_date; ?>.
                </span>
            </h3>
        </div>

        <form action="loginn.php" name="login" method="POST">
            
            <label>
                User Name :
            </label>
            <input name="username" placeholder="Enter user name" type="text" required>
            
            <label>
                Password :
            </label>
            <input name="password" placeholder="Enter password" type="password" required>
            
            <input name="login" type="submit" value=" Log In ">
            
            <span class="error-message">
                <?php 
                // Always use htmlspecialchars() when outputting user/session data
                echo htmlspecialchars($error); 
                ?>
            </span>

            <div class="forgot-password-link">
                <a href="forgotpassword/Forgot_Password.php">
                    Click Here If you Forgot Your password?
                </a>
            </div>
        </form>
    </div>
</div>

<div class="home-link-container">
    <a href="home.php">Go to home</a>
</div>

</body>
</html>