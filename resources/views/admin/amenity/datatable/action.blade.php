<div class="d-flex justify-content-center align-items-center" style="gap: 8px;">

    <a href="{{ route('admin.categories.edit', $category->id) }}"
       class="btn btn-primary btn-sm"
       title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <a href="{{ route('admin.categories.show', $category->id) }}"
       class="btn btn-info btn-sm"
       title="View">
        <i class="fas fa-eye"></i>
    </a>

    <form action="{{ route('admin.categories.destroy', $category->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this category?')">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
            <i class="fas fa-trash-alt"></i>
        </button>

    </form>

</div>
