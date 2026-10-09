@if($user->getRoleNames()->first() === 'Super Admin')
    <span class="badge badge-danger mt-1"> Super Admin </span>
@else
        <span class="badge badge-primary mt-1">{{$user->getRoleNames()->first()}}</span>
@endif
