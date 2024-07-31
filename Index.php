<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Webmail Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Send Mail</h1>
        <form action="sendmail.php" method="POST">
            <label for="email">Receiver's Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">Send</button>
        </form>
        <h2>Sent Mails</h2>
        <ul id="sent-mails">
            <?php
            // Fetch sent mails from the database and display them
            include 'config.php';
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM sent_mails ORDER BY sent_at DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li><strong>To:</strong> " . htmlspecialchars($row['email']) . " | <strong>Subject:</strong> " . htmlspecialchars($row['subject']) . " | <strong>Message:</strong> " . htmlspecialchars($row['message']) . " | <strong>Sent At:</strong> " . $row['sent_at'] . "</li>";
                }
            } else {
                echo "<li>No sent mails</li>";
            }
            
            $conn->close();
            ?>
        </ul>
    </div>
    
</body>
</html>
