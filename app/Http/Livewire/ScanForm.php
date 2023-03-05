<?php

namespace App\Http\Livewire;

use App\Models\Scan;
use Livewire\Component;

class ScanForm extends Component
{
    public Scan $scan;

    public function mount()
    {
        $this->scan = Scan::first();
    }

    public function render()
    {
        return view('livewire.scan-form');
    }
}
