{{-- Modal global para mensajes --}}
<div id="modal-alert" style="display:none;">
    <div class="modal-backdrop"></div>
    <div class="modal-box">
        <div class="modal-icon" id="modal-icon">⚠️</div>
        <div class="modal-message" id="modal-message">Mensaje de validación</div>
        <button class="modal-close" id="modal-close">&times;</button>
    </div>
</div>

<script>
function showModal(type, message) {
    const modal = document.getElementById('modal-alert');
    const icon = document.getElementById('modal-icon');
    const msg = document.getElementById('modal-message');

    // Ícono según tipo
    if(type === 'success') icon.textContent = '✔️';
    else if(type === 'warning') icon.textContent = '⚠️';
    else icon.textContent = '❌';

    msg.textContent = message;
    modal.style.display = 'flex';
}

// Cerrar modal
document.getElementById('modal-close').addEventListener('click', () => {
    document.getElementById('modal-alert').style.display = 'none';
});

// Mostrar errores de Laravel
@foreach ($errors->all() as $error)
    showModal('error', '{{ $error }}');
@endforeach

// Mensajes de sesión (success o deleted)
@if (session('success'))
    showModal('success', '{{ session('success') }}');
@endif

@if (session('deleted'))
    showModal('warning', '{{ session('deleted') }}');
@endif
</script>

<style>
#modal-alert {
    position: fixed;
    top:0; left:0;
    width:100vw; height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    z-index: 9999;
}

.modal-backdrop {
    position: absolute;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
}

.modal-box {
    position: relative;
    background: #fff;
    border-radius: 1rem;
    padding: 2rem 3rem;
    max-width: 450px;
    width: 90%;
    text-align:center;
    z-index: 10;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.modal-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.modal-message {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
}

.modal-close {
    background: #f5f5f5;
    border:none;
    padding:0.5rem 1rem;
    font-size:1.2rem;
    border-radius:0.5rem;
    cursor:pointer;
}

.modal-close:hover {
    background:#e0e0e0;
}
</style>
