<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default without-shadow">
            <div class="panel-body">
                {!! $chartCompaniesAnnual->render() !!}
            </div>
        </div>

        <div class="panel panel-default without-shadow">
            <div class="panel-body">
                <div class="col-md-4">
                    <div>
                        <p class="without-margin text-small">Actividad Anual</p>
                        <p class="without-margin text-large">{{ number_format($rate_anual_companies, 0) }}%</p>
                        <p class="without-margin text-small"><span class="secundary-element">Taza de Crecimiento</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <p class="without-margin text-small">Actividad Semestral</p>
                        <p class="without-margin text-large">{{ number_format($rate_biannual_companies, 0) }}%</p>
                        <p class="without-margin text-small"><span class="secundary-element">Taza de Crecimiento</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <p class="without-margin text-small">Actividad Trimestral</p>
                        <p class="without-margin text-large">{{ number_format($rate_quarterly_companies, 0) }}%</p>
                        <p class="without-margin text-small"><span class="secundary-element">Taza de Crecimiento</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel panel-default without-shadow">
            <div class="panel-body">
                {!! $chartCompaniesBiannual->render() !!}
            </div>
        </div>

        <div class="panel panel-default without-shadow">
            <div class="panel-body">
                {!! $chartCompaniesQuarterly->render() !!}
            </div>
        </div>
    </div>

</div>