<?php
session_start();
//Gather the infromation collected from the form and Session
$ticketId = $_POST['ticketId'];
$userId = $_SESSION['userId'];
//Format the Timestamp to match the dateTime data type
$timestamp = date("Y-m-d\TH:i:s", time());
$content = $_POST['content'];


//Append new message to ticket-details.php
$xmlDoc = new DOMDocument();
//make sure the XML is nicely formatted
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->load("../xml_xsd/tickets.xml");
$ticketsElement = $xmlDoc->documentElement;
$ticket = null;
foreach ($ticketsElement->childNodes as $element) {
    if (strcmp($element->nodeName, "ticket") === 0) {
        $currentTicketId = $element->getElementsByTagName("ticketId")[0]->textContent;
        if (strcmp($ticketId, $currentTicketId) === 0) {
            $ticket = $element;
            print "<br/>Ticket: " . $ticketId;
        }
    }
}

//creating a new message with its childNode and append to CURRENT <ticket>
if ($ticket !== null) {

    $currentMessages = $ticket->getElementsByTagName("messages")->item(0);
    $newMsg = $xmlDoc->createElement("message");

    $newUserId = $xmlDoc->createElement("userId", $userId);
    $newDateTime = $xmlDoc->createElement("dateTime", $timestamp);
    $newContent = $xmlDoc->createElement("content", $content);

    $newMsg->appendChild($newUserId);
    $newMsg->appendChild($newDateTime);
    $newMsg->appendChild($newContent);

    $currentMessages->appendChild($newMsg);

    $xmlDoc->save("../xml_xsd/tickets.xml");

}


header("Location: ticket-details.php?id=$ticketId");

?>
