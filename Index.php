<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Webmail Client</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.css">
    <Link rel="stylesheet" href="Style.css">
    
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <img src="emaillogo.jpg" alt="Webmail Logo" class="w-32 mx-auto mb-6">
                <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">Webmail</h2>
                <nav>
                    <ul>
                        <li class="nav-link">
                            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-100 transition-colors duration-300 group">
                                <svg class="h-6 w-6 text-blue-500 group-hover:text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0h-.01M8 12v4m8-4v4m-8-4h8M6 8l6 6 6-6"/>
                                </svg>
                                <span class="ml-3 text-gray-800 group-hover:text-blue-600 font-medium">Send Your Mail</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="fetchmail.php" class="flex items-center p-3 rounded-lg hover:bg-blue-100 transition-colors duration-300 group">
                                <svg class="h-6 w-6 text-blue-500 group-hover:text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h14v11H3zm0-4h18v2H3zm0-4h18v2H3z"/>
                                </svg>
                                <span class="ml-3 text-gray-800 group-hover:text-blue-600 font-medium">View Received Mails</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Send Mail Section -->
            <div class="card p-8 mx-auto max-w-4xl">
                <h1 class="text-3xl font-bold mb-8 text-center text-blue-500">Send Mail</h1>
                <form action="sendmail.php" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Receiver's Email:</label>
                        <input type="email" id="email" name="email" required class="input-field mt-1 block w-full">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                        <input type="text" id="subject" name="subject" required class="input-field mt-1 block w-full">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message:</label>
                        <textarea id="message" name="message" required class="input-field mt-1 block w-full message-field resize-none"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-3 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">Send</button>
                </form>
            </div>
            
            <!-- Sent Mails Section -->
            <div class="card p-8 mt-10 mx-auto max-w-4xl">
                <h2 class="text-2xl font-bold mb-6">Sent Mails</h2>
                <ul id="sent-mails" class="space-y-4">
                    <?php
                    include 'config.php';
                    
                    
                    try {
                        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
                        $pdo = new PDO($dsn, $username, $password, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        ]);
                    
                     
                        $sql = "SELECT * FROM sent_mails ORDER BY sent_at DESC";
                        $stmt = $pdo->query($sql);
                    
                       
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                                echo "<li class='p-6 bg-gray-50 rounded-lg shadow-sm border border-gray-200'>
                                        <div class='flex flex-col space-y-2'>
                                            <p class='text-sm font-medium text-gray-900'>To: " . htmlspecialchars($row['email']) . "</p>
                                            <p class='text-sm text-gray-600'>Subject: " . htmlspecialchars($row['subject']) . "</p>
                                            <p class='text-sm text-gray-600'>Message: " . htmlspecialchars($row['message']) . "</p>
                                            <p class='text-sm text-gray-500 mt-2'>" . $row['sent_at'] . "</p>
                                        </div>
                                      </li>";
                            }
                        } else {
                            echo "<li class='p-6 bg-gray-50 rounded-lg shadow-sm border border-gray-200'>No sent mails</li>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js"></script>
</body>
</html>
