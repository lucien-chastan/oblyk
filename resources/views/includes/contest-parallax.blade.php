<div class="parallax-container contest-parallax">
    <div class="text-center">
        <h1 class="loved-king-font white-text">{{ $contest->name() }}</h1><br>
        <p class="white-text">{{ $contest->period() }}</p>
    </div>
    <div class="parallax">
        <img class="img-contest-parallax" src="{{ $contest->cover() }}" alt="{{ $contest->name() }}">
    </div>
</div>