@extends('layouts.app')
@section('content')
    <x-breadcumb page="Scan Whatsapp" />
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Whatsapp Account {{ $whatsapp->number }}</h6>
            </div>
            <div class="row mt-5">
                <div class="col-6 text-center">
                    <div id="qrcode" class="mb-2"></div>
                    <button class="btn btn-danger" id="message" disabled>please scan with your whatsapp account</button>
                </div>
                <div class="col-6">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>
                                <span id="name"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Number</td>
                            <td>
                                <span id="number"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"
        integrity="sha512-NFUcDlm4V+a2sjPX7gREIXgCSFja9cHtKPOL1zj6QhnE0vcY695MODehqkaGYTLyL2wxe/wtr4Z49SvqXq12UQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // var socket = io('http://localhost:5000');
        // socket.on('connect', function() {
        //     console.log('connected');
        // });
        // socket.on('disconnect', function() {
        //     console.log('disconnected');
        // });
        // socket.on('message', function(data) {
        //     console.log(data);
        //     $('#name').text(data.name);
        //     $('#number').text(data.number);
        // });
        $.ajax({
            url: "{{ route('whatsapp.getqr') }}",
            type: 'post',
            data: {
                number: "{{ $whatsapp->number }}"
            },
            success: function(data) {
                $('#qrcode').qrcode({
                    width: 200,
                    height: 200,
                    text: `${data.qr}`
                });
                console.log(data);
                $('#name').text(data.name);
                $('#number').text(data.number);
                // $('#message').removeAttr('disabled');
            }
        });
    </script>
@endpush
