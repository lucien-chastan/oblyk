<div class="row">
    <div class="col s12 m6 l4">
        <h5 class="loved-king-font">@lang('pages/gym-schemes/global.chartNumberTitle')</h5>
        <table class="striped">
            <tbody>
                <tr>
                    <th>@lang('pages/gym-schemes/global.chartHeight')</th>
                    <td>{{ $sum_height }}m</td>
                </tr>
                <tr>
                    <th>@lang('pages/gym-schemes/global.chartCrossesCount')</th>
                    <td>{{ count($crosses) }}</td>
                </tr>
                <tr>
                    <th>@lang('pages/gym-schemes/global.chartMaxGrade')</th>
                    <td class="color-grade-{{ $max_grad }}">
                        {{ App\Route::valToGrad($max_grad, true) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col s12 m6 l8">
        <h5 class="loved-king-font">@lang('pages/gym-schemes/global.chartGradeTitle')</h5>
        <div>
            <canvas class="route-indoor-crosses-canvas" data-route="{{ route('indoorGradesChart') }}?gym={{ $gym->id }}" id="indoor-grade-crosses" width="100" height="250"></canvas>
        </div>
    </div>
    <div class="col s12">
        <h5 class="loved-king-font">@lang('pages/gym-schemes/global.chartTimeTitle')</h5>
        <div>
            <canvas class="route-indoor-crosses-canvas" data-route="{{ route('indoorTimeChart') }}?gym={{ $gym->id }}" id="indoor-grade-crosses" width="100" height="250"></canvas>
        </div>
    </div>
</div>