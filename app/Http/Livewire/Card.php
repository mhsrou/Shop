<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $count = 0;

    protected $listeners = [
        'updateCard' => 'updateCount'
    ];

    public function render()
    {
        return view('livewire.card');
    }

    public function mount()
    {
        $card = session()->get('card', []);
        foreach ($card as $key => $value) {
            foreach ($value['variations'] as $key2 => $variation) {
                $this->count += $variation['count'];
            }
        }
    }

    public function updateCount()
    {
        $this->count = 0;
        $card = session()->get('card', []);
        foreach ($card as $key => $value) {
            foreach ($value['variations'] as $key2 => $variation) {
                $this->count += $variation['count'];
            }
        }
    }
}
