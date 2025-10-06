@props(['id'])

<form id="delete-form-{{ $id }}" action="{{ route('places.destroy', $id) }}" method="POST" class="inline">
    @csrf
    @method('DELETE')
    <button type="button" class="icon-btn delete btn-delete" id="btn-delete-{{ $id }}">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>

<!-- Modal específico para este botón -->
<div id="deleteModal-{{ $id }}" class="modal-delete hidden">
    <div class="modal-content">
        <h2>¿Eliminar elemento?</h2>
        <p>Esta acción no se puede deshacer. ¿Deseas continuar?</p>
        <div class="modal-buttons">
            <button class="cancel" id="cancel-{{ $id }}">Cancelar</button>
            <button class="confirm" id="confirm-{{ $id }}">Eliminar</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal-{{ $id }}');
    const btn = document.getElementById('btn-delete-{{ $id }}');
    const cancel = document.getElementById('cancel-{{ $id }}');
    const confirm = document.getElementById('confirm-{{ $id }}');

    btn.addEventListener('click', () => modal.classList.remove('hidden'));
    cancel.addEventListener('click', () => modal.classList.add('hidden'));
    confirm.addEventListener('click', () => document.getElementById('delete-form-{{ $id }}').submit());
});
</script>
