@extends('layouts.app')
@section('content')
    <x-breadcumb page="Home">
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary">Settings</button>
            <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                    href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                    link</a>
            </div>
        </div>
    </x-breadcumb>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon-2 bg-gradient-info text-white">
                            <ion-icon name="bag-handle-sharp"></ion-icon>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                        </div>
                    </div>
                    <h5 class="my-3">Total Devices</h5>
                    <div class="progress mt-1" style="height: 5px;">
                        <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%">
                        </div>
                    </div>
                    <p class="mb-0 mt-2">48,256<span class="float-end text-danger">-2.8%</span></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon-2 bg-gradient-danger text-white">
                            <ion-icon name="card-sharp"></ion-icon>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                        </div>
                    </div>
                    <h5 class="my-3">All Message Sent</h5>
                    <div class="progress mt-1" style="height: 5px;">
                        <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 65%">
                        </div>
                    </div>
                    <p class="mb-0 mt-2">$98,246<span class="float-end text-success">+5.9%</span></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="widget-icon-2 bg-gradient-purple text-white">
                            <ion-icon name="people-sharp"></ion-icon>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                        </div>
                    </div>
                    <h5 class="my-3">Users</h5>
                    <div class="progress mt-1" style="height: 5px;">
                        <div class="progress-bar bg-gradient-purple" role="progressbar" style="width: 65%"></div>
                    </div>
                    <p class="mb-0 mt-2">87,532,16<span class="float-end text-success">+8.5%</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('chart-dashboard') --}}
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0"></h6>
                <div class="fs-5 ms-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                        Add Device
                    </button>
                </div>
                <x-modal-form route="{{ route('whatsapp.store') }}" title="Add Device">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <x-input-basic label="Whatsapp Number" name="number" id="whatsapp"
                                placeholder="Input Your Whatsapp With Country Code and Withot +" />
                        </div>
                        <div class="col-12">
                            <x-input-basic label="Webhook Url" name="webhook_url" id="webhook_url"
                                placeholder="Webhook URL" />
                        </div>
                    </div>
                </x-modal-form>
            </div>
            <div class="table-responsive mt-2">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#Number</th>
                            <th>Webhook Url</th>
                            <th>Message Sent</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($whatsapps as $item)
                            <tr>
                                <td>{{ $item->number }}</td>
                                <td>
                                    <x-input-basic name="webhook_url" id="webhook-{{ $item->id }}"
                                        placeholder="Webhook URL" value="{{ $item->webhook_url }}" />
                                </td>
                                <td>{{ $item->message_sent->count() }}</td>
                                <td>
                                    <span class="badge alert-{{ $item->status == true ? 'sucess' : 'danger' }}">
                                        @if ($item->status == true)
                                            Connected
                                        @else
                                            Disconnected
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('whatsapp.scan', $item->number) }}" class="text-primary"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                            data-bs-original-title="Scan" aria-label="Views">
                                            <ion-icon name="qr-code-sharp"></ion-icon>
                                        </a>
                                        <x-table-button :view="false" :edit="false" :delete="true"
                                            :params="$item" route="{{ route('whatsapp.destroy', $item->id) }}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
