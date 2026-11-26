<?php

namespace App\Jobs;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendContactNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 2;

    public function __construct(
        public Contact $contact
    ) {}

    public function handle(): void
    {
        sleep(3);

        Log::info('Contact notification sent for ID: ' . $this->contact->id);
    }

    public function failed(?\Throwable $exception): void
    {
        Log::error(
            'Contact notification failed for ID: ' .
                $this->contact->id .
                '. Error: ' . $exception->getMessage()
        );
    }
}
