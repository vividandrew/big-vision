@extends("shared.template")
@section("pageheader", 'Payment Success')
@section("content")
    <h5>Payment was successful</h5>
    <div class="pt-5 pb-10 justify-center block">
        <a class="bg-red-700 hover:bg-red-600 rounded p-2" href="{{route('download.receipt', $id)}}">Download Receipt</a>
    </div>
@endsection
