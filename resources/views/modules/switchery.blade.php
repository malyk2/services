@push('css')
    <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>
    <script>
        $(function(){
            if ($(".js-switch")[0]) {
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function (html) {
                    var switchery = new Switchery(html, {
                        color: '#26B99A'
                    });
                });
            }
        });
    </script>
@endpush