<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th class="text-center">Catégorie</th>
            <th class="text-center">Vues</th>
            <th class="text-center">Posts</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topics as $topic)
            <tr>
                <td>
                    <a href="{{ $topic->url() }}">{{ $topic->label }}</a><br>
                    <span class="grey-text">proposé par <a href="{{ $topic->user->url() }}">{{ $topic->user->name }}</a></span>
                </td>
                <td class="text-center"><img src="/img/forum-{{ $topic->category_id }}.svg" alt="" class="circle circle-40"></td>
                <td class="text-center">{{ $topic->views }}</td>
                <td class="text-center">{{ $topic->nb_post }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


