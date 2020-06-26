<div>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>@lang('labels.frontend.user.profile.avatar')</th>
            
            @php  $file=Auth::user()->avatar_location; @endphp
            @if(Auth::user()->avatar_location!="" && file_exists($file))
                <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" height="90px" width="90px" /></td>
            @else
                <td><img src="{{ asset('app/public/avatars/no_avatar.png')}}" class="user-profile-image" height="70px" width="70px" /></td>
            @endif

        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ $logged_in_user->created_at->format('d-m-Y H:m:s') }}  ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ $logged_in_user->updated_at->format('d-m-Y H:m:s') }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>
