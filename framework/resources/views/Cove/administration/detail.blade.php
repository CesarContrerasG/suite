
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Detalle</h4>
      </div>
      <?php $detail = \App\Cove\Detail::where('inv_item', $item)->first(); ?>
      @if(is_null($detail))
        {!! Form::open(['route' => 'cove.detail.store', 'method' => 'POST', 'files' => true, 'id' => 'form_detalle']) !!}
      @else
        {!! Form::model($detail, ['route' => ['cove.detail.update', $detail->pk_item], 'method' => 'PUT', 'class' => 'form', 'id' => 'form_detalle']) !!}  
      @endif
      <div class="modal-body">       
        <div class="row">
          {!! Form::hidden('inv_cove', $cove->pk_referencia) !!}
          {!! Form::hidden('inv_item', $item) !!}
          <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('inv_marca') ? ' has-error' : '' }}">
                {!! Form::label('inv_marca', 'Marca') !!}
                {!! Form::text('inv_marca', null, ['class' => 'form-control']) !!}
                @if ($errors->has('inv_marca'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inv_marca') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('inv_modelo') ? ' has-error' : '' }}">
                {!! Form::label('inv_modelo', 'Modelo') !!}
                {!! Form::text('inv_modelo', null, ['class' => 'form-control']) !!}
                @if ($errors->has('inv_modelo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inv_modelo') }}</strong>
                    </span>
                @endif
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('inv_submodelo') ? ' has-error' : '' }}">
                {!! Form::label('inv_submodelo', 'SubModelo') !!}
                {!! Form::text('inv_submodelo', null, ['class' => 'form-control']) !!}
                @if ($errors->has('inv_submodelo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inv_submodelo') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-purple{{ $errors->has('inv_noserie') ? ' has-error' : '' }}">
                {!! Form::label('inv_noserie', 'Serie') !!}
                {!! Form::text('inv_noserie', null, ['class' => 'form-control']) !!}
                @if ($errors->has('inv_noserie'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inv_noserie') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>  
      </div>
      <div class="modal-footer">        
        <button type="submit" class="btn btn-default btn-sm btn-round btn-round-success">Guardar</button> 
        <button type="button" class="btn btn-default btn-sm btn-round btn-round-cancel" data-dismiss="modal">Cerrar</button>           
      </div>
      {!! Form::close() !!}  
    </div>
  </div>