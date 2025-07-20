<div class="card shadow-sm p-4 mb-4" style="display: {{ old('type', $formation->type) == 'video' ? 'block' : 'none' }};">
    <h3 style="text-align: center;">Chapitres vidéo de la formation</h3>
    <br>
    @foreach($chapters as $index => $chapter)
        <div class="card mb-4 chapitre_video">
            <div class="card-header">
                <strong>Chapitre {{ $index + 1 }}</strong>
            </div>
            <div class="card-body">
                <!-- Titre du chapitre -->
                <div class="form-group row mb-3">
                    <label for="intitule_{{ $index }}" class="col-md-2 col-form-label text-md-right">Titre</label>
                    <div class="col-md-8">
                        <input type="text" id="intitule_{{ $index }}" name="intitule[]" class="form-control" value="{{ old('intitule.' . $index, $chapter['intitule'] ?? '') }}">
                    </div>
                </div>
                <!-- Description du chapitre -->
                <div class="form-group row mb-3">
                    <label for="chapitre_description_{{ $index }}" class="col-md-2 col-form-label text-md-right">Description</label>
                    <div class="col-md-8">
                        <textarea id="chapitre_description_{{ $index }}" name="chapitre_description[]" class="form-control">{{ old('chapitre_description.' . $index, $chapter['chapitre_description'] ?? '') }}</textarea>
                    </div>
                </div>
                <!-- Vidéo du chapitre -->
                <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label text-md-right">Vidéo</label>
                    <div class="col-md-8">
                        @if(!empty($chapter['video_url']))
                            <video src="{{ asset($chapter['video_url']) }}" controls style="width:100%;max-width:400px;"></video>
                            <br>
                            <small class="text-muted">
                                Vidéo actuelle : 
                                <strong>
                                    {{ basename($chapter['video_url']) }}
                                </strong>
                            </small>
                            <br>
                        @endif
                        <input type="file" name="video[]" class="form-control">
                        <!-- Champ caché pour garder l'ancienne vidéo si aucun fichier n'est uploadé -->
                        <input type="hidden" name="old_video_url[]" value="{{ $chapter['video_url'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div id="newchapitre_video"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewchapitre_video()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletechapitre_video()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
        </div>
    </div>
</div>

