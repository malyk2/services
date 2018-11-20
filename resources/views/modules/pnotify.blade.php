@push('css')
    <link href="{{ asset('vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.brighttheme.css') }}" rel="stylesheet">
    @endpush

@push('js')
    <script src="{{ asset('vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.confirm.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.history.js') }}"></script>
    <script>
        $(function(){
            @if(session('pnotify'))
                var title = "{{ session('pnotify.title', 'info') }}";
                var type = "{{ session('pnotify.type', 'info') }}"
                var text = "{{ session('pnotify.text', 'info') }}";
                new PNotify({
                    title: title,
                    text: text,
                    type: type,
                    styling: 'bootstrap3'
                });
            @endif
        });
    </script>
@endpush