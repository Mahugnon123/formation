@extends("auth.app")
@section("content")
              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                  <label for="nom" class="form-label">Nom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nom"
                    name="nom"
                    placeholder="Entrez votre nom"
                    autofocus
                  />
                </div>

                <div class="mb-3">
                  <label for="prenom" class="form-label">Prénom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="prenom"
                    name="prenom"
                    placeholder="Entrez votre Prénom"
                    autofocus
                  />
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Entrez votre email" />
                </div>

                <div class="mb-3">
                  <label for="prenom" class="form-label">Type de compte</label>
                  <select  class="form-control" name="role_id">
                  <option >
                    Choisissez le type de compte
                  </option>

                  <option value="1">
                    Apprenant
                  </option>
                  <option value="2">
                    Formateur
                  </option>
                  </select>

                </div>

                 <div class="mb-3">
                  <label for="birthday" class="form-label">Date de naissance</label>
                  <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Entrez votre email" />
                </div>
                
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Mot de passe</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>


              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Confirmer le Mot de passe</label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                  />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                 </div>
              </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      J'accepte 
                      <a href="javascript:void(0);">la politique de confidentialité et les conditions</a>
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary d-grid w-100">S'inscrire</button>
              </form>

              <p class="text-center">
                <span>Vous avez déjà un compte?</span>
                <a href="connexion">
                  <span>Connectez-vous</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

   @endsection