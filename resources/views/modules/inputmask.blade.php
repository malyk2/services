@push('js')
    <script src="{{ asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function(){
            app.init_InputMask();
        });
    </script>
@endpush