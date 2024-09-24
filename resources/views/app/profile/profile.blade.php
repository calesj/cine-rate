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
                            <img src="img/avatar.svg" alt="">
                        </div>
                        <div class="profile__meta">
                            <h3>John Doe</h3>
                            <span>FlixTV ID: {{ $user->id }}</span>
                        </div>
                    </div>

                    <!-- tabs nav -->
                    <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('favorites') }}">Favoritos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.edit') }}">Perfil</a>
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

            <div class="tab-pane fade show active" id="tab-3" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="sign__wrap">
                            <div class="row">
                                <!-- details form -->
                                <div class="col-12 col-lg-6">
                                    <form action="{{ route('profile.update') }}" method="POST" class="sign__form sign__form--profile sign__form--first">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="sign__title">Profile details</h4>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="username">Nome</label>
                                                    <input id="username" type="text" name="name" class="sign__input" value="{{ $user->name }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="email">Email</label>
                                                    <input id="email" type="text" name="email" class="sign__input" value="{{ $user->email }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button class="sign__btn" type="submit">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end details form -->

                                <!-- password form -->
                                <div class="col-12 col-lg-6">
                                    <form action="{{ route('password.update') }}" method="POST" class="sign__form sign__form--profile">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="sign__title">Alterar Senha</h4>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="oldpass">Senha Atual</label>
                                                    <input id="oldpass" type="password" name="current_password" class="sign__input">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="newpass">Nova Senha</label>
                                                    <input id="newpass" type="password" name="password" class="sign__input">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                <div class="sign__group">
                                                    <label class="sign__label" for="confirmpass">Confirmar Nova Senha</label>
                                                    <input id="confirmpass" type="password" name="password_confirmation" class="sign__input">
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button class="sign__btn" type="submit">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end password form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content tabs -->
    </div>
</div>
@endsection

@include('app.components.swet-alert-success')
@include('app.components.swet-alert-error')
