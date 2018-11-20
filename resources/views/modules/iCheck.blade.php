@push('css')
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function(){
            app.initICheck();
        });
    </script>
@endpush