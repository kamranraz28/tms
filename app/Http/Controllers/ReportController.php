<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Costdetail;
use App\Models\Payment;
use App\Models\Tenant;
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

    public function payments()
    {
        $month = Session::get('month', now()->format('Y-m'));
        $tenantId = Session::get('tenant_id');

        $query = Tenant::with([
            'payments' => function ($query) use ($month) {
                $query->where('payment_month', $month);
            },
            'tenantServices',
            'property'
        ])->where('status', 1);

        if ($tenantId) {
            $query->where('id', $tenantId);
        }

        $tenants = $query->get();

        return view('reports.payments', [
            'tenants' => $tenants,
            'currentMonth' => $month,
        ]);
    }



    public function filterPayments(Request $request)
    {
        $month = $request->input('month');
        $tenantId = $request->input('tenant_id');

        Session::put([
            'month' => $month,
            'tenant_id' => $tenantId,
        ]);

        return redirect()->route('reports.payments');
    }


    public function resetPayments()
    {
        Session::forget(['month', 'tenant_id']);
        return redirect()->route('reports.payments');
    }


    public function markPaid($tenantId, $month)
    {
        // You may want to validate $month format here
        Payment::Create(
            [
                'tenant_id' => $tenantId,
                'payment_month' => $month,
            ],
        );

        return redirect()->back()->with('success', 'Payment marked as paid.');
    }

    public function reverse($tenantId, $month)
    {
        // You may want to validate $month format here
        $payment = Payment::where('tenant_id', $tenantId)
            ->where('payment_month', $month)
            ->first();

        if ($payment) {
            $payment->delete();
            return redirect()->back()->with('success', 'Payment reversed successfully.');
        }

        return redirect()->back()->with('error', 'Payment not found.');
    }

}
