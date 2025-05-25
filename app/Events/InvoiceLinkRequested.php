<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceLinkRequested
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // No data needed
    }
}
