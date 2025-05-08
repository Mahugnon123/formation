<div class="card shadow-sm p-4 mb-4">
    <h3 class="text-center mb-4">À propos de la formation</h3>
    <div class="form-group row">
        <label for="a_propos" class="col-md-2 col-form-label text-md-right">{{ __('À propos') }}</label>
        <div class="col-md-8">
            <textarea id="a_propos" class="form-control @error('a_propos') is-invalid @enderror" name="a_propos" required>{{ old('a_propos', $formation->a_propos) }}</textarea>
            @error('a_propos')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>