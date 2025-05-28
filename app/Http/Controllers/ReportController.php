<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Costdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    //
    public function costs()
    {
        $fromDate = Session::get('from_date');
        $toDate = Session::get('to_date');

        $costDetailQuery = Costdetail::with('cost');

        // Filter by related cost.date
        if ($fromDate) {
            $costDetailQuery->whereHas('cost', function ($query) use ($fromDate) {
                $query->whereDate('date', '>=', $fromDate);
            });
        }

        if ($toDate) {
            $costDetailQuery->whereHas('cost', function ($query) use ($toDate) {
                $query->whereDate('date', '<=', $toDate);
            });
        }

        $costDetails = $costDetailQuery->get();

        return view('reports.costs', compact('costDetails'));
    }


    public function filterCosts(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        Session::put(['from_date' => $fromDate, 'to_date' => $toDate]);

        return redirect()->route('reports.costs');
    }

    public function resetCosts()
    {
        Session::forget(['from_date', 'to_date']);

        return redirect()->route('reports.costs');
    }
}
