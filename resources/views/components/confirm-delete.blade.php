@props(['url', 'id', 'title' => 'Confirm Delete', 'description' => 'Are you sure you want to delete this item?'])

<a class="text-primary fs-5 ms-4" href="javascript:void(0)" class="{{ $attributes->get('class') }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{ $id }}">
    <i class="bi bi-trash"></i>
</a>

<div class="modal fade" id="deleteConfirmModal{{ $id }}" tabindex="-1" aria-labelledby="deleteConfirmModalLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel{{ $id }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $description }}
            </div>
            <div class="modal-footer">
                <a href="{{ $url }}" class="btn btn-primary">Delete</a>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>