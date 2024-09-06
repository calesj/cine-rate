@push('scripts')
    <script>
        $(document).ready(function () {
            $('.card__add').on('click', function () {
                let movieId = $(this).data('movie-id');

                $.ajax({
                    url: "{{ route('favorite.store') }}",
                    type: 'POST',
                    data: {
                        movie_id: movieId,
                        _token: "{{ csrf_token() }}"  // Lembre-se de incluir o token CSRF
                    },
                    success: function (response) {
                        // Muda a cor do ícone para indicar que foi favoritado (por exemplo, vermelho)
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
