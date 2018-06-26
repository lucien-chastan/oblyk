@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        @foreach($sectors as $sector)
            <p class="para-sectors" onclick="getGymSector({{ $sector->id }}, '{{ $sector->label }}'); animationLoadSideNav()">
                <strong>{{ $sector->label }}</strong>
                <span class="badge">{{ $sector->routes_count }}</span>
            </p>
        @endforeach
    </div>
</div>