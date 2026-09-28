@if($role->name === 'Super Admin')
    <span class="badge badge-danger mt-1"> All Permissions </span>
@else
    @foreach($role->permissions as $permission)
        <span class="badge badge-primary mt-1">{{$permission->name}}</span>
    @endforeach

@endif
