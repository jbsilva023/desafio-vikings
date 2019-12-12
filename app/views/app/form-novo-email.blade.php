@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="/app/public/css/file-upload.css"/>
@stop

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="preload"></div>
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        Enviar e-mail <div class="card-subtitle">cartórios</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form name="enviar-email" method="post" action="/enviar-email" class="form-horizontal">
                    <div class="erros">
                        <div class="message alert alert-danger" style="display: none"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="subject">Assunto: <span class="text-danger">*</span></label>
                        <input type="text" name="subject" id="subject" class="form-control required mb-2" value="">
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <label for="editor">Mensagem: <span class="text-danger">*</span></label>
                        <textarea name="mensagem" id="editor" class="required"></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error( error );
                                });
                        </script>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <label class="file-upload btn btn-primary mt-2">
                                Anexar <input type="file" name="arquivo" id="arquivo"/>
                            </label>
                        </div>
                    </div>
                    <div class="col mt-4">
                        <div class="form-group float-right">
                            <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit" class="btn btn-success">Enviar</button>
                                <button type="reset" class="btn btn-primary">Limpar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
    {{--<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>--}}
    <script src="/app/public/js/jquery.funcoes.file-upload.js"></script>
    <script src="/app/public/js/app/jquery.funcoes.cartorio.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.file-upload').file_upload();
        });
    </script>
@stop