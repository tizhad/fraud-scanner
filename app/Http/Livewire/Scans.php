<?php

namespace App\Http\Livewire;

use App\Models\Scan;
use Livewire\Component;

class Scans extends Component
{
    public $scans;
    public $scan_id = null;

    public $selectedScan = null;

    public function mount()
    {
        $this->scans = Scan::all();
    }

    public function updatedScanId()
    {
        $this->selectedScan = Scan::find($this->scan_id);
    }

    public function render()
    {
        return view('livewire.scans');
    }
}
