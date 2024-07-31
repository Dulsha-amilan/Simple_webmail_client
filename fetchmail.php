<?php
include 'config.php';

function fetch_emails($mailbox, $username, $password) {
    $inbox = imap_open($mailbox, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

    $emails = imap_search($inbox, 'ALL');

    $output = [];
    if ($emails) {
        rsort($emails);
        foreach ($emails as $email_number) {
            $overview = imap_fetch_overview($inbox, $email_number, 0);
            $message = imap_fetchbody($inbox, $email_number, 1);

            $output[] = [
                'subject' => $overview[0]->subject,
                'from' => $overview[0]->from,
                'date' => $overview[0]->date,
                'message' => $message,
            ];
        }
    }

    imap_close($inbox);

    return $output;
}

$emails = fetch_emails('{imap.gmail.com:993/imap/ssl}INBOX', 'dulsharulzzz@gmail.com', 'mujq ajfy puhc yzyp');

// Display emails
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Mails</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Received Mails</h1>
        <ul id="received-mails">
            <?php
            if (!empty($emails)) {
                foreach ($emails as $email) {
                    echo "<li><strong>From:</strong> " . htmlspecialchars($email['from']) . " | <strong>Subject:</strong> " . htmlspecialchars($email['subject']) . " | <strong>Date:</strong> " . htmlspecialchars($email['date']) . " | <strong>Message:</strong> " . nl2br(htmlspecialchars($email['message'])) . "</li>";
                }
            } else {
                echo "<li>No received mails</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
