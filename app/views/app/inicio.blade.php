@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md">
                        Cartórios
                        <div class="card-subtitle"></div>
                    </div>
                    <div class="buttons col-md text-right">
                        <button type="button"
                                class="abrir-filtro btn btn-outline-secondary" {{($filtro?'style=display:none':'')}}>
                            <i class="fas fa-filter" aria-hidden="true"></i> Filtro
                        </button>
                        <button class="btn btn-outline-success" data-target="#create-cartorio" data-toggle="modal">
                            <i class="fas fa-plus"></i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-filter {{(isset($_POST)?'active':'')}}"
                    {{($filtro?'style=display:block':'style=display:none')}}>
                @include('app.form-filtro-cartorio')
            </div>

            <div class="card-body">
                <div class="preload"></div>
                @include('app.cartorio-historioco')
            </div>
        </div>
    </div>

    <div id="create-cartorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cartorio"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success save">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="update-cartorio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cartorio"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success save">Salvar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="/app/public/js/app/jquery.funcoes.cartorio.js"></script>
@stop
