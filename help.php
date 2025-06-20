<?php
include "header.php";
include "connection.php";
include "container.php";

$current_user_userid = $_SESSION['userid']; 
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container justify-center bg-warning p-4">
        <h2 class="h1-blockquote text-center fw-bold">GUIDE FOR DEV</h2>
    </div>

    <div class="container justify-center-fixed md- mb-4 text-start"><br>
        <h3>Welcome to the Developer Guide</h3>
        <p>This guide will help developers understand the structure of this web application and navigate through the project. It also includes setup instructions and code contribution guidelines.</p>
        
        <h4>Project Overview</h4>
        <p>This web application is designed for asset management, user management, and reporting. Users and admins can interact with assets, and admins can manage users and see detailed reports. The application includes features such as asset editing, searching, and status updates.</p>

        <h4>File Structure Breakdown</h4>
        <p>Here's an overview of the key files and directories in this project:</p>
        
        <h5>1. Core Files</h5>
        <ul>
            <li><strong>connection.php</strong>: Contains the database connection setup. Essential for querying and interacting with the database.</li>
            <li><strong>header.php</strong>: Includes the top section of the page, such as navigation, meta tags, and external files like CSS and JS.</li>
            <li><strong>footer.php</strong>: Contains the footer content, used on every page to display consistent footer information.</li>
            <li><strong>container.php</strong>: Contains the main content area of the page. This is where dynamic content is displayed.</li>
            <li><strong>style.css</strong>: This file contains all the CSS rules for styling the application and ensuring a responsive layout.</li>
            <li><strong>main.js</strong>: The main JavaScript file, handling client-side behavior and interactions like form validation, event handling, and AJAX requests.</li>
            <li><strong>jquery-3.7.1.min.js</strong>: A version of jQuery included to simplify DOM manipulation, AJAX requests, and event handling.</li>
        </ul>

        <h5>2. User Management</h5>
        <ul>
            <li><strong>loginform.php</strong>: The login page for users to authenticate. The credentials are checked here before granting access.</li>
            <li><strong>signup.php</strong>: The registration page where new users can sign up for the platform.</li>
            <li><strong>logout.php</strong>: Logs the user out by destroying the session and redirecting to the login page.</li>
            <li><strong>edituser.php</strong>: A page where users can edit their profile information such as their name, email, etc.</li>
            <li><strong>updateuser.php</strong>: Handles the update of user profile information in the database after submission from the edit user page.</li>
        </ul>

        <h5>3. Asset Management</h5>
        <ul>
            <li><strong>editasset.php</strong>: A page where users or admins can edit asset details, including category, value, quantity, and the inception date (purchase date).</li>
            <li><strong>activateasset.php</strong>: Activates or deactivates assets, typically used to manage the status of assets.</li>
            <li><strong>deletesassetid.php</strong>: Deletes an asset from the database based on the asset ID.</li>
            <li><strong>viewasset.php</strong>: Displays the details of a particular asset, providing an overview of its information.</li>
            <li><strong>search.php</strong>: Provides the functionality to search for assets based on criteria such as asset ID, category, or purchase date.</li>
        </ul>

        <h5>4. Reporting & Management</h5>
        <ul>
            <li><strong>report.php</strong>: Provides reports based on asset data, which may include usage statistics, total values, etc.</li>
            <li><strong>management1.php</strong>: Admin panel or dashboard for managing users, assets, and viewing reports.</li>
            <li><strong>dashboard.php</strong>: Contains the navigation menu for the application, allowing users to navigate through different sections.</li>
        </ul>

        <h5>5. Administrative Files</h5>
        <ul>
            <li><strong>status.php</strong>: A file that might display the status of assets or users (e.g., whether an asset is active or inactive, or whether a user is banned or active).</li>
            <li><strong>term.php</strong>: A page that contains the terms and conditions for the website, likely displayed for users to read and accept.</li>
            <li><strong>viewuser.php</strong>: Displays user details, typically used by an admin to view user profile information and manage users.</li>
            <li><strong>deletesuserid.php</strong>: Admin functionality for deleting a user based on their user ID.</li>
        </ul>

        <h5>6. Miscellaneous Files</h5>
        <ul>
            <li><strong>about.php</strong>: Provides information about the application or the organization behind it.</li>
            <li><strong>help.php</strong>: A page for the developer or admin to refer to for assistance on how the system works or how to troubleshoot.</li>
        </ul>

        <h4>Developer Setup Instructions</h4>
        <p>Follow these steps to get the project running locally:</p>
        <ol>
            <li>Clone the repository from GitHub or download the project files.</li>
            <li>Ensure that PHP and MySQL are installed on your local machine or server.</li>
            <li>Update the database credentials in <strong>connection.php</strong> to match your local or server environment.</li>
            <li>Create a MySQL database and import the required tables via SQL dump provided in the repository (if available).</li>
            <li>Open the website in your browser by navigating to the root folder of the project.</li>
        </ol>

        <h4>Code Conventions</h4>
        <p>Follow these guidelines to ensure the project remains clean and maintainable:</p>
        <ul>
            <li>Use <strong>mysqli_real_escape_string()</strong> for user input sanitization to prevent SQL injection.</li>
            <li>Maintain consistent naming conventions for functions and variables (e.g., camelCase for variables, PascalCase for classes).</li>
            <li>Separate HTML and PHP code when possible for better readability and maintainability.</li>
            <li>Use prepared statements for SQL queries involving user input to enhance security.</li>
            <li>Ensure that all error messages are meaningful, providing helpful feedback to users and developers.</li>
        </ul>

        <h4>Contributing</h4>
        <p>If you'd like to contribute to the project, follow these steps:</p>
        <ul>
            <li>Fork the repository and clone it to your local machine.</li>
            <li>Create a new branch for the feature or bug fix you're working on.</li>
            <li>Write meaningful commit messages explaining your changes.</li>
            <li>Ensure your code follows the project coding style.</li>
            <li>Submit a pull request when youre ready to contribute your changes.</li>
        </ul>

        <h4>Goodluck, Dev :D</h4>
        <p>Happy coding and thank you for contributing!</p>
    </div>
</div>

<?php
include "footer.php";
?>
