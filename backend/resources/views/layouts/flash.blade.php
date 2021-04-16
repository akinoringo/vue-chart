@if (session('flash_message'))
    <div class="flash_message alert-{{session('color')}} text-center py-3 my-0 mb30">
        {{ session('flash_message') }}
    </div>
@endif