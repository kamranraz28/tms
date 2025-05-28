<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    //
    public function index()
    {
        $tenants = Tenant::with('property')->get();
        return view('tenants.index', compact('tenants'));
    }
    public function create()
    {
        $properties = Property::all();
        return view('tenants.create',compact('properties'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'nid_number' => 'required|string|max:20',
            'nid_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'property_id' => 'required|exists:properties,id',
        ]);

        $tenant = new Tenant($request->all());

        if ($request->hasFile('nid_upload')) {
            $tenant->nid_upload = $request->file('nid_upload')->store('uploads', 'public');
        }

        $tenant->save();

        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }
    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        $properties = Property::all();
        return view('tenants.edit', compact('tenant', 'properties'));
    }
    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'nid_number' => 'required|string|max:20',
            'nid_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'property_id' => 'required|exists:properties,id',
        ]);

        $tenant->fill($request->all());

        if ($request->hasFile('nid_upload')) {
            $tenant->nid_upload = $request->file('nid_upload')->store('uploads', 'public');
        }

        $tenant->save();

        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }

    public function monthChange($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->invoice_month = !$tenant->invoice_month;
        $tenant->save();

        return redirect()->back()->with('success', 'Invoice month status updated successfully.');
    }
}
