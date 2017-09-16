@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>trans('modals/paperGuideBook.guidebookTitle'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'author', 'value'=>$dataModal['author'], 'label'=>trans('modals/paperGuideBook.author'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'editor', 'value'=>$dataModal['editor'], 'label'=>trans('modals/paperGuideBook.editor'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'editionYear', 'value'=>$dataModal['editionYear'], 'label'=>trans('modals/paperGuideBook.publishingYear'), 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'price', 'value'=>$dataModal['price'], 'label'=>trans('modals/paperGuideBook.price'), 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'page', 'value'=>$dataModal['page'], 'label'=>trans('modals/paperGuideBook.page'), 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'weight', 'value'=>$dataModal['weight'], 'label'=>trans('modals/paperGuideBook.weight'), 'type'=>'number']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
