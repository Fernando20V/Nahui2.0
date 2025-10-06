<div id="modal-alert" class="modal-hidden">
    <div class="modal-backdrop"></div>
    <div class="modal-box">
        <div class="modal-icon" id="modal-icon">⚠️</div>
        <div class="modal-message" id="modal-message">Mensaje de validación</div>
        <button class="modal-close" id="modal-close">&times;</button>
    </div>
</div>

@push('scripts')
<script>
(function(){
    const modal = document.getElementById('modal-alert');
    const icon = document.getElementById('modal-icon');
    const msg = document.getElementById('modal-message');
    const closeBtn = document.getElementById('modal-close');

    function showModal(type, message) {
        if(type === 'success') icon.textContent = '✔️';
        else if(type === 'warning') icon.textContent = '⚠️';
        else icon.textContent = '❌';

        msg.textContent = message;
        modal.classList.remove('modal-hidden');
    }

    closeBtn.addEventListener('click', () => modal.classList.add('modal-hidden'));

    // Exponer globalmente
    window.showModal = showModal;

    // Validaciones de Laravel
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            showModal('error', {!! json_encode($error) !!});
        @endforeach
    @endif

    // Mensajes de sesión
    @if (session('success'))
        showModal('success', {!! json_encode(session('success')) !!});
    @endif
    @if (session('deleted'))
        showModal('warning', {!! json_encode(session('deleted')) !!});
    @endif
})();
</script>
@endpush

@push('styles')
<style>
.modal-hidden { display:none; }
#modal-alert {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
}
.modal-box {
    position: relative;
    background: #fff;
    border-radius: 1rem;
    padding: 2rem 3rem;
    max-width: 450px;
    width: 90%;
    text-align: center;
    z-index: 10;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    animation: fadeIn 0.2s ease-in-out;
}
.modal-icon { font-size: 3rem; margin-bottom: 1rem; }
.modal-message { font-size: 1.2rem; margin-bottom: 1.5rem; }
.modal-close {
    background: #f5f5f5;
    border: none;
    padding: 0.5rem 1rem;
    font-size: 1.2rem;
    border-radius: 0.5rem;
    cursor: pointer;
}
.modal-close:hover { background:#e0e0e0; }

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush
