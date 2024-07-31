<?php
include 'config.php';

function decode_imap_text($str) {
    $decoded = '';
    $parts = imap_mime_header_decode($str);
    foreach ($parts as $part) {
        $decoded .= $part->text;
    }
    return $decoded;
}

function fetch_emails($mailbox, $username, $password, $start = 0, $limit = 10) {
    $inbox = @imap_open($mailbox, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

    $emails = imap_search($inbox, 'ALL');

    $output = [];
    if ($emails) {
        rsort($emails);
        $emails = array_slice($emails, $start, $limit); // Fetch emails based on start and limit
        foreach ($emails as $email_number) {
            $overview = imap_fetch_overview($inbox, $email_number, 0);
            $message = imap_fetchbody($inbox, $email_number, 1.1);

            // If there's no plain text body, try the HTML body
            if (empty($message)) {
                $message = imap_fetchbody($inbox, $email_number, 1);
            }

            // Decode email subject, from, and body
            $subject = decode_imap_text($overview[0]->subject);
            $from = decode_imap_text($overview[0]->from);
            $message = quoted_printable_decode($message);

            $output[] = [
                'subject' => $subject,
                'from' => $from,
                'date' => $overview[0]->date,
                'message' => $message,
            ];
        }
    }

    imap_close($inbox);

    return $output;
}

// Fetch emails
try {
    $emails = fetch_emails('{imap.gmail.com:993/imap/ssl}INBOX', 'dulsharulzzz@gmail.com', 'mujq ajfy puhc yzyp');
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Mails</title>
    <link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-500">Received Mails</h1>
        <ul id="received-mails" class="space-y-4">
            <?php
            if (!empty($emails)) {
                foreach ($emails as $email) {
                    echo "<li class='bg-white p-6 rounded-lg shadow-md border border-gray-200'>
                            <div class='mb-4'>
                                <span class='font-semibold text-gray-800'>From:</span> " . htmlspecialchars($email['from']) . "
                            </div>
                            <div class='mb-4'>
                                <span class='font-semibold text-gray-800'>Subject:</span> " . htmlspecialchars($email['subject']) . "
                            </div>
                            <div class='mb-4'>
                                <span class='font-semibold text-gray-800'>Date:</span> " . htmlspecialchars($email['date']) . "
                            </div>
                            <div>
                                <span class='font-semibold text-gray-800'>Message:</span><br>
                                <pre class='whitespace-pre-wrap'>" . nl2br(htmlspecialchars($email['message'])) . "</pre>
                            </div>
                          </li>";
                }
            } else {
                echo "<li class='bg-white p-6 rounded-lg shadow-md border border-gray-200'>No received mails</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
