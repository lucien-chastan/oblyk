@extends('layouts.gallery', [
    'meta_title' => 'Photo ' . $element->label,
    'meta_description' => 'Photo ' . $photo->alt,
    'meta_img' => '/storage/photos/crags/1300/' . $photo->slug_label,
])
@section('content')

    <div class="image-and-control" id="image-gallery-area">
        <div class="image-area" id="slider-gallery">
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

        @if($queryCollection)
            <div class="page-count" onclick="openCollection();">
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

        <i class="material-icons information-button option-button button-collapse tooltipped"
           data-activates="information-slide"
           data-position="right"
           data-delay="50"
           data-tooltip="@lang('pages/gallery/gallery.toolTipInformation')"
        >
            info
        </i>

        <i class="material-icons zoom-button option-button tooltipped"
           onclick="galleryZoom()"
           data-position="right"
           id="zoom-button"
           data-delay="50"
           data-tooltip="@lang('pages/gallery/gallery.toolTipZoom')"
        >
            zoom_in
        </i>
    </div>

    <div class="phototheque" id="collection-gallery">
        @if(count($photos) > 0)
            <div class="collection-gallery">
                @foreach($photos as $collectionPhoto)
                    <a class="@if($collectionPhoto->id === $photo->id) current @endif" data-photo-url="{{ route('gallery', ['image_id' => $collectionPhoto->id]) }}{{ $queryCollection }}">
                        <img alt="{{ $collectionPhoto->alt }}" src="/storage/photos/crags/200/{{ $collectionPhoto->slug_label }}">
                    </a>
                @endforeach
            </div>
        @else
            <p class="grey-text">
                @lang('pages/gallery/gallery.noPhotoInCollection')
            </p>
        @endif

            <i class="material-icons close-button tooltipped"
               data-position="left"
               data-delay="50"
               data-tooltip="@lang('pages/gallery/gallery.toolTipCloseCollection')"
               onclick="openCollection()"
            >
                clear
            </i>
    </div>

    @if($queryCollection)
        <i class="material-icons collection-button option-button tooltipped"
           id="collection-button"
           onclick="openCollection()"
           data-position="right"
           data-delay="50"
           data-tooltip="@lang('pages/gallery/gallery.toolTipCollection')"
        >
            collections
        </i>
    @endif

    {{-- INFORMATION SIDNAVE --}}
    @include('pages.gallery.partials.information-side-nav')

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
