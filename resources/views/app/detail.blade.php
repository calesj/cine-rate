@extends('app.layouts.master')

@section('content')
    <div id="modal-delete2" class="zoom-anim-dialog modal mfp-hide">
        <h6 class="modal__title">Review delete</h6>

        <p class="modal__text">Are you sure to permanently delete this review?</p>

        <div class="modal__btns">
            <button class="modal__btn modal__btn--apply" type="button">Delete</button>
            <button class="modal__btn modal__btn--dismiss" type="button">Dismiss</button>
        </div>
    </div>
    <!-- details -->
    <section class="section section--head section--head-fixed section--gradient section--details-bg" style="padding-top: 20px !important;">
        <div class="section__bg" data-bg="{{ asset('assets/img/bg.jpg') }}"></div>
        <div class="container">
            <!-- article -->
            <div class="article">

                <div class="row">
                    <div class="col-12 col-xl-9">


                        <!-- article content -->
                        <div class="article__content">
                            <h1>{{ $movie->title }}</h1>

                            <ul class="list">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/>
                                    </svg> {{ $average }}
                                </li>
                                <li>{{ $movie->genres[0]->name }}</li>
                                <li>{{ formartYear($movie->release_date) }}</li>
                                <li>{{ $movie->runtime }} min</li>
                            </ul>

                            <p>{{ $movie->overview }}</p>
                            <div class="article__btns">
                                <iframe width="1024" height="315"
                                        src="https://www.youtube.com/embed/{{ $movie->trailer }}">
                                </iframe>

                            </div>

                            <br>
                            <!-- add .active class -->
                            <button class="article__favorites" data-movie-id="{{ $movie->id }}" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"></path>
                                </svg>
                                Adicionar aos favoritos
                            </button>

                        </div>
                        <!-- end article content -->
                    </div>

                    <div class="col-12 col-xl-8">
                        <!-- categories -->
                        <div class="categories">
                            <h3 class="categories__title">Genêros</h3>
                            @foreach($movie->genres as $genre)
                                <a href="{{ route('home', ['category' => $genre->slug]) }}" class="categories__item">{{ $genre->name }}</a>
                            @endforeach
                        </div>
                        <!-- end categories -->

                        <!-- share -->
                        <div class="share">
                            <h3 class="share__title">Share</h3>
                            <a href="#" class="share__link share__link--fb"><svg width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.56341 16.8197V8.65888H7.81615L8.11468 5.84663H5.56341L5.56724 4.43907C5.56724 3.70559 5.63693 3.31257 6.69042 3.31257H8.09873V0.5H5.84568C3.1394 0.5 2.18686 1.86425 2.18686 4.15848V5.84695H0.499939V8.6592H2.18686V16.8197H5.56341Z"/></svg> share</a>
                            <a href="#" class="share__link share__link--tw"><svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.55075 3.19219L7.58223 3.71122L7.05762 3.64767C5.14804 3.40404 3.47978 2.57782 2.06334 1.1902L1.37085 0.501686L1.19248 1.01013C0.814766 2.14353 1.05609 3.34048 1.843 4.14552C2.26269 4.5904 2.16826 4.65396 1.4443 4.38914C1.19248 4.3044 0.972149 4.24085 0.951164 4.27263C0.877719 4.34677 1.12953 5.31069 1.32888 5.69202C1.60168 6.22165 2.15777 6.74068 2.76631 7.04787L3.28043 7.2915L2.67188 7.30209C2.08432 7.30209 2.06334 7.31268 2.12629 7.53512C2.33613 8.22364 3.16502 8.95452 4.08833 9.2723L4.73884 9.49474L4.17227 9.8337C3.33289 10.321 2.34663 10.5964 1.36036 10.6175C0.888211 10.6281 0.5 10.6705 0.5 10.7023C0.5 10.8082 1.78005 11.4014 2.52499 11.6344C4.75983 12.3229 7.41435 12.0264 9.40787 10.8506C10.8243 10.0138 12.2408 8.35075 12.9018 6.74068C13.2585 5.88269 13.6152 4.315 13.6152 3.56293C13.6152 3.07567 13.6467 3.01212 14.2343 2.42953C14.5805 2.09056 14.9058 1.71983 14.9687 1.6139C15.0737 1.41264 15.0632 1.41264 14.5281 1.59272C13.6362 1.91049 13.5103 1.86812 13.951 1.39146C14.2762 1.0525 14.6645 0.438131 14.6645 0.258058C14.6645 0.22628 14.5071 0.279243 14.3287 0.374576C14.1398 0.480501 13.7202 0.639389 13.4054 0.734722L12.8388 0.914795L12.3247 0.565241C12.0414 0.374576 11.6427 0.162725 11.4329 0.0991699C10.8978 -0.0491255 10.0794 -0.0279404 9.59673 0.14154C8.2852 0.618204 7.45632 1.84694 7.55075 3.19219Z"/></svg> tweet</a>
                        </div>
                        <!-- end share -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <!-- comments and reviews -->
                        <div class="comments">
                            <!-- tabs nav -->
                            <ul class="nav nav-tabs comments__title comments__title--tabs" id="comments__tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
                                        <h4>Reviews</h4>
                                        <span>{{ $movie->reviews->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- end tabs nav -->

                            <!-- tabs -->
                            <div class="tab-content">

                                <!-- reviews -->
                                <div class="tab-pane fade show active" id="tab-2" role="tabpanel">
                                    <ul class="reviews__list">
                                        @foreach($reviews as $review)
                                            <li class="reviews__item">
                                                <div class="reviews__autor">
                                                    <img class="reviews__avatar" src="{{ $review->user->image ? asset('storage/' . $review->user->image) : asset('assets/img/avatar.svg') }}" alt="">
                                                    <span class="reviews__name">{{ $review->title }}</span>
                                                    <span class="reviews__time">{{ $review->user->name }} - {{ releaseDate($review->created_at) }} </span>
                                                    <span class="reviews__rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg>
                                                        {{ $review->rating }}
                                                        @auth
                                                            @if($review->user->id == auth()->user()->id)
                                                                <div style="margin-left: 20px">
                                                                <button class="btn_delete" data-review-id="{{ $review->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                        <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            @endif
                                                        @endauth

                                                    </span>
                                                </div>
                                                <p class="reviews__text">{{ $review->description }}</p>
                                                <div class="comments__actions">
                                                    <div class="comments__rate">
                                                        <form action="{{ route('review.like') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="like">
                                                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                                                            <button type="submit">{{ $review->likes_count }}<svg style="stroke: green" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 7.3273V14.6537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>
                                                        </form>
                                                        <form action="{{ route('review.like') }}" method="POST">
                                                            @csrf
                                                            <input id="status" type="hidden" name="status" value="dislike">
                                                            <input id="review-id" type="hidden" name="review_id" value="{{ $review->id }}">
                                                            <button type="submit"><svg style="stroke: red; margin-right: 8px" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>  {{ $review->dislikes_count }}</button>
                                                        </form>
                                                    </div>
                                                    <br>
                                                 </div>
                                            </li>
                                        @endforeach

                                    </ul>

                                    <div class="catalog__paginator-wrap catalog__paginator-wrap--comments">
                                        <span class="catalog__pages">{{ $reviews->currentPage() }} de {{ $reviews->lastPage() }}</span>

                                        <ul class="catalog__paginator">
                                            <!-- Link para a página anterior -->
                                            @if ($reviews->onFirstPage())
                                                <li class="disabled">
                                                    <a href="#">
                                                        <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.75 5.36475L13.1992 5.36475" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M5.771 10.1271L0.749878 5.36496L5.771 0.602051" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $reviews->previousPageUrl() }}">
                                                        <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.75 5.36475L13.1992 5.36475" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M5.771 10.1271L0.749878 5.36496L5.771 0.602051" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @endif

                                            <!-- Links para as páginas -->
                                            @foreach ($reviews->links()->elements[0] as $page => $url)
                                                @if ($page == $reviews->currentPage())
                                                    <li class="active"><a href="#">{{ $page }}</a></li>
                                                @else
                                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach

                                            <!-- Link para a próxima página -->
                                            @if ($reviews->hasMorePages())
                                                <li>
                                                    <a href="{{ $reviews->nextPageUrl() }}">
                                                        <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.1992 5.3645L0.75 5.3645" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M8.17822 0.602051L13.1993 5.36417L8.17822 10.1271" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="disabled">
                                                    <a href="#">
                                                        <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.1992 5.3645L0.75 5.3645" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M8.17822 0.602051L13.1993 5.36417L8.17822 10.1271" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <form action="{{ route('review.store') }}" class="reviews__form" method="POST">
                                        @csrf
                                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                        <div class="row">
                                            <div class="col-12 col-md-9 col-lg-10 col-xl-9">
                                                <div class="sign__group">
                                                    <input type="text" name="title" class="sign__input" placeholder="Título">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3 col-lg-2 col-xl-3">
                                                <div class="sign__group">
                                                    <select name="rating" id="select" class="sign__select">
                                                        <option value="10">10</option>
                                                        <option value="9">9</option>
                                                        <option value="8">8</option>
                                                        <option value="7">7</option>
                                                        <option value="6">6</option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="sign__group">
                                                    <textarea id="text2" name="description" class="sign__textarea" placeholder="Conteúdo"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="sign__btn">Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end reviews -->

                            </div>
                            <!-- end tabs -->
                        </div>
                        <!-- end comments and reviews -->
                    </div>

                    <div class="col-12 col-xl-4">
                        <div class="sidebar sidebar--mt">
                            <!-- subscribe -->
                            <div class="row">
                                <div class="col-12">
                                    <form action="#" class="subscribe">
                                        <div class="subscribe__img">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.64,9.74l-.29,1.73A1.55,1.55,0,0,0,14,13a1.46,1.46,0,0,0,1.58.09L17,12.28l1.44.79A1.46,1.46,0,0,0,20,13a1.55,1.55,0,0,0,.63-1.51l-.29-1.73,1.2-1.22a1.54,1.54,0,0,0-.85-2.6l-1.62-.24-.73-1.55a1.5,1.5,0,0,0-2.72,0l-.73,1.55-1.62.24a1.54,1.54,0,0,0-.85,2.6Zm1.83-2.13a1.51,1.51,0,0,0,1.14-.85L17,5.93l.39.83a1.55,1.55,0,0,0,1.14.86l1,.14-.73.74a1.57,1.57,0,0,0-.42,1.34l.16,1-.79-.43a1.48,1.48,0,0,0-1.44,0l-.79.43.16-1a1.54,1.54,0,0,0-.42-1.33l-.73-.75ZM21,15.26a1,1,0,0,0-1,1v3a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V9.67l5.88,5.88a2.94,2.94,0,0,0,2.1.88l.27,0a1,1,0,0,0,.91-1.08,1,1,0,0,0-1.09-.91.94.94,0,0,1-.77-.28L5.41,8.26H9a1,1,0,0,0,0-2H5a3,3,0,0,0-3,3v10a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3v-3A1,1,0,0,0,21,15.26Z"/></svg>
                                        </div>
                                        <h4 class="subscribe__title">Notifications</h4>
                                        <p class="subscribe__text">Subscribe to notifications about new episodes</p>
                                        <div class="sign__group">
                                            <input type="text" class="sign__input" placeholder="Email">
                                        </div>
                                        <button type="button" class="sign__btn">Send</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end subscribe -->

                            <!-- new items -->
                            <div class="row row--grid">
                                <div class="col-12">
                                    <h5 class="sidebar__title">Similares</h5>
                                </div>

                                @foreach($similiarMovies as $film)
                                    <div class="col-6 col-sm-4 col-md-3 col-xl-6">
                                        <div class="card">
                                            <a href="{{ route('movie.show', $film->id) }}" class="card__cover">
                                                <img src="{{ movieImage($film->image) }}" alt="">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 1C16.5228 1 21 5.47716 21 11C21 16.5228 16.5228 21 11 21C5.47716 21 1 16.5228 1 11C1 5.47716 5.47716 1 11 1Z" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0501 11.4669C13.3211 12.2529 11.3371 13.5829 10.3221 14.0099C10.1601 14.0779 9.74711 14.2219 9.65811 14.2239C9.46911 14.2299 9.28711 14.1239 9.19911 13.9539C9.16511 13.8879 9.06511 13.4569 9.03311 13.2649C8.93811 12.6809 8.88911 11.7739 8.89011 10.8619C8.88911 9.90489 8.94211 8.95489 9.04811 8.37689C9.07611 8.22089 9.15811 7.86189 9.18211 7.80389C9.22711 7.69589 9.30911 7.61089 9.40811 7.55789C9.48411 7.51689 9.57111 7.49489 9.65811 7.49789C9.74711 7.49989 10.1091 7.62689 10.2331 7.67589C11.2111 8.05589 13.2801 9.43389 14.0401 10.2439C14.1081 10.3169 14.2951 10.5129 14.3261 10.5529C14.3971 10.6429 14.4321 10.7519 14.4321 10.8619C14.4321 10.9639 14.4011 11.0679 14.3371 11.1549C14.3041 11.1999 14.1131 11.3999 14.0501 11.4669Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                            <button class="card__add" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2H8A3,3,0,0,0,5,5V21a1,1,0,0,0,.5.87,1,1,0,0,0,1,0L12,18.69l5.5,3.18A1,1,0,0,0,18,22a1,1,0,0,0,.5-.13A1,1,0,0,0,19,21V5A3,3,0,0,0,16,2Zm1,17.27-4.5-2.6a1,1,0,0,0-1,0L7,19.27V5A1,1,0,0,1,8,4h8a1,1,0,0,1,1,1Z"/></svg></button>
                                            <span class="card__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> 8.3</span>
                                            <h3 class="card__title"><a href="{{ route('movie.show', $film->id) }}">The Good Lord Bird</a></h3>
                                            <ul class="card__list">
                                                @foreach($film->genres as $genre)
                                                    <li>{{ $genre->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- end new items -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end article -->
        </div>
    </section>
    <!-- end details -->
@endsection

@include('app.components.review.delete-review')

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.article__favorites').on('click', function () {
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

@include('app.components.swet-alert-success')
