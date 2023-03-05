<div>
    <div>
        <x-primary-button wire:click="onScanStart">Start Scan</x-primary-button>
    </div>
    @if($scan)
        <table class=" table-auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>IBAN</th>
                <th>IP</th>
                <th>Fraud?</th>
                <th>Customer ID</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scan->customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->iban}}</td>
                    <td>{{$customer->ip_address}}</td>
                    <td>{{$customer->is_fraud}}</td>
                    <td>{{$customer->customer_id}}</td>
                    <td>{{$customer->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

</div>

