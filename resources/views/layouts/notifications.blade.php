
<script>

    @if (session()->has('flash'))
        toastrSuccess("{{session('flash')}}");
    @endif

    @if(session()->has('message-error'))
        toastrError("{{ session()->get('message-error')}}");
        {{ session()->forget('message-error')}}
    @endif

    @if(session()->has('message-success'))
        toastrSuccess("{{ session()->get('message-success') }}");
        {{ session()->forget('message-success')}}
    @endif

    @if(session()->has('message-info'))
        toastrInfo("{{ session()->get('message-info') }}");
        {{ session()->forget('message-info')}}
    @endif

    @if(session()->has('message-warning'))
        toastrWarning("{{ session()->get('message-warning') }}");
        {{ session()->forget('message-warning')}}
    @endif
</script>
