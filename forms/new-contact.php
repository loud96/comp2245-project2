<?php

// Start or resume the session
// session_start();

require_once "../config.php";
// include_once "head.php";
$currentPage = 'contacts';


?>
<div id="head">
    <h2>New Contact</h2>
</div>

<form onsubmit="return checkContact()">
    <div id="newCon">
    
        <p id="a">
            <label for="title">Title:</label>
            <select id="title" name="title" required>
                <option value="Mrs">Mrs</option>
                <option value="Mr">Mr</option>
                <option value="Miss">Miss</option>
            </select>
        </p>

        <p id="b">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" required>
        </p>

            
        <p id="c">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" required>
        </p> 
            
        <p id="d">
            <label for="emailAddress">Email Address:</label>
            <input type="email" name="email" id="emailAddress" required>
        </p>

        <p id="e">
            <label for="telephone">Telephone:</label>
            <input type="tel" name="telephone" id="telephone" required>
        </p>

        <p id="f">
            <label for="company">Company:</label>
            <input type="text" name="company" id="company" required>
        </p>

        <p id="g">
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="Support">Support</option>
                <option value="Sales Lead">Sales Lead</option>
            </select>
        </p>

        <p id="h">
            <label for="assigned_to">Assigned to:</label>
            <select name="assigned_to" id="assigned_to" required>
                <?php
                // Fetch users from the database
                $query = $conn->prepare("SELECT id, firstname, lastname FROM users");
                $query->execute();

                // Loop through the results and generate options
                while ($row = $query->fetch()) {
                    $fullName = $row['firstname'] . ' ' . $row['lastname'];
                    echo "<option value='{$row['id']}'>$fullName</option>";
                }
                ?>
            </select>
        </p>
    <input id="s" type="submit" class="btn" value="Submit">
    </div>
    
</form>
