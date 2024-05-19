<a href="{{ route('admin.pages.cp.edit', $id) }}">
    <i class="fa-solid fa-pen-to-square" style="color: #74C0FC;"></i>
</a>
 ||
<form method="POST" action="{{ route('admin.pages.cp.destroy', $id) }}" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link p-0" onclick="return confirm('Are you sure you want to delete this item?')">
        <i class="fa-solid fa-trash" style="color: #ff2e2e;"></i>
    </button>
</form>
