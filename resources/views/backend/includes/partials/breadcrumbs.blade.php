@if($breadcrumbs)
    @if(isset($breadcrumbs[1]->title))
        <h2>{{$breadcrumbs[1]->title}}</h2>
    @else
        <h2>{{$breadcrumbs[0]->title}}</h2>
    @endif
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>

        @foreach($breadcrumbs as $breadcrumb)
            @if($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active"><strong>{{ $breadcrumb->title }}</strong></li>
            @endif
        @endforeach

        @yield('breadcrumb-links')
    </ol>
@endif
