<div class="input-field col s12">
    @if($icon != '')
        <i class="oblyk-icon {{ $icon }} prefix"></i>
    @endif
    <select class="input-data" name="{{ $name }}">
        @foreach($generalCategories as $generalCategory)
            <optgroup label="@lang('elements/generalCategories.category_' . $generalCategory->id)">

                @foreach ($generalCategory->categories as $category)
                    @php($selected = ($category->id == $value) ? 'selected' : '')
                    <option data-icon="/img/forum-{{ $category->id }}.svg" class="circle left" {{ $selected }} value="{{ $category->id }}">
                        @lang('elements/Categories.label_' . $category->id)
                    </option>
                @endforeach

            </optgroup>
        @endforeach
    </select>
    <label>{{ $label }}</label>
</div>