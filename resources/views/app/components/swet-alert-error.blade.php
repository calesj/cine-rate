@if ($errors->any() || $errors->updatePassword->any())
    @push('scripts')
        <script>
            Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                background: '#2e2e2e', // Personalização adicional (opcional)
                color: '#fff',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ $errors->first() }}"
            });
        </script>
    @endpush
@endif
