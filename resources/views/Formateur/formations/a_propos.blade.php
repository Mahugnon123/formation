
<div class="form-group row">
    
    <label for="task" class="col-md-12 col-form-label text-md-center">{{ __('À propos du certificat à obtenir à la fin de la formation') }}</label>

  </div>


<div class="form-group row">
    <label for="a_propos" class="col-md-2 col-form-label text-md-right">{{ __('A propos de la formation') }}</label>
    <div class="col-md-8">
      <textarea id="formation_description" type="text"  class="form-control @error('a_propos') is-invalid @enderror"a_propos
        name="a_propos" value="{{ old('a_propos') }}" required autocomplete="a_propos" autofocus rows="2" cols="60"></textarea>
      @error('a_propos')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>


  <!-- <div class="form-group row">
  
    <div class="col-md-12">
      <textarea id="summernote" name="a_propos"></textarea>
      
    </div>

  </div>
 -->
  

