@if(count($contracts) > 0)
    @foreach($contracts as $contract)
        <li class="list-group-item">
            <div class="flex-box space-between">
                <div class="flex-box">
                    <div class="badge-circle badge-active-green">
                        <i class="icon-description"></i>
                    </div>
                    <div class="paragraph-info">
                        <h3>{{ $contract->company->business_name }}</h3>
                        <p>{{ $contract->company->rfc }}</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('qore.contracts.edit', Hashids::encode($contract->id)) }}" class="btn btn-default btn-sm btn-round">Administrar</a>
                </div>
            </div>
        </li>
    @endforeach
@else
    <div class="list-group-item">
        <div class="alert alert-warning">
            <strong>Advertencia.</strong> Usted no tiene contratos registrados
        </div>
    </div>
@endif

        {{--   <div class="collection_options col-md-4">
               <a href="{{ route('qore.receivables.files.index', Hashids::encode($contract->id)) }}">
                   <i class="circle-green"></i>
                   <span>Archivos</span>
               </a>
               <a href="#" data-contract="{{ Hashids::encode($contract->id) }}" class="btn-delete">
                   <i class="circle-red"></i>
                   <span>Cancelar</span>
               </a>
           </div>

       </div>
       <div class="collection_footer row" id="details-contract-{{ Hashids::encode($contract->id) }}">
           @foreach ($contract->details->where('active', 1) as $detail)
               <div class="collection_footer_item row">
                   <div class="col-md-6">
                       $detail->service->name
                   </div>
                   <div class="col-md-3">
                       {{ '$ '.number_format($detail->contract_price, 2, '.', '') }}
                   </div>
                   <div class="col-md-3">
                       Facturar <span class="moment-span">{{ date("Y-m-d", strtotime($detail->billing_date." + ".$contract->dates->credit_days." days")) }}</span>
                   </div>
               </div>
           @endforeach
       </div> --}}
