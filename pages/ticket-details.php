<?php
// Start or resume a session
session_start();
$userId = $_SESSION['userId'];
$userType = $_SESSION['userType'];
$email = $_SESSION['email'];
$user_first_name = $_SESSION['first'];
$user_last_name = $_SESSION['last'];

?>

<?php
//Get the ticket ID from url's query param
$ticketId = $_GET["id"];

//Declare empty variable
$ticket = null;

$xmlDoc = new DOMDocument();
//make sure the XML is nicely formatted
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->load("../xml_xsd/tickets.xml");
$ticketsElement = $xmlDoc->documentElement;


// 1st conditional check, to loop thru the documentElement to search for <ticket> to locate current TicketID
// 2nd conditional check, once located <ticket>, loop thru to find if the ticketID in url === current ticketID
// If matched, stay on the current ticket, then extract the required information for that matched ticket
foreach ($ticketsElement->childNodes as $element) {
    if (strcmp($element->nodeName, "ticket") === 0) {
        $currentTicketId = $element->getElementsByTagName("ticketId")[0]->textContent;
        if (strcmp($ticketId, $currentTicketId) === 0) {
            $ticket = $element;
        }
    }
}

$category = $ticket->getElementsByTagName("category")[0]->textContent;
$subject = $ticket->getElementsByTagName("subject")[0]->textContent;
$status = $ticket->getElementsByTagName("status")[0]->textContent;
$operationDate = $ticket->getElementsByTagName("operationDate")[0];

//To located <open> and <close> date of the ticket
$openDateElements = $operationDate->getElementsByTagName("open");
$openDate = null;
if (count($openDateElements) >= 1) {
    $openDate = $openDateElements[0]->textContent;
}

$closeDateElements = $operationDate->getElementsByTagName("close");
$closeDate = null;
if (count($closeDateElements) >= 1) {
    $closeDate = $closeDateElements[0]->textContent;
}
// To loop to identify presence of each <open> and <close>
foreach ($operationDate->childNodes as $date) {
    $dateList = '';
    if ($openDate !== null) {
        $dateList .= '<p>Date Open: ' . $openDate . '</p></n>';
    }
    if ($closeDate !== null) {
        $dateList .= '<p>Date close: ' . $closeDate . '</p>';
    }
}

$clientID = $ticket->getElementsByTagName("clientId")[0]->textContent;
// To retrieve individual <message> under <messages>
$messages = $ticket->getElementsByTagName("messages")[0];
//Loop to find the match sting and stay at current <messages>
$messageDetails = '';
foreach ($messages->childNodes as $element) {
    if (strcmp($element->nodeName, "message") === 0) {
        $messageElement = $element;

        // Get ticket basic data
        $msg_userId = $messageElement->getElementsByTagName("userId")[0]->textContent;
        $msg_dateTime = $messageElement->getElementsByTagName("dateTime")[0]->textContent;
        $msg_content = $messageElement->getElementsByTagName("content")[0]->textContent;


        // Render ticket basic data

        $messageDetails .= '<div class="d-flex justify-content-between"><div class="p-2 font-weight-bold"> user ID :' . $msg_userId . '</div><div class="p-2">' . $msg_dateTime . '</div></div>';
        $messageDetails .= '<div class="d-flex justify-content-start"><div class="pl-2">' . $msg_content . '</div></div>';


        // Load attachments ir presence
        $msg_attachmentElements = $messageElement->getElementsByTagName("attachment");
        foreach ($msg_attachmentElements as $attachment) {
            $messageDetails .= '<div class="d-flex justify-content-start"><div class="pl-2">' . $attachment->textContent . '</div></div>';
        }
    }
}

?>

<?php require './view/header.php'; ?>
<div class="container text-md-right">
    <p class="font-weight-bold pt-3"> <?php echo 'Welcome, ' . $user_first_name . ' ' . $user_last_name; ?></p>
</div>
<main class=" flex-grow-1 ">
    <h2 class="text-center pt-1">
        <ins>Ticket Details #<?= $ticketId ?></ins>
    </h2>
    <div class="container mt-5 my-5">
        <p>Client: <?= $clientID ?></p>

        <p>Category: <?= $category ?></p>

        <p> Status: <?= $status ?></p>
        <div
            <?php if ($userType == 'client'){ ?>style="display: none; "<?php } ?>>
            <form id="status_form" name="status_form" class="form" method="post" action="change-status.php">
            <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
                <label for="statusType"> Ticket Status: </label>
                <select id="statusType" name="statusType">
                    <option value="New" <?php echo (isset($_POST['statusType']) && $_POST['statusType'] == 'New') ? 'selected' : ''; ?>>New</option>
                    <option value="Review"<?php echo (isset($_POST['statusType']) && $_POST['statusType'] == 'Review') ? 'selected' : ''; ?>>Review</option>
                    <option value="On hold"<?php echo (isset($_POST['statusType']) && $_POST['statusType'] == 'On hold') ? 'selected' : ''; ?>>On hold</option>
                    <option value="Closed"<?php echo (isset($_POST['statusType']) && $_POST['statusType'] == 'Closed') ? 'selected' : ''; ?>>Closed</option>
                    <option value="Completed"<?php echo (isset($_POST['statusType']) && $_POST['statusType'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
                <button type="submit" id="submit" class="btn btn-warning ">Change</button>
            </form>
        </div>


        <div><?= $dateList ?></div>

        <p>Subject: <?= $subject ?></p>
        <div class="row justify-content-center border border dark border-bottom-0 border-left-0 border-right-0">
            <h3 class="p-2">Chat Box</h3>
            <div class="container p-2">
                <div class="border">
                    <?= $messageDetails; ?>
                </div>
            </div>
        </div>

        <form id="msg_form" name="msg_form" class="form" method="post" action="add-message.php">
            <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
            <div class="form-group ">
                <div class="col-auto ">
                    <label for="content"></label>
                    <textarea type="text" id="content" class="form-control" name="content"></textarea>
                </div>
                <div class="clearfix pb-4">
                    <div class="col-auto float-left">
                        <label for="content"></label>
                        <input type="file" class="form-control-file" id="fileUpload" name="fileUpload"
                               accept=".jpg, .jpeg, .png. .pdf">
                    </div>
                    <div class="col-auto float-right pt-2">
                        <button type="submit" id="submit" class="btn btn-secondary mt-2">Send</button>
                    </div>
                </div>
        </form>
    </div>
</main>
<?php require './view/footer.php'; ?>
