<div class="d-flex justify-content-center align-items-center" style="gap: 8px;">

    <a href="{{ route('admin.role-users.edit', $user->id) }}"
       class="btn btn-primary btn-sm"
       title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    @if($user->getRoleNames()->first() !== 'Super Admin')

        <form action="{{ route('admin.role-users.destroy', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this User?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                <i class="fas fa-trash-alt"></i>
            </button>

        </form>
    @endif

</div>

