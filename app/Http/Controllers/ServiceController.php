<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function index()
    {
        // Logic to list all services
        $services = Service::all();
        return view('services.index', compact('services'));
    }
    public function create()
    {
        // Logic to show the form for creating a new service
        return view('services.create');
    }
    public function store(Request $request)
    {
        // Logic to store a new service
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);

        // Assuming you have a Service model
        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }
    public function edit($id)
    {
        // Logic to show the form for editing an existing service
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update an existing service
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service = Service::findOrFail($id);
        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }
    public function destroy($id)
    {
        // Logic to delete a service
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
