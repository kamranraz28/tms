<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    public function show(Tenant $tenant)
    {
        $tenant->load('tenantServices.service');

        $services = $tenant->tenantServices;
        $total = $services->sum('value');

        return view('invoices.show', compact('tenant', 'services', 'total'));
    }

    public function downloadPdf(Tenant $tenant)
{
    $services = $tenant->tenantServices()->with('service')->get();
    $total = $services->sum('value');

    $html = view('invoices.pdf', compact('tenant', 'services', 'total'))->render();

    $mpdf = new Mpdf(['format' => 'A4']);

    $mpdf->WriteHTML($html);

    return response($mpdf->Output("Invoice_{$tenant->name}.pdf", \Mpdf\Output\Destination::STRING_RETURN))
        ->header('Content-Type', 'application/pdf');
}
}
