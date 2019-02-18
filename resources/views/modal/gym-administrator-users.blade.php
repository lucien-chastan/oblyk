<table>
    <tbody>
    @foreach($users as $user)
    <tr class="highlight">
        <td width="10"><img class="circle" height="30" src="{{ file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg' }}"></td>
        <td>
            <a onclick="addTeamMember({{ $user->id }})">
                {{ $user->name }}
            </a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
