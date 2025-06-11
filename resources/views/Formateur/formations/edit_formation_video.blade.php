<div class="card shadow-sm p-4 mb-4" style="display: {{ old('type', $formation->type) == 'video' ? 'block' : 'none' }};">
    <h3 style="text-align: center;">Chapitres vidéo de la formation</h3>
    <br>
    <div id="chapitre_video1">
        @foreach($chapters as $index => $chapter)
            <div class="form-group row chapitre_video" id="chapitre_video{{ $index + 1 }}">
                <h4 class="col-md-12 text-center">Chapitre {{ $index + 1 }}</h4>
                <div class="form-group row">
                    <label for="intitule_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                    <div class="col-md-8">
                        <input id="intitule_{{ $index + 1 }}" type="text" class="form-control @error('intitule.' . $index) is-invalid @enderror" name="intitule[]" value="{{ old('intitule.' . $index, $chapter['intitule']) }}">
                        @error('intitule.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="chapitre_description_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-8">
                        <textarea id="chapitre_description_{{ $index + 1 }}" class="form-control @error('chapitre_description.' . $index) is-invalid @enderror" name="chapitre_description[]">{{ old('chapitre_description.' . $index, $chapter['chapitre_description']) }}</textarea>
                        @error('chapitre_description.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="video_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Vidéo') }}</label>
                    <div class="col-md-8">
                        <input id="video_{{ $index + 1 }}" type="file" class="form-control @error('video.' . $index) is-invalid @enderror" name="video[]" accept="video/*">
                        @if(isset($chapter['video_url']) && $chapter['video_url'])
                            <p>Actuel : <a href="{{ asset($chapter['video_url']) }}" target="_blank">Voir la vidéo</a></p>
                        @else
                            <p>Aucune vidéo actuellement associée.</p>
                        @endif
                        @error('video.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="newchapitre_video"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewchapitre_video()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletechapitre_video()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
        </div>
    </div>
</div>

