<div class="row">
    <div class="col-12 col-sm-6 col-md-6">
        <div class="card card-info">
            <div class="card-body">

                @foreach($languages as $langKey)

                    @component('dashboard::components.forms.form_groups.name', [
                        'langKey' => $langKey,
                        'currency' => $currency ?? null
                    ])
                    @endcomponent

                @endforeach

            </div>

        </div>
    </div>

</div>

