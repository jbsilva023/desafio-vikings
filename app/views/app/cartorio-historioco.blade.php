<div class="panel table-rounded">
    <div class="table-responsive">
<table class="table table-responsive-lg table-hover mt-2 table-sm" id="cartorios">
    <thead class="table-dark">
    <tr>
        <th width="22%">Razão</th>
        <th width="12%">Documeto</th>
        <th width="10%">telefone</th>
        <th width="12%">E-mail</th>
        <th width="25%">Endereco</th>
        <th width="8%">Status</th>
        <th width="11%">Ações</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cartorios as $cartorio)
        <tr>
            <td>{{ $cartorio->razao }}</td>
            <td><span class="cpf_cnpj">{{ $cartorio->documento }}</span></td>
            <td><span class="phone">{{ $cartorio->telefone }}</span></td>
            <td>{{ $cartorio->email }}</td>
            <td>
                {{ $cartorio->endereco()->nome }}, {{ $cartorio->endereco()->bairro }},
                {{ $cartorio->endereco()->cidade }} - {{ $cartorio->endereco()->uf }}
                , <span class="cep">{{ $cartorio->endereco()->cep }}</span>
            </td>
            <td>{{ $cartorio->status ? 'Ativo' : 'Inativo' }}</td>
            <td>
                <a href="javascript:void(0)" class="btn btn-outline-primary" data-idcartorio="{{ $cartorio->id }}"
                   data-nome="{{ $cartorio->nome }}"
                   data-target="#update-cartorio" data-toggle="modal"><i
                            class="fas fa-edit"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger delete-cartorio"
                   data-idcartorio="{{ $cartorio->id }}"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7"></td>
        </tr>
    @endforelse
    </tbody>
</table>
    </div>
</div>
<div class="row">
    <div class="col">
                <span class="paginate-info">
                    Exibindo de <b>{{ $paginator->getCurrentPageFirstItem() }}</b> até
                    <b>{{ $paginator->getCurrentPageLastItem() }}</b> de
                    <b>{{ $paginator->getTotalItems() }}</b> registros.
                </span>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        {!! $paginator !!}
    </div>
</div>