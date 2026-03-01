<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Mail;

$token = 'CHANGE_THIS_MAIL_TEST_TOKEN';

if (! isset($_GET['token']) || ! hash_equals($token, (string) $_GET['token'])) {
    http_response_code(403);
    exit('Forbidden');
}

$basePath = dirname(__DIR__);

require $basePath . '/vendor/autoload.php';

$app = require_once $basePath . '/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/plain; charset=utf-8');

try {
    Mail::raw(
        "Dies ist eine Testmail von expo-display.de.\n\nZeit: " . date('Y-m-d H:i:s'),
        static function ($message): void {
            $message
                ->to('info@expo-display.de')
                ->subject('SMTP Test | EXPO DISPLAY');
        }
    );

    echo "Mail accepted by Laravel/Mailer.\n";
    echo "Check inbox + spam for info@expo-display.de.\n";
} catch (Throwable $exception) {
    http_response_code(500);
    echo "Mail failed: " . $exception->getMessage() . "\n";
}
