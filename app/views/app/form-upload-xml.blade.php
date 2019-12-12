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
                        Importar Registros <div class="card-subtitle">Arquivo XML</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form name="importar-registros" method="post" action="/arquivos/importar/xml" class="form-horizontal">
                    <div class="form-group">
                        <input type="hidden" name="tipo_arquivo" value="xml">
                        <div class="col-sm-offset-2 col-sm-12">
                            <label class="file-upload btn btn-primary mt-2">
                                Upload XML <input type="file" name="arquivo" id="arquivo"/>
                            </label>
                            <input type="submit" class="btn btn-success" vlaue="enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/app/public/js/jquery.funcoes.file-upload.js"></script>
    <script src="/app/public/js/app/jquery.funcoes.importar.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.file-upload').file_upload();
        });
    </script>
@stop