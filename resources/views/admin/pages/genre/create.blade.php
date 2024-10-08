@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Categoria</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                            <li class="breadcrumb-item active">Categoria</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card">

                    <div class="card-body p-4">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Nome</label>
                                            <input class="form-control" name="name" type="text"
                                                    id="example-text-input">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input class="form-control" name="email" type="text"
                                                    id="example-text-input">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Celular</label>
                                            <input class="form-control" name="phone" type="text"
                                                    id="example-text-input">
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                    class="btn btn-primary btn-rounded waves-effect waves-light">Salvar
                                                alterações
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Endereço</label>
                                            <input class="form-control" name="address" type="text"
                                                   id="example-text-input">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Imagem de Categoria</label>
                                            <input class="form-control" name="photo" type="file"
                                                   id="image">
                                        </div>
                                        <div class="mb-3">
                                            <img id="show-image"
                                                 src="{{ url('upload/no_image.jpg') }}"
                                                 alt="" class="rounded-circle p-1 bg-primary" width="110">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->

                <!-- end tab content -->
            </div>

        </div>

        <!-- end row -->

    </div> <!-- container-fluid -->

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) { // QUANDO O INPUT HOUVER ALGUMA ALTERACAO
                const reader = new FileReader(); // GERA INSTACIA DO NEW FILEHEADER.
                reader.onload = function (e) { // ASSIM QUE O FILEREADER CARREGAR
                    $('#show-image').attr('src', e.target.result) // SOBRESCREVE A IMAGEM, COM A IMAGEM DO INPUT
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
@endpush
