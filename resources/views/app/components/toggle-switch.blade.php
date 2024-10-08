@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.switch_toggle', function () {
                let statusId = $(this).data('status-id');  // Obtém o ID único de cada gênero

                $.ajax({
                    url: "{{ route('admin.genre.toggleStatus') }}",
                    type: 'POST',
                    data: {
                        status_id: statusId,
                        _token: "{{ csrf_token() }}"  // Inclui o token CSRF
                    },
                    success: function (response) {
                        // Notificação de sucesso usando SweetAlert
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
                            icon: "success",
                            title: response.message
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            // Redireciona para a página de login
                            window.location.href = '/login';
                        }
                    }
                });
            });
        });
    </script>
@endpush
