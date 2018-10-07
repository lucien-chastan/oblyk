@extends('layouts.gallery', [
    'meta_title' => 'Photo ' . $element->label,
    'meta_description' => 'Photo ' . $photo->alt,
    'meta_img' => '/storage/photos/crags/1300/' . $photo->slug_label,
])
@section('content')

    <div class="image-area">
        <img id="gallery-image" title="@lang('pages/gallery/gallery.titleImage')" alt="{{ $photo->alt }}" class="adjusted gallery-image" src="/storage/photos/crags/1300/{{ $photo->slug_label }}">
    </div>

    @if($last)
        <a id="previous-photo" data-photo-url="{{ route('gallery', ['photo_id' => $last]) }}{{ $queryCollection }}" class="arrow arrow-left">
            <i class="material-icons">
                keyboard_arrow_left
            </i>
        </a>
    @endif

    @if($next)
        <a id="next-photo" data-photo-url="{{ route('gallery', ['photo_id' => $next]) }}{{ $queryCollection }}" class="arrow arrow-right">
            <i class="material-icons">
                keyboard_arrow_right
            </i>
        </a>
    @endif

    <i class="material-icons information-button button-collapse tooltipped"
       data-activates="information-slide"
       data-position="right"
       data-delay="50"
       data-tooltip="@lang('pages/gallery/gallery.toolTipInformation')"
    >
        info
    </i>

    @if($queryCollection)
        <i class="material-icons collection-button button-collapse tooltipped"
           data-activates="collection-slide"
           data-position="right"
           data-delay="50"
           data-tooltip="@lang('pages/gallery/gallery.toolTipCollection')"
        >
            collections
        </i>
    @endif

    @if($queryCollection)
        <div class="page-count" onclick="$('.button-collapse').last().sideNav('show');">
            {{ $current + 1 }} / {{ count($photos) }}
        </div>
    @endif

    <i class="material-icons close-button tooltipped"
       data-position="left"
       data-delay="50"
       data-tooltip="@lang('pages/gallery/gallery.toolTipClose')"
       id="close-gallery"
       onclick="closeGallery()"
    >
        clear
    </i>

    {{-- INFORMATION SIDNAVE --}}
    @include('pages.gallery.partials.information-side-nav')

    {{-- COLLECTION SIDNAVE --}}
    @include('pages.gallery.partials.collection-side-nav')

    {{-- LOADER --}}
    <div class="preloader-wrapper small active" id="preloader-gallery">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>

@endsection
