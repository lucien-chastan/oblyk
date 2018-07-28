
{{--INFORMATION BRUTE SUR LA LIGNE--}}
<h5 onclick="collapseArea('sector-information-area', this)"><span>-</span> Information sur le secteur</h5>
<div id="sector-information-area">
    <table class="property-table bordered striped">
        <thead>
        <tr>
            <th width="100">Propriété</th>
            <th>Caractéristique</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="property-column">Nom : </td>
            <td>{{ $sector->label }}</td>
        </tr>
        <tr>
            <td class="property-column">Id : </td>
            <td>{{ $sector->id }}</td>
        </tr>
        <tr>
            <td class="property-column">Site : </td>
            <td>
                id : {{ $sector->crag_id }}<br>
                nom : <a href="{{ $sector->crag->url() }}">{{ $sector->crag->label }}</a>
            </td>
        </tr>
        <tr>
            <td class="property-column">Grimpeur : </td>
            <td>
                id : {{ $sector->user_id }}<br>
                nom : <a href="{{ $sector->user->url() }}">{{ $sector->user->name }}</a>
            </td>
        </tr>
        <tr>
            <td class="property-column">Supprimé le : </td>
            <td>
                {{ $sector->deleted_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Créé le : </td>
            <td>
                {{ $sector->created_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Modifié le : </td>
            <td>
                {{ $sector->updated_at }}
            </td>
        </tr>
        <tr>
            <td class="property-column">Action : </td>
            <td>
                <a href="{{ route('delete_sector', ['sector_id'=>$sector->id]) }}">supprimer</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>


{{--Descriptions--}}
<h5 onclick="collapseArea('sector-descriptions-area', this)"><span>-</span> Descriptions</h5>
<div id="sector-descriptions-area">
    @foreach($sector->descriptions as $description)
        <p>
            {{ $description->description }}<br>
            par : <a href="{{ $description->user->url() }}">{{ $description->user->name }}</a>
        </p>
    @endforeach
</div>

{{--Photo--}}
<h5 onclick="collapseArea('sector-photo-area', this)"><span>-</span> Photos</h5>
<div id="sector-photo-area">
    @foreach($sector->photos as $photo)
        <p>
            <a href="/storage/photos/crags/1300/{{ $photo->slug_label }}">{{ $photo->slug_label }}</a><br>
            par : <a href="{{ $photo->user->url() }}">{{ $photo->user->name }}</a>
        </p>
    @endforeach
</div>