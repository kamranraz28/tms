<?php

namespace App\Http\Controllers;

use App\Events\SingleInvoiceLinkRequested;
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
        //dd(1);
        $services = $tenant->tenantServices()->with('service')->get();
        $total = $services->sum('value');

        $html = view('invoices.pdf', compact('tenant', 'services', 'total'))->render();

        $mpdf = new Mpdf(['format' => 'A4']);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output("Invoice_{$tenant->name}.pdf", \Mpdf\Output\Destination::STRING_RETURN))
            ->header('Content-Type', 'application/pdf');
    }

    public function invoiceChange($id)
    {
        //dd($id);
        $tenant = Tenant::findOrFail($id);
        $tenant->invoicing = !$tenant->invoicing;
        $tenant->save();

        return redirect()->back()->with('success', 'Invoicing status updated successfully.');
    }

    public function sendInvoice($id)
    {
        $tenant = Tenant::findOrFail($id);

        event(new SingleInvoiceLinkRequested($tenant));

        return redirect()->back()->with('success', 'Invoice link sent successfully via SMS.');
    }
}
