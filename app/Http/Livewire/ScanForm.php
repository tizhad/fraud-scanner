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
        $customers = $response->json()['customers'];
        $result = $this->checkFraudulentActivity($customers);
        $customers = [];
        foreach ($result as $customer) {
            $customers[] = new Customer([
                'customer_id' => $customer['customerId'],
                'iban' => $customer['iban'],
                'date_of_birth' => Carbon::parse($customer['dateOfBirth'])->format('Y:m:d'),
                'phone_number' => $customer['phoneNumber'],
                'ip_address' => $customer['ipAddress'],
                'is_fraud' => $customer['isFraud'],
                'fraud_reason' => $customer['fraudReason'],
            ]);
        }
        $this->scan->customers()->saveMany($customers);
    }

    public function checkFraudulentActivity($customers): array
    {
        $result = [];
        $ibans = [];
        $ips = [];
        foreach ($customers as $customer) {
            $customerId = $customer['customerId'];
            $iban = $customer['iban'];
            $ip = $customer['ipAddress'];
            $dateOfBirth = $customer['dateOfBirth'];
            $phoneNumber = $customer['phoneNumber'];

            if (array_key_exists($iban, $ibans)) {
                $existingCustomerId = $ibans[$iban];
                $result[$existingCustomerId]['isFraud'] = true;
                $result[$existingCustomerId]['fraudReason'] = 'duplicate_iban';
                $customer['isFraud'] = true;
                $customer['fraudReason'] = 'duplicate_iban';
                $result[$customerId] = $customer;
                continue;
            }

            if (array_key_exists($ip, $ips)) {
                $existingCustomerId = $ips[$ip];
                $result[$existingCustomerId]['isFraud'] = true;
                $result[$existingCustomerId]['fraudReason'] = 'duplicate_ip';
                $customer['isFraud'] = true;
                $customer['fraudReason'] = 'duplicate_ip';
                $result[$customerId] = $customer;
                continue;
            }

            // check birthday
            if (Carbon::parse($dateOfBirth)->age < 18) {
                $customer['isFraud'] = true;
                $customer['fraudReason'] = 'underage';
                $result[$customerId] = $customer;
                continue;
            }

            if(!preg_match('/^\+31[0-9]+$/', $phoneNumber)) {
                $customer['isFraud'] = true;
                $customer['fraudReason'] = 'invalid_phone_number';
                $result[$customerId] = $customer;
                continue;
            }

            $ibans[$customer['iban']] = $customerId;
            $ips[$customer['ipAddress']] = $customerId;
            $customer['isFraud'] = false;
            $customer['fraudReason'] = null;
            $result[$customerId] = $customer;
        }
        return $result;
    }
}
