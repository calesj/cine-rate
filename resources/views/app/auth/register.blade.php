@extends('app.auth.layouts.master')

@section('content')
    <!-- sign in -->
    <div class="sign section--full-bg" data-bg="{{ asset('assets/img/bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="{{ route('register') }}" class="sign__form" method="POST">
                            @csrf
                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('assets/img/logo.svg') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="name" value="{{ old('name') }}" placeholder="Nome">
                            </div>

                            <div class="sign__group">
                                <input type="text" class="sign__input" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" name="password" placeholder="Senha">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" name="password_confirmation" placeholder="Confirmar Senha">
                            </div>

                            <span class="sign__text">Ao se registrar, você concorda com a <a href="privacy.html">Política de Privacidade</a></span>


                            <button class="sign__btn" type="submit">Registrar</button>

                            <span class="sign__text">Já tem uma conta? <a href="{{ route('login') }}">Entrar!</a></span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sign in -->
@endsection

@include('app.components.swet-alert-error')

