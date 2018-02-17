@if(isset($configuration))
    @if($configuration->email_support != "" || $configuration->email_sales != "" || $configuration->email_admon != "")
        <div class="panel panel-default">
            <div class="panel-heading border-primary">
                <span class="configuration-primary">Contacto con la Empresa</span>
            </div>
            <ul class="list-group">
                @if($configuration->email_support != "")
                    <li class="list-group-item">
                        <div class="flex-box">
                            <div class="enterprise-sticker background-primary">
                                <i class="icon-headset_mic"></i>
                            </div>
                            <div>
                                <p class="without-margin">Soporte: {{ $configuration->contact_support }}</p>
                                <p class="without-margin">{{ $configuration->email_support }}</p>
                            </div>
                        </div>
                    </li>
                @endif
                @if($configuration->email_sales != "")
                    <li class="list-group-item">
                        <div class="flex-box">
                            <div class="enterprise-sticker background-primary">
                                <i class="icon-shopping_cart"></i>
                            </div>
                            <div>
                                <p class="without-margin">Ventas: {{ $configuration->contact_sales }}</p>
                                <p class="without-margin">{{ $configuration->email_sales }}</p>
                            </div>
                        </div>
                    </li>
                @endif
                @if($configuration->email_admon != "")
                    <li class="list-group-item">
                        <div class="flex-box">
                            <div class="enterprise-sticker background-primary">
                                <i class="icon-business_center"></i>
                            </div>
                            <div>
                                <p class="without-margin">Administración: {{ $configuration->contact_admon }}</p>
                                <p class="without-margin">{{ $configuration->email_admon }}</p>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    @endif
@endif