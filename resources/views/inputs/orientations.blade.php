<div class="col s12 m{{ $col }}"><label>{{ $label }}</label>
    <input class="input-data" type="hidden" name="orientable_type" value="{{ $orientable_type }}">
    <input class="input-data" type="hidden" name="orientable_id" value="{{ $orientable_id }}">
    <input class="hidden_orientation_input input-data" id="hidden_north" type="hidden" name="north" value="{{ $value['north'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_east" type="hidden" name="east" value="{{ $value['east'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_south" type="hidden" name="south" value="{{ $value['south'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_west" type="hidden" name="west" value="{{ $value['west'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_north_east" type="hidden" name="north_east" value="{{ $value['north_east'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_north_west" type="hidden" name="north_west" value="{{ $value['north_west'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_south_east" type="hidden" name="south_east" value="{{ $value['south_east'] }}">
    <input class="hidden_orientation_input input-data" id="hidden_south_west" type="hidden" name="south_west" value="{{ $value['south_west'] }}">

    <div class="text-center orientations-input">
        <svg version="1.1" viewBox="0 0 100.61393 100.61393" height="28.395487mm" width="28.395487mm">
            <g transform="translate(-299.43062,-288.93568)">
                <path onclick="switchOrientation('hidden_north');" style="fill-rule:evenodd;stroke:none" d="m 349.73758,288.93568 -11.20135,39.10561 11.20135,11.20135 0,-42.84708 9.54034,33.30673 1.66102,-1.661 z"></path>
                <path onclick="switchOrientation('hidden_east');" style="fill-rule:evenodd;stroke:none" d="m 400.04455,339.24264 -39.10561,-11.20135 -11.20136,11.20135 42.84709,0 -33.30672,9.54034 1.66099,1.66104 z"></path>
                <path onclick="switchOrientation('hidden_south');" style="fill-rule:evenodd;stroke:none" d="m 349.73758,389.54961 11.20136,-39.10561 -11.20136,-11.20136 0,42.84708 -9.54033,-33.30671 -1.66102,1.66099 z"></path>
                <path onclick="switchOrientation('hidden_west');" style="fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 338.53623,328.04129 -39.10561,11.20135 39.10561,11.20136 11.20135,-11.20136 -42.84704,0 33.30671,-9.54033 z"></path>
                <path onclick="switchOrientation('hidden_north_east');" style="fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 368.72625,330.27188 10.44405,-20.46195 -20.46194,10.44406 2.23058,7.7873 z"></path>
                <path onclick="switchOrientation('hidden_north_west');" style="fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 340.76682,320.25398 -20.46195,-10.44405 10.44405,20.46195 7.78731,-2.23059 z"></path>
                <path onclick="switchOrientation('hidden_south_east');" style="fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 358.70836,358.23133 20.46194,10.44403 -10.44405,-20.46194 -7.78731,2.23058 z"></path>
                <path onclick="switchOrientation('hidden_south_west');" style="fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 330.74892,348.21342 -10.44405,20.46194 20.46195,-10.44405 -2.23059,-7.78731 z"></path>
            </g>
        </svg>
    </div>
</div>