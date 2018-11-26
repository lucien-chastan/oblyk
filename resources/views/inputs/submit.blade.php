<div class="col s12">
    <div class="row text-right" id="submit-btn">
        @if($cancelable)
            <button class="btn-flat waves-effect waves-light grey-text text-darken-2" onclick="closeModal();" type="button">Annuler</button>
        @endif
        <button {{ $onclick }} class="btn waves-effect {{ $color }} waves-light" type="submit" name="action">
            {{ $label }}
            <i class="material-icons right">send</i>
        </button>
    </div>
    <div class="row text-right div-submit-loader" id="submit-loader">
        <div class="submit-loader">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-' . $color . '-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>