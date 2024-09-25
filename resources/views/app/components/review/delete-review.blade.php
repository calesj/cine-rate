@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn_delete').on('click', function () {
                let reviewId = $(this).data('review-id');

                Swal.fire({
                    title: "Você tem certeza?",
                    text: "Você não poderá reverter isso",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim, deletar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/review/${reviewId}/delete`,  // Defina a rota para a exclusão
                            type: 'DELETE',  // Use DELETE para excluir o item
                            data: {
                                _token: "{{ csrf_token() }}"  // Lembre-se de incluir o token CSRF
                            },
                            success: function (response) {
                                window.location.reload();
                            },
                            error: function(xhr) {
                                if (xhr.status === 401) {
                                    // Redireciona para a página de login
                                    window.location.href = '/login';
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
