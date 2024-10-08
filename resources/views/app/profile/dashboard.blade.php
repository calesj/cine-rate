@extends('app.layouts.master')

@section('content')



    <!-- profile -->
    <div class="catalog catalog--page" style="margin-top: 4%">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="profile">
                        <div class="profile__user">
                            <div class="profile__avatar">
                                <img src="{{ asset('storage/' . $user->image) }}" alt="">
                            </div>
                                <div class="profile__meta">
                                    <h3>{{ $user->name }}</h3>
                                </div>
                        </div>

                        <!-- tabs nav -->
                        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('dashboard') }}" role="tab" aria-controls="tab-1" aria-selected="true">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('favorites') }}" aria-controls="tab-2" aria-selected="false">Favoritos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}" aria-controls="tab-3" aria-selected="false">Perfil</a>
                            </li>
                        </ul>
                        <!-- end tabs nav -->

                        <button class="profile__logout" type="button">
                            <span>Sign out</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="row row--grid">
                        <!-- stats -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stats">
                                <span>Seus reviews</span>
                                <p><a href="#">{{ $reviews->count() }}</a></p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8,11a1,1,0,1,0,1,1A1,1,0,0,0,8,11Zm4,0a1,1,0,1,0,1,1A1,1,0,0,0,12,11Zm4,0a1,1,0,1,0,1,1A1,1,0,0,0,16,11ZM12,2A10,10,0,0,0,2,12a9.89,9.89,0,0,0,2.26,6.33l-2,2a1,1,0,0,0-.21,1.09A1,1,0,0,0,3,22h9A10,10,0,0,0,12,2Zm0,18H5.41l.93-.93a1,1,0,0,0,.3-.71,1,1,0,0,0-.3-.7A8,8,0,1,1,12,20Z"></path></svg>
                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- stats -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stats">
                                <span>Seus favoritos</span>
                                <p><a href="#">{{ $favorites }}</a></p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg>
                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- dashbox -->
                        <div class="col-12">
                            <div class="dashbox">
                                <div class="dashbox__title">
                                    <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,2a1,1,0,0,0-1,1V5H18V3a1,1,0,0,0-2,0V4H8V3A1,1,0,0,0,6,3V5H4V3A1,1,0,0,0,2,3V21a1,1,0,0,0,2,0V19H6v2a1,1,0,0,0,2,0V20h8v1a1,1,0,0,0,2,0V19h2v2a1,1,0,0,0,2,0V3A1,1,0,0,0,21,2ZM6,17H4V15H6Zm0-4H4V11H6ZM6,9H4V7H6Zm10,9H8V13h8Zm0-7H8V6h8Zm4,6H18V15h2Zm0-4H18V11h2Zm0-4H18V7h2Z"/></svg> Seus reviews</h3>

                                    <div class="dashbox__wrap">
                                        <a class="dashbox__refresh" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,11a1,1,0,0,0-1,1,8.05,8.05,0,1,1-2.22-5.5h-2.4a1,1,0,0,0,0,2h4.53a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4.77A10,10,0,1,0,22,12,1,1,0,0,0,21,11Z"></path></svg></a>
                                        <a class="dashbox__more" href="catalog.html">View All</a>
                                    </div>
                                </div>

                                <div class="dashbox__table-wrap dashbox__table-wrap--1">
                                    <table class="main__table main__table--dash">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Texto</th>
                                            <th>Filme</th>
                                            <th>Avaliação</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviews as $review)
                                            <tr>
                                                <td>
                                                    <div class="main__table-text"><a href="{{ route('movie.show', $review->movie->id) }}">{{ $review->title}}</a></div>
                                                </td>
                                                <td>
                                                    <div class="main__table-text"><a href="{{ route('movie.show', $review->movie->id) }}">{{ limitString($review->description, 5) }}</a></div>
                                                </td>
                                                <td>
                                                    <div class="main__table-text"><a href="{{ route('movie.show', $review->movie->id) }}">{{ $review->movie->title }}</a></div>
                                                </td>
                                                <td>
                                                    <div class="main__table-text main__table-text--rate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg> {{ number_format($review->rating, 1) }}</div>
                                                </td>
                                                <td>
                                                    <div class="main__table-text">
                                                    <button class="btn_delete" data-review-id="{{ $review->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"></path>
                                                        </svg>
                                                    </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end dashbox -->
                        <div class="row">
                            <div class="col-12">
                                <div class="catalog__paginator-wrap">
            <span class="catalog__pages">
                {{ $reviews->firstItem() }} - {{ $reviews->lastItem() }} de {{ $reviews->total() }}
            </span>
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
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <!-- end content tabs -->
        </div>
    </div>
    <!-- end profile -->
@endsection

@include('app.components.swet-alert-success')
@include('app.components.swet-alert-error')
@include('app.components.review.delete-review')
