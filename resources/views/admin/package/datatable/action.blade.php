<div class="d-flex justify-content-center align-items-center">

    {{-- View --}}
    <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-info btn-sm mx-1" title="View Details">
        <i class="fas fa-eye"></i>
    </a>

    {{-- Edit --}}
    <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary btn-sm mx-1" title="Edit Package">
        <i class="fas fa-edit"></i>
    </a>

    {{-- Features Dropdown --}}
    <div class="dropdown mx-1">
        <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Package Features">
            <i class="fas fa-star"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item has-icon" href="{{ route('admin.packages.features', $package->id) }}">
                <i class="fas fa-list-ul text-warning"></i> Manage Features
            </a>
            <a class="dropdown-item has-icon" href="{{ route('admin.packages.features.create', $package->id) }}">
                <i class="fas fa-plus text-success"></i> Add New Feature
            </a>
        </div>
    </div>

    {{-- Delete --}}
    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="m-0 p-0 d-inline" onsubmit="return confirm('Are you sure you want to delete this package?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm mx-1" title="Delete Package">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>

</div>
