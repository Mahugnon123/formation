@extends("Admin.app")
@section("content")
@if (session()->has('message'))


<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Alerte</strong>
    <small>A l'instant</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
  {{session()->get('message')}}  </div>
</div>
@endif

<?php
$i=0;
?>
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

              <!-- Basic Layout -->
              <div class="row">
                <div class="d-lg-flex d-md-block d-sm-block">
                  <div class="col-xl">
                    <div class="card mb-4 m-2">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Categorie</h5>
                        <small class="text-muted float-end">creer une categorie</small>
                      </div>
                      <div class="card-body">
                        <form action="/creer-categorie" method="post"></form>
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Nom</label>
                            <input type="text" class="form-control" name="nom" id="basic-default-fullname" placeholder="Informatique"/>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Description</label>
                            <textarea
                              id="basic-default-message"
                              class="form-control"
                              name="description"
                              placeholder="Que veut dire cette categorie ?"
                            ></textarea>
                          </div>
                          
                        
                          <button type="submit" class="btn btn-primary">Creer</button>
                        </form>
                      </div>
                    </div>
                  </div>

                <div class="col-xl">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group">
                        @foreach($categories as $categorie)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$categorie->nom}}
                            <div>
                              <button  data-bs-toggle="modal"
                                        data-bs-target="#{{$i}}">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                              </button>
                                
                              <button data-bs-toggle="modal"
                                        data-bs-target="#delete{{$i}}">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                              </button>
                                    
                            </div>
                                                  
                        </li>
                        <div
                          class="modal fade"
                          id="{{$i}}"
                          aria-labelledby="Updatemodal{{$i}}"
                          tabindex="-1"
                          aria-hidden="true"
                        >
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="Updatemodal{{$i}}">Categorie</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <form action="modifier-categorie" method="post">
                                  <input type="text" value="{{$categorie->nom}}" required="required">
                                  <textarea name="description" id="" cols="30" rows="10" value="{{$categorie->description}}"></textarea>
                              </div>
                              <div class="modal-footer">
                                <button
                                  type="submit"
                                  class="btn btn-primary"
                                  data-bs-dismiss="modal"
                                >
                                  Modifier
                                </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div
                          class="modal fade"
                          id="delete{{$i}}"
                          aria-labelledby="deleteModal{{$i}}"
                          tabindex="-1"
                          aria-hidden="true"
                        >
                         <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModal{{$i}}">Categorie</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer cette categorie ?</p>
                              </div>
                              <div class="modal-footer">
                                <button
                                  class="btn btn-primary"
                                  data-bs-dismiss="modal"
                                >
                                <a href="/delete-categorie/{{$categorie->nom}}">Supprimer</a>
                                  
                                </button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @php($i++)

                        @endforeach
                    </div>
                </div>
              </div>

            </div>
            <!-- / Content -->

          </div>
        </div>
    </div>
@endsection