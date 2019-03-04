@php($indoorProjectCrosses = [])
<div class="liste-tick-ticklist">
    @foreach($inCrosses as $cross)
        @if($cross->status_id != 1)
            <p class="no-margin">
                <img alt="" src="/img/gym-type-{{ $cross->type }}.png" height="10">
                <i title="Prises" class="material-icons" style="{{ $cross->color_style() }}; margin-right: 0; vertical-align: bottom;">bubble_chart</i>
                <strong>
                    <span class="color-grade-{{ $cross->grade_val }}">{{ $cross->grade }}{{ $cross->sub_grade }}</span>
                    {{ $cross->label }}
                </strong>
                <span class="grey-text">@lang('elements/statuses.status_' . $cross->status_id), le {{ $cross->release_at->format('d M Y') }}</span>
            </p>
        @else
            @php($indoorProjectCrosses[] = $cross)
        @endif
    @endforeach

    @if(count($indoorProjectCrosses) > 0)
        <p class="grey-text ss-title-crosses-project-list">@choice('pages/profile/crosses.projectFigures', count($indoorProjectCrosses))</p>
        <div class="ss-list-project-crosses">
            @foreach($indoor['crosses'] as $cross)
                <p class="no-margin">
                    <img alt="" src="/img/gym-type-{{ $cross->type }}.png" height="10">
                    <i title="Prises" class="material-icons" style="{{ $cross->color_style() }}; margin-right: 0; vertical-align: bottom;">bubble_chart</i>
                    <strong>
                        <span class="color-grade-{{ $cross->grade_val }}">{{ $cross->grade }}{{ $cross->sub_grade }}</span>
                    </strong>
                    <span class="grey-text">{{ $cross->status_id }}, le {{ $cross->release_at->format('d M Y') }}</span>
                </p>
            @endforeach
        </div>
    @endif
</div>