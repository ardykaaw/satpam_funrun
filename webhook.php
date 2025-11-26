<?php
/**
 * GitHub Webhook Handler untuk Auto Deploy
 * 
 * Cara setup:
 * 1. Upload file ini ke public_html/webhook.php
 * 2. Buat secret token di GitHub (Settings > Webhooks > Add webhook)
 * 3. Set Payload URL: https://yourdomain.com/webhook.php
 * 4. Set Content type: application/json
 * 5. Set Secret: (token yang Anda buat)
 * 6. Set events: Just the push event
 * 7. Set Active: ✓
 */

// Secret token (ganti dengan token yang Anda buat di GitHub)
define('WEBHOOK_SECRET', 'your-secret-token-here');

// Path ke deploy script
define('DEPLOY_SCRIPT', '/home/username/deploy.sh');

// Log file
define('LOG_FILE', '/home/username/webhook.log');

// Function untuk log
function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$timestamp] $message\n", FILE_APPEND);
}

// Function untuk verify signature
function verifySignature($payload, $signature) {
    $hash = hash_hmac('sha256', $payload, WEBHOOK_SECRET);
    return hash_equals('sha256=' . $hash, $signature);
}

// Get headers
$headers = getallheaders();
$signature = $headers['X-Hub-Signature-256'] ?? '';

// Get payload
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// Verify signature
if (!verifySignature($payload, $signature)) {
    http_response_code(403);
    logMessage('ERROR: Invalid signature');
    die('Invalid signature');
}

// Verify event type
$event = $headers['X-GitHub-Event'] ?? '';
if ($event !== 'push') {
    http_response_code(200);
    logMessage("INFO: Ignored event: $event");
    die('Event ignored');
}

// Verify branch (hanya deploy jika push ke main/master)
$branch = $data['ref'] ?? '';
if (!in_array($branch, ['refs/heads/main', 'refs/heads/master'])) {
    http_response_code(200);
    logMessage("INFO: Ignored branch: $branch");
    die('Branch ignored');
}

// Execute deploy script
logMessage('INFO: Starting deployment');
$output = [];
$return_var = 0;
exec('bash ' . DEPLOY_SCRIPT . ' 2>&1', $output, $return_var);

if ($return_var === 0) {
    http_response_code(200);
    logMessage('SUCCESS: Deployment completed');
    echo json_encode([
        'status' => 'success',
        'message' => 'Deployment completed',
        'output' => implode("\n", $output)
    ]);
} else {
    http_response_code(500);
    logMessage('ERROR: Deployment failed');
    echo json_encode([
        'status' => 'error',
        'message' => 'Deployment failed',
        'output' => implode("\n", $output)
    ]);
}

