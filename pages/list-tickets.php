<?php
// Start or resume a session
session_start();

//Declare variables from SESSION
$userId = $_SESSION['userId'];
$userType = $_SESSION['userType'];
$email = $_SESSION['email'];
$user_first_name = $_SESSION['first'];
$user_last_name = $_SESSION['last'];


?>
<?php require './view/header.php'; ?>

<div class="container">
    <main>
        <?php
        //Declare variable(s)
        $rows = "";
        //XML Parser
        $xmlDoc = new DOMDocument();
         //make sure the XML is nicely formatted without whitespace
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->formatOutput = true;
        $xmlDoc->load("../xml_xsd/tickets.xml");
        $ticketsElement = $xmlDoc->documentElement;
        //Find ALL of the ticket when string comparison matched between childNodes's nodeName and "ticket"
            //then display the required details of the ticket
        foreach ($ticketsElement->childNodes as $element) {
            if (strcmp($element->nodeName, "ticket") === 0) {
                $ticket = $element;
                $ticketId = $ticket->getElementsByTagName("ticketId")[0]->textContent;
                $category = $ticket->getElementsByTagName("category")[0]->textContent;
                $subject = $ticket->getElementsByTagName("subject")[0]->textContent;
                $status = $ticket->getElementsByTagName("status")[0]->textContent;
                $clientId = $ticket->getElementsByTagName("clientId")[0]->textContent;
                // To be able to differentiate between staff and client,
                // condition set as if user type is staff or userId matched clientId are the same
                if (strcmp($userType, "staff") === 0 || strcmp($userId, $clientId) === 0) {
                    $rows .= '<tr>';
                    $rows .= '<td>' . $ticketId . '</td>';
                    $rows .= '<td>' . $category . '</td>';
                    $rows .= '<td>' . $subject . '</td>';
                    $rows .= '<td>' . $status . '</td>';
                    $rows .= '<td ><a class="btn btn-primary btn-lg active" role="button" aria-pressed="true" href="ticket-details.php?id=' . $ticketId . '">Details</a></td>';
                    $rows .= '</tr>';
                }
            }
        }
        ?>
        <div class="text-md-right">
            <p class="font-weight-bold pt-3"> <?php echo 'Welcome, ' . $user_first_name . ' ' . $user_last_name; ?></p>
        </div>
        <table class="table table-hover">
            <thead class="thead-light ">
            <tr>
                <th scope="col">Ticket ID</th>
                <th scope="col">Category</th>
                <th scope="col">Subject</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php echo $rows; ?>
            </tbody>
        </table>
    </main>
</div>
<?php require './view/footer.php'; ?>
