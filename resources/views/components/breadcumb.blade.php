@props(['page'])
<div>
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page ?? '' }}</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{ $slot }}
        </div>
    </div>
    <!--end breadcrumb-->
</div>
