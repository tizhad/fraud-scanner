<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Scan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ScanForm extends Component
{
    public Scan $scan;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.scan-form');
    }

    public function onScanStart()
    {
        $response = Http::get(config('custom.customer_api_url'));
        if (!$response->successful()) {
            return;
        }
        $this->scan = new Scan;
        $this->scan->save();

        foreach ($response->json()['customers'] as $customer) {
            $c = new Customer([
                'customer_id' => $customer['customerId'],
                'iban' => $customer['iban'],
                'phone_number' => $customer['phoneNumber'],
                'date_of_birth' => Carbon::createFromFormat('d-m-Y', $customer['dateOfBirth'])->format('Y-m-d'),
                'ip_address' => $customer['ipAddress'],
                'is_fraud' => true,
            ]);
            $this->scan->customers()->save($c);
        }

    }
}
