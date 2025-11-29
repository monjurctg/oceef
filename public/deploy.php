<?php
// Webhook endpoint for automatic deployment
// WARNING: This is a basic implementation. In production, you should add security measures.

// Secret token for verification (change this to a random secret)
define('DEPLOY_SECRET', 'your-secret-token-here');

// Get the payload
$payload = file_get_contents('php://input');

// Get headers
$headers = getallheaders();

// Verify the signature (if provided)
if (isset($headers['X-Hub-Signature'])) {
    $signature = 'sha1=' . hash_hmac('sha1', $payload, DEPLOY_SECRET);
    if ($signature !== $headers['X-Hub-Signature']) {
        http_response_code(403);
        echo "Forbidden: Invalid signature";
        exit;
    }
}

// Verify the event type
if (isset($headers['X-GitHub-Event']) && $headers['X-GitHub-Event'] === 'push') {
    // Run deployment script
    $output = shell_exec('cd .. && bash deploy.sh 2>&1');

    // Log the deployment
    file_put_contents('../storage/logs/deploy.log', date('Y-m-d H:i:s') . " - Deployment triggered\n" . $output . "\n", FILE_APPEND);

    echo "Deployment started successfully";
} else {
    echo "Not a push event";
}

?>