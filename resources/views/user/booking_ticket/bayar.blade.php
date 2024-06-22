@extends('layouts.app2')
<div class="d-flex justify-content-center">
    <div class="card">
        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
            Anda akan melakukan pembelian produk <strong></strong> dengan harga
            <strong>Rp</strong>
            <button type="button" class="btn btn-primary mt-3" id="pay-button">
                Bayar Sekarang
            </button>
        </div>
    </div>
</div>


@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
