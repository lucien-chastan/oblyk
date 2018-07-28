<li>
    <div class="collapsible-header @if($isFirst) active @endif"><i class="material-icons">account_circle</i>@choice('home.new-climber', count($activity['climbers']))</div>
    <div class="collapsible-body">
        <div class="row">
            <div>
                @foreach($activity['climbers'] as $user)
                    <div class="col s12 m6 l4 blue-border-activity-part">
                        <img class="left circle" src="{{ file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg' }}">
                        <a href="{{ $user->url() }}">
                            {{ $user->name }}
                        </a><br>
                        <span class="grey-text">
                            @lang('elements/sex.sex_' . ($user->sex ?? 0)),
                            {{ $user->birth != 0 ? trans_choice('elements/old.old', date('Y') - $user->birth) : trans_choice('elements/old.old',0) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>