<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $card = session()->get('card', []);

        $my_card = [];
        $total_count = 0;
        $total_payment = 0;
        foreach ($card as $key => $value) {
            if (array_key_exists("variations", $value)) {
                foreach ($value['variations'] as $key2 => $variation) {
                    $total_count += $variation['count'];
                    $total_payment += $variation['variation']['price'] * $variation['count'];
                    $my_card[] = [
                        'variation' => $variation['variation'],
                        'count' => $variation['count'],
                        'total_price' => $variation['variation']['price'] * $variation['count'],
                    ];
                }
            }
        }
        $my_card[] = [
            'total_count' => $total_count,
            'total_payment' => $total_payment,
        ];
        return view('shop.card', compact('my_card'));
    }
}
