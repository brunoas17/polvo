<div class="form-group {{ $errors->has('id_pedido') ? 'has-error' : ''}}">
    <label for="id_pedido" class="col-md-4 control-label">{{ 'Id Pedido' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="id_pedido" type="number" id="id_pedido" value="{{ $pedidoproduto->id_pedido or ''}}" >
        {!! $errors->first('id_pedido', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('id_produto') ? 'has-error' : ''}}">
    <label for="id_produto" class="col-md-4 control-label">{{ 'Id Produto' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="id_produto" type="number" id="id_produto" value="{{ $pedidoproduto->id_produto or ''}}" >
        {!! $errors->first('id_produto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
