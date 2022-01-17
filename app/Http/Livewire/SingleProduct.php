<?php

namespace App\Http\Livewire;

use App\Models\Product;

use App\Models\Variation;
use Livewire\Component;

class SingleProduct extends Component
{

    public Product $product;
    public $selected_variation;
    public $variation;

    public function render()
    {
        return view('livewire.single-product');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->variation = $product->variations()->orderBy('price')->first();
    }

    public function addToCard($id)
    {
        if (is_null($this->selected_variation)) return;

        $card = session()->get('card', []); // get card from session

        if (array_key_exists($id, $card)) {
            if (array_key_exists($this->selected_variation, $card[$id]['variations']))
                $card[$id]['variations'][$this->selected_variation]['count'] += 1;
            else
                $card[$id]['variations'][$this->selected_variation] = [
                    'variation' => Variation::findOrFail($this->selected_variation),
                    'count' => 1
                ];
        } else {
            $card[$id] = [
                'product' => Product::findOrFail($id),
            ];
            $card[$id]['variations'][$this->selected_variation] = [
                'variation' => Variation::findOrFail($this->selected_variation),
                'count' => 1
            ];
        }
        session()->put('card', $card); // update card in session

        $this->emit('updateCard');
    }

    public function updatedSelectedVariation($value)
    {
        $this->variation = Variation::findOrFail($value);
    }
}
