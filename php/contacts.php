<?php
$currentPage = 'contacts';  
include_once("../config.php"); 

// Start or resume the session
session_start();
?>

<div id="head">
    <h2>Dashboard</h2>
    <button id="addContact" onclick="addContact()"><i class="fa-solid fa-plus"></i>  Add New Contact</button>
</div>

<div class="tableContainer">
    <div class="filter-buttons">
        <h4>Filter By:</h4>
        <button id="allContacts" class="filter-button" onclick='contactsQuery("all")' data-filter="all">All Contacts</button>
        <button id="salesLeads" class="filter-button" onclick='contactsQuery("sales")' data-filter="Sales Lead">Sales Lead</button>
        <button id="supportContacts" class="filter-button" onclick='contactsQuery("support")' data-filter="Support">Support</button>
        <button id="assignedToMe" class="filter-button" onclick='contactsQuery("assigned")' data-filter="assigned">Assigned to me</button>
    </div>
    <table cellspacing="0" cellpadding="2" id="resultTable">
        <thead>
            <tr>
                <th width="35%">Full Name</th>
                <th width="30%">Email</th>
                <th width="20%">Company</th>
                <th width="10%">Type</th>
                <th width="5%"> Action </th>
            </tr>
        </thead>
        <tbody>

            <?php
                //Initialize filter
                $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                
                $userId = $_SESSION['userid'];

                //Query filter parameters
                switch ($filter) {
                    case 'sales':
                        $query = $conn->prepare("SELECT * FROM contacts WHERE type = 'Sales Lead'");
                        break;
                    case 'support':
                        $query = $conn->prepare("SELECT * FROM contacts WHERE type = 'Support'");
                        break;
                    case 'assigned':
                        $query = $conn->prepare("SELECT * FROM contacts WHERE assigned_to = :userId");
                        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
                        break;
                    default:
                        //Default to all
                        $query = $conn->prepare("SELECT * FROM contacts");
                        break;
                }
                
                $query->execute();

                $rowCount = $query->rowCount(); //Get amout of rows
                
                if ($rowCount > 0) {
                    while ($row = $query->fetch()) {
            ?>
                    <tr class="record" data-filter="<?php echo $row['type']; ?>">
                        <td><?php echo $row['title'] . ' ' . $row['firstname'] . ' ' . $row['lastname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['company']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td id="view" onclick="viewContactDetails(<?php echo $row['id']; ?>)"> View</td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="13">No contacts found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>