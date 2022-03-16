@include('templates.header')
<div class="container-scroller">
    {{-- nav --}}
    @include('templates.nav')
    {{-- nav --}}

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            {{-- copyright --}}
            @include('templates.copyright')
            {{-- copyright --}}
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('templates.footer')
