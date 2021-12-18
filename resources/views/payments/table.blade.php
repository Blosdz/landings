<div class="table-responsive-sm">
    <table class="table table-striped" id="payments-table">
    <thead>
            <tr>
                <th>Usuario</th>
                <th>Mes</th>
                <th>Total</th>
                <th>Status</th>
                <th>Fecha de transaccion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user ? $payment->user->name: 'N/A'}}</td>
                <td>{{ $payment->month }}</td>
                <td>{{ $payment->total }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->date_transaction }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>