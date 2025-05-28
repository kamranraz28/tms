<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Costdetail;
use App\Models\Service;
use Illuminate\Http\Request;

class CostController extends Controller
{
    //
    public function index()
    {
        // Logic to display costs
        $costs = Cost::all(); // Fetch all costs from the database
        return view('costs.index',compact('costs'));
    }

    public function create()
    {
        // Logic to show the form for creating a new cost
        $services = Service::all(); // Fetch all services for the dropdown
        return view('costs.create', compact('services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'service_id' => 'required|array',
            'service_id.*' => 'required|exists:services,id',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|min:0',
            'voucher' => 'nullable|array',
            'voucher.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Create the main Cost record
        $cost = Cost::create([
            'date' => $request->date,
        ]);

        // Loop through each cost detail
        foreach ($request->service_id as $index => $serviceId) {
            $voucherName = null;

            // Only process if a file is uploaded for this index
            if ($request->hasFile("voucher.$index")) {
                $voucherFile = $request->file("voucher.$index");
                $voucherName = time() . '_' . uniqid() . '.' . $voucherFile->getClientOriginalExtension();
                $voucherFile->storeAs('public/vouchers', $voucherName);
            }

            Costdetail::create([
                'cost_id' => $cost->id,
                'service_id' => $serviceId,
                'amount' => $request->amount[$index],
                'memo_upload' => $voucherName, // nullable field
            ]);
        }

        return redirect()->route('costs.index')->with('success', 'Costs added successfully.');
    }

    public function show($id)
    {
        // Logic to display a specific cost
        $cost = Cost::with('costDetails')->findOrFail($id);
        return view('costs.show', compact('cost'));
    }

    public function edit($id)
    {
        // Logic to show the form for editing a specific cost
        $cost = Cost::with('costDetails')->findOrFail($id);
        $services = Service::all(); // Fetch all services for the dropdown
        return view('costs.edit', compact('cost', 'services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'service_id' => 'required|array',
            'service_id.*' => 'required|exists:services,id',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|min:0',
            'voucher' => 'nullable|array',
            'voucher.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Find the cost record
        $cost = Cost::findOrFail($id);
        $cost->date = $request->date;
        $cost->save();

        // Update or create cost details
        foreach ($request->service_id as $index => $serviceId) {
            $voucherName = null;

            // Check if a file is uploaded for this index
            if ($request->hasFile("voucher.$index")) {
                $voucherFile = $request->file("voucher.$index");
                $voucherName = time() . '_' . uniqid() . '.' . $voucherFile->getClientOriginalExtension();
                $voucherFile->storeAs('public/vouchers', $voucherName);
            }

            // Update or create the cost detail
            Costdetail::updateOrCreate(
                ['cost_id' => $cost->id, 'service_id' => $serviceId],
                ['amount' => $request->amount[$index], 'memo_upload' => $voucherName]
            );
        }

        return redirect()->route('costs.index')->with('success', 'Costs updated successfully.');
    }
    public function destroy($id)
    {
        // Logic to delete a specific cost
        $cost = Cost::findOrFail($id);
        $cost->costDetails()->delete(); // Delete associated cost details
        $cost->delete(); // Delete the cost record

        return redirect()->route('costs.index')->with('success', 'Cost deleted successfully.');
    }




}
