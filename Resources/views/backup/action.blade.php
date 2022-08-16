<div class="btn-group btn-group-sm">
    @can('backup-delete')
            <a href="{{ route('admin.backup.destroy', $id) }}" class="btn btn-danger confirm-delete">
                <i class="fas fa-trash"></i>
            </a>
    @endcan
</div>
