<div>
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        Select a scan
    </label>
    <select id="scans" wire:model="scan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected >Select a scan</option>
        @foreach($scans as $scan)
        <option value={{$scan->id}}>{{$scan->id}}</option>
        @endforeach
    </select>

    @if($selectedScan)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th  scope="col" class="px-6 py-3">ID</th>
                    <th  scope="col" class="px-6 py-3">IBAN</th>
                    <th  scope="col" class="px-6 py-3">IP</th>
                    <th  scope="col" class="px-6 py-3">Fraud</th>
                    <th  scope="col" class="px-6 py-3">Customer ID</th>
                    <th  scope="col" class="px-6 py-3">Fraud Reason</th>
                    <th  scope="col" class="px-6 py-3">Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($selectedScan->customers as $customer)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 {{ $customer->is_fraud === 1 ? 'bg-yellow-300 dark:bg-red-700' : '' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$customer->id}}</th>
                        <td class="px-6 py-4">{{$customer->iban}}</td>
                        <td class="px-6 py-4">{{$customer->ip_address}}</td>
                        <td class="px-6 py-4">{{$customer->is_fraud === 1? "Fraud Activity" : "Normal Activity"}}</td>
                        <td class="px-6 py-4">{{$customer->customer_id}}</td>
                        <td class="px-6 py-4">{{$customer->fraud_reason}}</td>
                        <td class="px-6 py-4">{{$customer->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @endif

</div>
