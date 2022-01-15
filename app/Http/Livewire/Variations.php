<?php

namespace App\Http\Livewire;

use App\Models\Variation;
use Livewire\Component;
use App\Models\Product;

class Variations extends Component
{

    public Product $product;
    public $variations = [];

    public function render()
    {
        return view('livewire.variations');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->variations = $product->variations->toArray();
    }

    public function add()
    {
        $this->variations[] = new Variation();
    }

    public function save()
    {
        foreach ($this->variations as &$variation) {
            $variation['id'] = $this->product->variations()->updateOrCreate(
                ['id' => $variation['id'] ?? ''],
                $variation
            )->id;
        }
    }
}
