<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $purchase = $request->toArray();
    auth()->user()->purchases()->create([
        'total_count' => $purchase['total_count'],
        'total_payment' =>  $purchase['total_payment'],
    ]);
        session()->forget('card');

        return redirect()->route('profile.index')
            ->with('successful purchase', 'your purchase successfully registered');
    }
}
