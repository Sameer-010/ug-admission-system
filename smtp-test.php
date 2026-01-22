<?php

echo "Starting SMTP test...\n";

$hostname = "smtp.gmail.com";
$port = 587;

echo "Connecting to $hostname on port $port...\n";

$fp = fsockopen($hostname, $port, $errno, $errstr, 20);

if (!$fp) {
    echo "Connection failed: $errstr ($errno)\n";
    exit;
}

echo "Connected successfully!\n";

$response = fgets($fp, 512);
echo "Server Response: $response\n";

fclose($fp);

echo "SMTP test finished.\n";
