<?php

/**
 * Script untuk test email approval
 * Usage: php test_email.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Registration;
use App\Mail\RegistrationApprovedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

echo "=== Testing Email Approval ===\n\n";

// Get latest approved registration
$registration = Registration::where('status', 'approved')->latest()->first();

if (!$registration) {
    echo "❌ Tidak ada registration yang approved\n";
    echo "Silakan approve satu registration terlebih dahulu\n";
    exit(1);
}

echo "Registration ID: {$registration->id}\n";
echo "Email: {$registration->email}\n";
echo "Registration Number: {$registration->registration_number}\n\n";

// Check email configuration
echo "=== Email Configuration ===\n";
echo "Mailer: " . config('mail.default') . "\n";
echo "SMTP Host: " . config('mail.mailers.smtp.host') . "\n";
echo "SMTP Port: " . config('mail.mailers.smtp.port') . "\n";
echo "SMTP Encryption: " . config('mail.mailers.smtp.encryption') . "\n";
echo "From Address: " . config('mail.from.address') . "\n";
echo "From Name: " . config('mail.from.name') . "\n";
echo "SMTP Username: " . (config('mail.mailers.smtp.username') ? 'SET' : 'NOT SET') . "\n";
echo "SMTP Password: " . (config('mail.mailers.smtp.password') ? 'SET' : 'NOT SET') . "\n\n";

// Test sending email
echo "=== Sending Test Email ===\n";
try {
    Mail::to($registration->email)->send(new RegistrationApprovedMail($registration));
    echo "✅ Email sent successfully!\n\n";
    
    echo "=== Check the following ===\n";
    echo "1. Check inbox: {$registration->email}\n";
    echo "2. Check SPAM folder\n";
    echo "3. Check if email is blocked by Gmail\n";
    echo "4. Check log file: storage/logs/laravel.log\n\n";
    
} catch (\Swift_TransportException $e) {
    echo "❌ SMTP Transport Error:\n";
    echo "   " . $e->getMessage() . "\n\n";
    echo "Possible causes:\n";
    echo "- Wrong SMTP credentials (username/password)\n";
    echo "- Gmail App Password not set\n";
    echo "- SMTP server unreachable\n";
    echo "- Firewall blocking connection\n\n";
} catch (\Exception $e) {
    echo "❌ Error sending email:\n";
    echo "   " . $e->getMessage() . "\n";
    echo "   Class: " . get_class($e) . "\n\n";
}

echo "=== Check Logs ===\n";
echo "Run: tail -f storage/logs/laravel.log | grep -i 'email\|mail\|smtp'\n";

