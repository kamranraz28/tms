<?php

namespace App\Http\Controllers;

use App\Events\InvoiceLinkRequested;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\Tenantservice;
use Illuminate\Http\Request;


class TenantserviceController extends Controller
{
    //
    public function services($id)
    {

        $tenant = Tenant::findOrFail($id);
        $tenantServices = $tenant->tenantServices()->with('service')->get();
        return view('tenantservices.index', compact('tenantServices'));
    }
    public function create()
    {
        $services = Service::all();
        $tenants = Tenant::all();
        return view('tenantservices.create',compact('services', 'tenants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'service_id' => 'required|exists:services,id',
            'value' => 'required|string|max:255',
        ]);

        Tenantservice::create($request->all());
        return redirect()->back()->with('success', 'Tenant Service created successfully.');
    }
    public function edit($id)
    {
        $tenantService = Tenantservice::findOrFail($id);
        $services = Service::all();
        $tenants = Tenant::all();
        return view('tenantservices.edit', compact('tenantService', 'services', 'tenants'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'service_id' => 'required|exists:services,id',
            'value' => 'required|string|max:255',
        ]);

        $tenantService = Tenantservice::findOrFail($id);
        $tenantService->update($request->all());
        return redirect()->back()->with('success', 'Tenant Service updated successfully.');
    }
    public function destroy($id)
    {
        $tenantService = Tenantservice::findOrFail($id);
        $tenantService->delete();
        return redirect()->back()->with('success', 'Tenant Service deleted successfully.');
    }

    public function invoice()
    {
        event(new InvoiceLinkRequested());

        return redirect()->back()->with('success', 'Invoice link sent successfully via SMS.');
    }
}
