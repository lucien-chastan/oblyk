@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Historique des modifications']) !!}

<table class="popup-version-table">
    <tbody>
    @foreach($versions as $version)
        <tr>
            <td title="{{ $version->created_at->format('d/m/Y H\hi') }}" class="grey-text date-cell-popup-version">
                {{ $version->created_at->format('d/m/y') }}
            </td>
            <td class="blue-border-version-popup"><div></div></td>
            <td>
                @foreach($version->changes as $key => $change)
                    <p class="no-margin"><strong>{{ $key }} :</strong> {{ $change }}</p>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>