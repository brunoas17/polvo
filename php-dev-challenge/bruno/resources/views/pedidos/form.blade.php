<div class="row">
    <div class="col-md-8">
        <div class="form-group col-md-12">
            <label for="produto" class="control-label">{{ 'Produto' }}</label>
            <div>
                <input class="form-control" name="produto" type="text" id="produto" placeholder="Insira o nome do produto...">
                <input type="hidden" name="produtos" id="produtos"> 
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Sku</th><th>Nome</th><th>preço</th>
                </tr>
            </thead>
            <tbody id="produtos-table">
                @if(count($pedidoProdutos) > 0)
                    @foreach($pedidoProdutos as $item)
                        <tr>
                            <td>{{ $item->sku }}</td><td>{{ $item->nome }}</td><td>{{ $item->preco }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('total') ? 'has-error' : ''}} col-md-12">
            <label for="total" class="control-label">{{ 'Total' }}</label>
            <div>
                <input class="form-control" name="total" type="decimal" id="total" value="{{ $pedido->total or ''}}" >
                {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <!-- <div class="form-group {{ $errors->has('data') ? 'has-error' : ''}} col-md-12">
            <label for="data" class="control-label">{{ 'Data' }}</label>
            <div>
                <input class="form-control" name="data" type="datetime-local" id="data" value="{{ $pedido->data or ''}}" >
                {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-4 pull-right">
                <input class="btn btn-primary pull-right" type="submit" value="{{ 'Salvar' }}">
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('js/plugins/typehead/bootstrap-typehead.min.js') }}"></script>
    <script src="{{ asset('js/pedidos.js') }}"></script>
@stop
