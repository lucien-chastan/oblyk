@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div id="insert-posts-zone">
        <div class="col s12">
            <div class="card-panel" id="zone-post-{{$post->id}}" >
                @include('pages.posts.onePost')
            </div>
        </div>
    </div>
</div>
