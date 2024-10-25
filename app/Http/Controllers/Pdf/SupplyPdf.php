<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use App\Models\SupplyHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SupplyPdf extends Controller
{
    public function supplyList(Request $request)
    {
        $query = Supply::query()->with('categories');

        if ($request->keyword) {
            if ($request->keyword) {
                $query->whereAny(['description', 'id'], 'like', '%' . $request->keyword . '%');
            }
        }

        if ($request->category) {
            if ($request->category && is_array($request->category)) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->category);
                });
            }
        }
        $supplies = $query->get();
        $pdf = Pdf::loadView('pdf.supplies-list', [
            'supplies' => $supplies
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('supplies.pdf');
    }

    public function supplyHistory(Request $request)
    {
        $query = SupplyHistory::query()->with(['supply', 'supply.categories']);
        if ($request->name) {
            $query->whereHas('supply', function ($q) use ($request) {
                $q->where('supplies.description', $request->name);
            });
        }

        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        if ($request->category) {
            if ($request->category && is_array($request->category)) {
                $query->whereHas('supply.categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->category);
                });
            }
        }

        $supplies = $query->get();
        $pdf = Pdf::loadView('pdf.supply-histories-list', [
            'supplies' => $supplies,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('supplies-history.pdf');
    }
}
