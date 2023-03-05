<table class="table table-auto">
    <thead>
    <tr>
        <th>ID</th>
        <th>Customer ID</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($scan->customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->customer_id}}</td>
            <td>{{$customer->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

