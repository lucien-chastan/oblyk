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
                    <a href="{{ route('topicPage',['topic_id'=>$topic->id,'topic_label'=>str_slug($topic->label)]) }}">{{ $topic->label }}</a><br>
                    <span class="grey-text">proposé par <a href="{{ route('userPage',['user_id'=>$topic->user->id,'user_label'=>str_slug($topic->user->name)]) }}">{{ $topic->user->name }}</a></span>
                </td>
                <td class="text-center"><img src="/img/forum-{{ $topic->category_id }}.svg" alt="" class="circle circle-40"></td>
                <td class="text-center">{{ $topic->views }}</td>
                <td class="text-center">{{ $topic->nb_post }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


