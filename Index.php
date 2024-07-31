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
            // Include the database configuration file
            include 'config.php';
            
            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Query to fetch sent mails from the database
            $sql = "SELECT * FROM sent_mails ORDER BY sent_at DESC";
            $result = $conn->query($sql);
            
            // Display the sent mails
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li><strong>To:</strong> " . htmlspecialchars($row['email']) . " | <strong>Subject:</strong> " . htmlspecialchars($row['subject']) . " | <strong>Message:</strong> " . htmlspecialchars($row['message']) . " | <strong>Sent At:</strong> " . $row['sent_at'] . "</li>";
                }
            } else {
                echo "<li>No sent mails</li>";
            }
            
            // Close the database connection
            $conn->close();
            ?>
        </ul>

        <h2><a href="fetchmail.php">View Received Mails</a></h2>
    </div>
</body>
</html>
