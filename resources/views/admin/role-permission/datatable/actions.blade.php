@if($role->name !== 'Super Admin')
    <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">

        <a href="{{ route('admin.role.edit', $role->id) }}"
           class="btn btn-primary btn-sm"
           title="Edit">
            <i class="fas fa-edit"></i>
        </a>


        <form action="{{ route('admin.role.destroy', $role->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this Location?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="fas fa-trash-alt"></i>
            </button>

        </form>

    </div>
@else

@endif
