<?php

namespace App\Listeners;

use App\Events\InvoiceLinkRequested;
use App\Models\Tenant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendInvoiceLinkSms
{
    public function handle($event)
    {
        $apiKey = config('services.sms.api_key');
        $senderId = config('services.sms.sender_id');
        $smsApiUrl = config('services.sms.api_url');

        $tenants = Tenant::with('tenantServices.service')->get();

        foreach ($tenants as $tenant) {
            if (!$tenant->phone) continue;

            $url = route('invoices.show', $tenant->id);
            $message = "Dear {$tenant->name}, your service invoice is ready. View and pay here: {$url}";

            $response = Http::get($smsApiUrl, [
                'api_key' => $apiKey,
                'type' => 'text',
                'number' => $tenant->phone,
                'senderid' => $senderId,
                'message' => $message
            ]);

            if (!$response->successful()) {
                Log::error("Failed to send invoice link to {$tenant->phone}", [
                    'response' => $response->body()
                ]);
            }
        }
    }
}
