<div class="card shadow-sm p-4 mb-4" style="display: {{ old('type', $formation->type) == 'video' ? 'block' : 'none' }};">
    <h3 style="text-align: center;">Contenu vidéo — Parties et chapitres</h3>
    <br>
    <div id="parties_container_video"></div>

    <div class="form-group row">
        <div class="col-md-12 my-3 d-flex justify-content-center gap-2">
            <button type="button" class="btn btn-success btn-sm col-sm-3 col-10" onclick="addNewPartieVideo()">
                <ion-icon name="add-outline"></ion-icon> Nouvelle partie
            </button>
        </div>
    </div>
</div>

