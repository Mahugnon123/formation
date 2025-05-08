<hr>
<div id="line1">
    <div class="form-group row">
        <label for="intitule_1" class="col-md-2 col-form-label text-md-right">{{ __('Intitulé du chapitre') }}</label>
        <div class="col-md-8">
            <input id="intitule_1" type="text" class="form-control @error('intitule') is-invalid @enderror" name="intitule[]" value="{{ old('intitule') }}" autocomplete="intitule" autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label for="chapitre_description_1" class="col-md-2 col-form-label text-md-right">{{ __('Petite description') }}</label>
        <div class="col-md-8">
            <textarea id="chapitre_description_1" class="form-control @error('chapitre_description') is-invalid @enderror" name="chapitre_description[]" autocomplete="chapitre_description" autofocus rows="2" cols="60"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="video_1" class="col-md-2 col-form-label text-md-right">{{ __('Video répresentative du chapitre') }}</label>
        <div class="col-md-8">
            <input id="video_1" type="file" class="form-control @error('video') is-invalid @enderror" accept="video/mp4,video/x-m4v,video/*" name="video[]" placeholder="video représentative du chapitre">
            <span style="color: red; display: none;" class="text-center" id="message_1"></span>
        </div>
    </div>
</div>
<div id="newcard"></div>
<div class="form-group row">
    <div class="col-md-12 my-2 d-flex justify-content-center">
        <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewChapter()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
        <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deleteChapter()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
    </div>
</div>