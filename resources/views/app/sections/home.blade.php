<div class="home home--title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="home__title"><b>Filmes</b> em alta</h1>
            </div>
        </div>
    </div>

    <div class="home__carousel owl-carousel" id="flixtv-hero">
        @foreach($nowPlaying as $movie)
            <div class="home__card">
                <a href="{{{ route('movie.show', $movie->id) }}}">
                    <img src="{{ movieImage($movie->image) }}" alt="">
                </a>
                <div>
                    <h2>{{ $movie->title }}</h2>
                    <ul>
                        @foreach($movie->genres as $genre)
                            @if($loop->index < 2)
                                <li>{{ $genre->name }}</li>
                            @endif
                        @endforeach
                        <li>{{ formartYear($movie->release_date) }}</li>
                    </ul>
                </div>
                <button class="home__add" data-movie-id="{{ $movie->id }}" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                <span class="home__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 9.1</span>
            </div>
        @endforeach
    </div>

    <button class="home__nav home__nav--prev" data-nav="#flixtv-hero" type="button"></button>
    <button class="home__nav home__nav--next" data-nav="#flixtv-hero" type="button"></button>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.home__add').on('click', function () {
                let movieId = $(this).data('movie-id');

                $.ajax({
                    url: "{{ route('favorite.store') }}",
                    type: 'POST',
                    data: {
                        movie_id: movieId,
                        _token: "{{ csrf_token() }}"  // Lembre-se de incluir o token CSRF
                    },
                    success: function (response) {
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
