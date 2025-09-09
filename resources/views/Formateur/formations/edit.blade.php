@extends("Formateur.app")
@section("content")

<style>
body {
    margin-top: 40px;
}
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
/* Fixed-size preview for chapter videos */
.video-preview-wrapper {
    width: 320px;
    height: 180px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    overflow: hidden;
    background: #000;
    display: none;
}
.video-preview-wrapper .video-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
/* Fullscreen should respect real aspect */
.video-preview:fullscreen, .video-preview-wrapper:fullscreen .video-preview {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: #000;
}
.video-preview:-webkit-full-screen, .video-preview-wrapper:-webkit-full-screen .video-preview {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: #000;
}
</style>

<div class="container my-5" style="min-height: 63vh">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step mb-4">
                            <a href="#step-1" type="button" class="btn btn-circle btn-default btn-primary">1</a>
                            <p class="fw-bold"><h5>Informations générales</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">2</a>
                            <p class="fw-bold"><h5>Contenu de la formation</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">3</a>
                            <p class="fw-bold"><h5>Compétence à acquérir</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">4</a>
                            <p class="fw-bold"><h5>Besoin</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-5" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">5</a>
                            <p class="fw-bold"><h5>À propos de la formation</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-6" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">6</a>
                            <p class="fw-bold"><h5>Création de la formation</h5></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row setup-content" id="step-1" style="display: block;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_general_info')
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-2" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_contenu_formation')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-3" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_competence')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-4" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_besoin')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-5" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_a_propos')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-6" style="display: none;">
                            <div class="col-xs-12 col-md" id="video">
                                <div class="col-md-12">
                                    @include('Formateur.formations.edit_formation_video')
                                </div>
                            </div>
                            <!-- Boutons communs pour #step-6 -->
                           <div class="col-md-12 mt-4">
    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
    <button class="btn btn-primary updateBtn btn-lg pull-right" type="submit">Mettre à jour</button>
</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ==================== Parties → Chapitres (Texte) ====================
    // ==================== Parties → Chapitres (Vidéo) ====================
    let partieIndexCounterVideo = 0;
    const chapitreIndexCountersVideo = {};

    function buildPartieHtmlVideo(partieIndex, displayNumber) {
        const partieId = `partie_video_${partieIndex}`;
        return `
        <div id="${partieId}" class="partie-block border rounded p-3 mb-4 bg-light">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class="mb-0">Partie ${displayNumber}</h4>
                <button type="button" id="remove_partie_video_btn_${partieIndex}" class="btn btn-outline-danger btn-sm" onclick="removePartieVideo(${partieIndex})">
                    <ion-icon name="trash-outline"></ion-icon> Supprimer la partie
                </button>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label text-md-right">Titre de la partie</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="parties_video[${partieIndex}][titre]" placeholder="Titre de la partie">
                </div>
            </div>

            <div id="chapitres_partie_video_${partieIndex}"></div>

            <div class="form-group row mt-2">
                <div class="col-md-12 my-2 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary btn-sm col-sm-3" onclick="addNewChapitreVideo(${partieIndex})">
                        <ion-icon name="add-outline"></ion-icon> Nouveau chapitre
                    </button>
                    <button type="button" id="delete_last_chap_video_btn_${partieIndex}" class="btn btn-danger btn-sm col-sm-3" onclick="deleteLastChapitreVideo(${partieIndex})">
                        <ion-icon name="trash-outline"></ion-icon> Supprimer le dernier chapitre
                    </button>
                </div>
            </div>
        </div>`;
    }

    function buildChapitreHtmlVideo(partieIndex, chapitreIndex) {
        const snId = `sn_vid_part${partieIndex}_chap${chapitreIndex}`;
        const fileId = `file_vid_part${partieIndex}_chap${chapitreIndex}`;
        return `
        <div class="chapitre-block border p-3 mb-3">
            <h5 class="mb-3">Chapitre ${chapitreIndex}</h5>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Intitulé du chapitre</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][intitule]" placeholder="Titre du chapitre">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Petite description</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][description]" rows="2"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Vidéo</label>
                <div class="col-md-8">
                    <input id="${fileId}" type="file" class="form-control" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][video]" accept="video/*">
                    <input type="hidden" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][old_video_url]" value="">
                    <div class="video-preview-wrapper">
                        <video class="video-preview" controls></video>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 col-form-label text-md-center">Texte/Notes</label>
                <div class="col-md-12">
                    <textarea id="${snId}" class="summernote" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][contenu]"></textarea>
                </div>
            </div>
        </div>`;
    }

    function addNewPartieVideo(autoCreateFirst = true) {
        partieIndexCounterVideo += 1;
        const idx = partieIndexCounterVideo;
        chapitreIndexCountersVideo[idx] = 0;
        const displayNumber = $('#parties_container_video .partie-block').length + 1;
        const html = buildPartieHtmlVideo(idx, displayNumber);
        $('#parties_container_video').append(html);
        if (autoCreateFirst) addNewChapitreVideo(idx);
        updateRemovePartieButtonsVisibilityVideo();
        return idx;
    }

    function removePartieVideo(partieIndex) {
        if (!window.confirm('Voulez-vous vraiment supprimer cette partie ?')) return;
        $(`#partie_video_${partieIndex}`).remove();
        delete chapitreIndexCountersVideo[partieIndex];
        let number = 1;
        $('#parties_container_video .partie-block').each(function(){
            $(this).find('h4.mb-0').text('Partie ' + number);
            number += 1;
        });
        updateRemovePartieButtonsVisibilityVideo();
    }

    function updateRemovePartieButtonsVisibilityVideo() {
        const total = $('#parties_container_video .partie-block').length;
        if (total <= 1) {
            const only = $('#parties_container_video .partie-block').first();
            const id = only.attr('id');
            if (id) {
                const idx = id.split('_').pop();
                $(`#remove_partie_video_btn_${idx}`).hide();
            }
        } else {
            $('#parties_container_video .partie-block').each(function(){
                const id = $(this).attr('id');
                if (!id) return;
                const idx = id.split('_').pop();
                $(`#remove_partie_video_btn_${idx}`).show();
            });
        }
    }

    function addNewChapitreVideo(partieIndex, initialData) {
        chapitreIndexCountersVideo[partieIndex] = (chapitreIndexCountersVideo[partieIndex] || 0) + 1;
        const chapIdx = chapitreIndexCountersVideo[partieIndex];
        const html = buildChapitreHtmlVideo(partieIndex, chapIdx);
        $(`#chapitres_partie_video_${partieIndex}`).append(html);

        const snId = `#sn_vid_part${partieIndex}_chap${chapIdx}`;
        setTimeout(() => {
            $(snId).summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        if (initialData && initialData.contenu) {
                            try { $(snId).summernote('code', initialData.contenu); } catch(e) {}
                        }
                    }
                }
            });
        }, 0);

        // Pré-remplir champs
        if (initialData) {
            $(`input[name="parties_video[${partieIndex}][chapitres][${chapIdx}][intitule]"]`).val(initialData.intitule || '');
            $(`textarea[name="parties_video[${partieIndex}][chapitres][${chapIdx}][description]"]`).val(initialData.description || '');
            if (initialData.old_video_rel || initialData.preview_url) {
                if (initialData.old_video_rel) {
                    $(`input[name="parties_video[${partieIndex}][chapitres][${chapIdx}][old_video_url]"]`).val(initialData.old_video_rel);
                }
                const $group = $(`input[name="parties_video[${partieIndex}][chapitres][${chapIdx}][old_video_url]"]`).closest('.form-group');
                const $video = $group.find('video.video-preview');
                const wrapper = $group.find('.video-preview-wrapper')[0];
                const url = initialData.preview_url || initialData.old_video_rel || '';
                if (url) {
                    $video.attr('src', url);
                    if (wrapper) wrapper.style.display = 'block';
                }
            }
        }

        // Aperçu vidéo
        const fileInput = $(`input[name="parties_video[${partieIndex}][chapitres][${chapIdx}][video]"]`)[0];
        if (fileInput) {
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const $group = $(fileInput).closest('.form-group');
                const videoEl = $group.find('video.video-preview')[0];
                const wrapper = $group.find('.video-preview-wrapper')[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    videoEl.src = url;
                    if (wrapper) wrapper.style.display = 'block';
                }
            });
        }

        if (chapIdx === 1) $(`#delete_last_chap_video_btn_${partieIndex}`).hide(); else $(`#delete_last_chap_video_btn_${partieIndex}`).show();
    }

    function deleteLastChapitreVideo(partieIndex) {
        if (!window.confirm('Voulez-vous vraiment supprimer le dernier chapitre de cette partie ?')) return;
        const current = chapitreIndexCountersVideo[partieIndex] || 0;
        if (current <= 0) return;
        const snId = `#sn_vid_part${partieIndex}_chap${current}`;
        try { $(snId).summernote('destroy'); } catch (e) {}
        $(`#chapitres_partie_video_${partieIndex} .chapitre-block`).last().remove();
        chapitreIndexCountersVideo[partieIndex] = current - 1;
        if ((chapitreIndexCountersVideo[partieIndex] || 0) <= 1) $(`#delete_last_chap_video_btn_${partieIndex}`).hide(); else $(`#delete_last_chap_video_btn_${partieIndex}`).show();
    }
    let partieIndexCounterTexte = 0;
    const chapitreIndexCountersTexte = {}; // map: partieIndex -> count

    function buildPartieHtmlTexte(partieIndex, displayNumber) {
        const partieId = `partie_texte_${partieIndex}`;
        return `
        <div id="${partieId}" class="partie-block border rounded p-3 mb-4 bg-light">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class="mb-0">Partie ${displayNumber}</h4>
                <button type="button" id="remove_partie_texte_btn_${partieIndex}" class="btn btn-outline-danger btn-sm" onclick="removePartieTexte(${partieIndex})">
                    <ion-icon name="trash-outline"></ion-icon> Supprimer la partie
                </button>
            </div>

            <div class="form-group row mb-3">
                <label class="col-md-2 col-form-label text-md-right">Titre de la partie</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="parties[${partieIndex}][titre]" placeholder="Titre de la partie">
                </div>
            </div>

            <div id="chapitres_partie_texte_${partieIndex}"></div>

            <div class="form-group row mt-2">
                <div class="col-md-12 my-2 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary btn-sm col-sm-3" onclick="addNewChapitreTexte(${partieIndex})">
                        <ion-icon name="add-outline"></ion-icon> Nouveau chapitre
                    </button>
                    <button type="button" id="delete_last_chap_texte_btn_${partieIndex}" class="btn btn-danger btn-sm col-sm-3" onclick="deleteLastChapitreTexte(${partieIndex})">
                        <ion-icon name="trash-outline"></ion-icon> Supprimer le dernier chapitre
                    </button>
                </div>
            </div>
        </div>`;
    }

    function buildChapitreHtmlTexte(partieIndex, chapitreIndex) {
        const textareaId = `sn_txt_part${partieIndex}_chap${chapitreIndex}`;
        return `
        <div class="chapitre-block border p-3 mb-3">
            <h5 class="mb-3">Chapitre ${chapitreIndex}</h5>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Intitulé du chapitre</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="parties[${partieIndex}][chapitres][${chapitreIndex}][intitule]" placeholder="Titre du chapitre">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">Petite description</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="parties[${partieIndex}][chapitres][${chapitreIndex}][description]" rows="2"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-12 col-form-label text-md-center">Rédiger le contenu du chapitre</label>
                <div class="col-md-12">
                    <textarea id="${textareaId}" class="summernote" name="parties[${partieIndex}][chapitres][${chapitreIndex}][contenu]"></textarea>
                </div>
            </div>
        </div>`;
    }

    function addNewPartieTexte() {
        partieIndexCounterTexte += 1;
        const idx = partieIndexCounterTexte;
        chapitreIndexCountersTexte[idx] = 0;

        const displayNumber = $('#parties_container_texte .partie-block').length + 1;
        const html = buildPartieHtmlTexte(idx, displayNumber);
        $('#parties_container_texte').append(html);

        addNewChapitreTexte(idx);
        updateRemovePartieButtonsVisibilityTexte();
    }

    function removePartieTexte(partieIndex) {
        if (!window.confirm('Voulez-vous vraiment supprimer cette partie ?')) {
            return;
        }
        $(`#partie_texte_${partieIndex}`).remove();
        delete chapitreIndexCountersTexte[partieIndex];
        let number = 1;
        $('#parties_container_texte .partie-block').each(function(){
            $(this).find('h4.mb-0').text('Partie ' + number);
            number += 1;
        });
        updateRemovePartieButtonsVisibilityTexte();
    }

    function updateRemovePartieButtonsVisibilityTexte() {
        const total = $('#parties_container_texte .partie-block').length;
        if (total <= 1) {
            const only = $('#parties_container_texte .partie-block').first();
            const id = only.attr('id');
            if (id) {
                const idx = id.split('_').pop();
                $(`#remove_partie_texte_btn_${idx}`).hide();
            }
        } else {
            $('#parties_container_texte .partie-block').each(function(){
                const id = $(this).attr('id');
                if (!id) return;
                const idx = id.split('_').pop();
                $(`#remove_partie_texte_btn_${idx}`).show();
            });
        }
    }

    function addNewChapitreTexte(partieIndex) {
        chapitreIndexCountersTexte[partieIndex] = (chapitreIndexCountersTexte[partieIndex] || 0) + 1;
        const chapIdx = chapitreIndexCountersTexte[partieIndex];
        const html = buildChapitreHtmlTexte(partieIndex, chapIdx);
        $(`#chapitres_partie_texte_${partieIndex}`).append(html);

        const snId = `#sn_txt_part${partieIndex}_chap${chapIdx}`;
        setTimeout(() => {
            $(snId).summernote({
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }, 50);

        if (chapIdx === 1) {
            $(`#delete_last_chap_texte_btn_${partieIndex}`).hide();
        } else {
            $(`#delete_last_chap_texte_btn_${partieIndex}`).show();
        }
    }

    function deleteLastChapitreTexte(partieIndex) {
        if (!window.confirm('Voulez-vous vraiment supprimer le dernier chapitre de cette partie ?')) {
            return;
        }
        const current = chapitreIndexCountersTexte[partieIndex] || 0;
        if (current <= 0) return;
        const snId = `#sn_txt_part${partieIndex}_chap${current}`;
        try { $(snId).summernote('destroy'); } catch (e) {}
        $(`#chapitres_partie_texte_${partieIndex} .chapitre-block`).last().remove();
        chapitreIndexCountersTexte[partieIndex] = current - 1;
        if ((chapitreIndexCountersTexte[partieIndex] || 0) <= 1) {
            $(`#delete_last_chap_texte_btn_${partieIndex}`).hide();
        } else {
            $(`#delete_last_chap_texte_btn_${partieIndex}`).show();
        }
    }

    let chapitreTexteIndex = {{ count($chapters) }};
    let chapitreVideoIndex = {{ count($chapters) }};
    let contenuIndex = {{ count($formation->contenus) }};
    let competenceIndex = {{ count($formation->competences) }};
    let besoinIndex = {{ count($formation->besoins) }};
    

    function addnewcontenu() {
        contenuIndex++;
        const newContenuDiv = document.createElement('div');
        newContenuDiv.className = 'form-group row contenu';
        newContenuDiv.id = `contenu${contenuIndex}`;
        newContenuDiv.innerHTML = `
            <label for="contenu_${contenuIndex}" class="col-md-2 col-form-label text-md-right">Contenu n°${contenuIndex}</label>
            <div class="col-md-8">
                <input id="contenu_${contenuIndex}" type="text" class="form-control" name="contenu[]" autocomplete="contenu" autofocus>
            </div>
        `;
        document.getElementById('newcontenu').appendChild(newContenuDiv);
    }

    function deletecontenu() {
        const contenus = document.getElementsByClassName('contenu');
        if (contenus.length > 0) {
            contenus[contenus.length - 1].remove();
            contenuIndex--;
        }
    }

    function addnewcompetence() {
        competenceIndex++;
        const newCompetenceDiv = document.createElement('div');
        newCompetenceDiv.className = 'form-group row competence';
        newCompetenceDiv.id = `competence${competenceIndex}`;
        newCompetenceDiv.innerHTML = `
            <label for="competence_${competenceIndex}" class="col-md-2 col-form-label text-md-right">Compétence n°${competenceIndex}</label>
            <div class="col-md-8">
                <input id="competence_${competenceIndex}" type="text" class="form-control" name="competence[]" autocomplete="competence" autofocus>
            </div>
        `;
        document.getElementById('newcompetence').appendChild(newCompetenceDiv);
    }

    function deletecompetence() {
        const competences = document.getElementsByClassName('competence');
        if (competences.length > 0) {
            competences[competences.length - 1].remove();
            competenceIndex--;
        }
    }

    function addnewbesoin() {
        besoinIndex++;
        const newBesoinDiv = document.createElement('div');
        newBesoinDiv.className = 'form-group row besoin';
        newBesoinDiv.id = `besoin${besoinIndex}`;
        newBesoinDiv.innerHTML = `
            <label for="besoin_${besoinIndex}" class="col-md-2 col-form-label text-md-right">Besoin n°${besoinIndex}</label>
            <div class="col-md-8">
                <input id="besoin_${besoinIndex}" type="text" class="form-control" name="besoin[]" autocomplete="besoin" autofocus>
            </div>
        `;
        document.getElementById('newbesoin').appendChild(newBesoinDiv);
    }

    function deletebesoin() {
        const besoins = document.getElementsByClassName('besoin');
        if (besoins.length > 0) {
            besoins[besoins.length - 1].remove();
            besoinIndex--;
        }
    }

    function addnewchapitre_texte() {
        chapitreTexteIndex++;
        const newChapitreDiv = document.createElement('div');
        newChapitreDiv.className = 'form-group row chapitre_texte';
        newChapitreDiv.id = `chapitre_texte${chapitreTexteIndex}`;
        newChapitreDiv.innerHTML = `
            <h4 class="col-md-12 text-center">Chapitre ${chapitreTexteIndex}</h4>
            <div class="form-group row">
                <label for="intitule_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Intitulé</label>
                <div class="col-md-8">
                    <input id="intitule_texte_${chapitreTexteIndex}" type="text" class="form-control" name="intitule_texte[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="chapitre_description_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Description</label>
                <div class="col-md-8">
                    <textarea id="chapitre_description_texte_${chapitreTexteIndex}" class="form-control" name="chapitre_description_texte[]"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="editordata_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Contenu texte</label>
                <div class="col-md-8">
                    <textarea id="editordata_texte_${chapitreTexteIndex}" class="form-control summernote" name="editordata_texte[]"></textarea>
                </div>
            </div>
        `;
        document.getElementById('newchapitre_texte').appendChild(newChapitreDiv);
        $(`#editordata_texte_${chapitreTexteIndex}`).summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }

    function deletechapitre_texte() {
        const chapters = document.getElementsByClassName('chapitre_texte');
        if (chapters.length > 1) {
            chapters[chapters.length - 1].remove();
            chapitreTexteIndex--;
        }
    }

    function addnewchapitre_video() {
        chapitreVideoIndex++;
        const newChapitreDiv = document.createElement('div');
        newChapitreDiv.className = 'form-group row chapitre_video';
        newChapitreDiv.id = `chapitre_video${chapitreVideoIndex}`;
        newChapitreDiv.innerHTML = `
            <h4 class="col-md-12 text-center">Chapitre ${chapitreVideoIndex}</h4>
            <div class="form-group row">
                <label for="intitule_${chapitreVideoIndex}" class="col-md-2 col-form-label text-md-right">Intitulé</label>
                <div class="col-md-8">
                    <input id="intitule_${chapitreVideoIndex}" type="text" class="form-control" name="intitule[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="chapitre_description_${chapitreVideoIndex}" class="col-md-2 col-form-label text-md-right">Description</label>
                <div class="col-md-8">
                    <textarea id="chapitre_description_${chapitreVideoIndex}" class="form-control" name="chapitre_description[]"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="video_${chapitreVideoIndex}" class="col-md-2 col-form-label text-md-right">Vidéo</label>
                <div class="col-md-8">
                    <input id="video_${chapitreVideoIndex}" type="file" class="form-control" name="video[]" accept="video/*">
                    <input type="hidden" name="old_video_url[]" value=""><br>
                    <!-- L'aperçu vidéo sera ajouté ici dynamiquement -->
                </div>
            </div>
            <div class="form-group row">
                <label for="editordata_video_${chapitreVideoIndex}" class="col-md-2 col-form-label text-md-right">Texte/Notes</label>
                <div class="col-md-8">
                    <textarea id="editordata_video_${chapitreVideoIndex}" class="form-control summernote" name="editordata_video[]"></textarea>
                </div>
            </div>
        `;
        document.getElementById('newchapitre_video').appendChild(newChapitreDiv);
        $(`#editordata_video_${chapitreVideoIndex}`).summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        const videoInput = document.getElementById(`video_${chapitreVideoIndex}`);
        if (videoInput) {
            videoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                let preview = document.getElementById(`video_preview_${chapitreVideoIndex}`);
                if (!preview) {
                    preview = document.createElement('video');
                    preview.id = `video_preview_${chapitreVideoIndex}`;
                    preview.controls = true;
                    preview.style.width = '100%';
                    preview.style.maxWidth = '400px';
                    videoInput.parentNode.appendChild(preview);
                }
                if (file) {
                    const url = URL.createObjectURL(file);
                    preview.src = url;
                } else {
                    preview.src = '';
                }
            });
        }
    }

    function deletechapitre_video() {
        const chapitres = document.getElementsByClassName('chapitre_video');
        if (chapitres.length > 0) {
            chapitres[chapitres.length - 1].remove();
            chapitreVideoIndex--;
        }
    }
    /////////////////

    $(document).ready(function () {
    checkRadio();

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn').not('.updateBtn'), // Exclure le bouton "Mettre à jour"
        allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn btn-primary').addClass('btn btn-default');
            $item.addClass('btn btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input[type="text"]:eq(0)').focus();
        }
    });

    allPrevBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children('a');
        prevStepWizard.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children('a'),
            curInputs = curStep.find('input[type="text"], select, input[type="radio"]:checked, textarea:not(.summernote)'),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (curInputs[i].hasAttribute('required') && !curInputs[i].value.trim()) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        // Vérifier les champs Summernote
        curStep.find('.summernote').each(function() {
            if ($(this).summernote('isEmpty')) {
                isValid = false;
                $(this).closest(".form-group").addClass("has-error");
            }
        });

        // Vérifier les fichiers vidéo
        if (curStep.find('#video').is(':visible')) {
            curStep.find('.chapitre_video').each(function() {
                var fileInput = $(this).find('input[type="file"][name="video[]"]');
                var oldVideoInput = $(this).find('input[name="old_video_url[]"]');
                var hasOldVideo = oldVideoInput.length && oldVideoInput.val().trim() !== "";
                var hasNewFile = fileInput[0].files && fileInput[0].files.length > 0;
                if (!hasOldVideo && !hasNewFile) {
                    isValid = false;
                    fileInput.closest(".form-group").addClass("has-error");
                }
            });
        }

        if (isValid) {
            nextStepWizard.removeAttr('disabled').trigger('click');
        } else {
            alert('Veuillez remplir tous les champs requis.');
        }
    });

    // Validation avant soumission
    $('form').on('submit', function(e) {
        var isValid = true;
        var formInputs = $(this).find('input:visible:not(:disabled), select:visible:not(:disabled), textarea:visible:not(:disabled)').filter('[required]');
        var summernoteInputs = $(this).find('.summernote');

        $(".form-group").removeClass("has-error");

        // DEBUG : liste tous les champs validés
        console.log('Champs validés:', formInputs);

        // Vérifier les champs requis
        formInputs.each(function() {
            if (!$(this).val().trim()) {
                isValid = false;
                $(this).closest(".form-group").addClass("has-error");
                // DEBUG : affiche le champ vide
                console.log('Champ requis vide:', $(this).attr('name'), 'id:', $(this).attr('id'));
            }
        });

        // Vérifier les champs Summernote
        summernoteInputs.filter(':visible').each(function() {
            if ($(this).summernote('isEmpty')) {
                isValid = false;
                $(this).closest(".form-group").addClass("has-error");
                console.log('Champ summernote vide:', $(this).attr('name'), 'id:', $(this).attr('id'));
            }
        });

        // Vérifier les fichiers vidéo
        if ($('#video').is(':visible')) {
            $(this).find('.chapitre_video').each(function() {
                var fileInput = $(this).find('input[type="file"][name="video[]"]');
                var oldVideoInput = $(this).find('input[name="old_video_url[]"]');
                var hasOldVideo = oldVideoInput.length && oldVideoInput.val().trim() !== "";
                var hasNewFile = fileInput[0].files && fileInput[0].files.length > 0;

                // DEBUG
                console.log('Chapitre:', $(this));
                console.log('oldVideoInput:', oldVideoInput.val());
                console.log('hasOldVideo:', hasOldVideo, 'hasNewFile:', hasNewFile);

                if (!hasOldVideo && !hasNewFile) {
                    isValid = false;
                    fileInput.closest(".form-group").addClass("has-error");
                }
            });
        }

        if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs requis avant de soumettre.');
            return false;
        }

        var formData = new FormData(this);
        console.log('Formulaire soumis avec les données : ');
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    });

    // Ajout d'un événement pour le bouton "Mettre à jour"
    $('.updateBtn').click(function(e) {
        console.log('Bouton "Mettre à jour" cliqué');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    // Initialiser l'UI Parties→Chapitres (Texte) depuis $chapters (compatibilité ancienne/ nouvelle structure)
    try {
        let raw = @json($chapters);
        if (typeof raw === 'string') {
            try { raw = JSON.parse(raw); } catch(e) { raw = []; }
        }
        let parties = [];
        // Si nouvelle structure (tableau de parties avec chapitres)
        if (Array.isArray(raw) && raw.length > 0 && raw[0] && raw[0].chapitres !== undefined) {
            parties = raw;
        } else if (Array.isArray(raw)) {
            // Ancienne structure: tableau plat de chapitres => une seule partie
            parties = [{ num_partie: 1, titre: 'Partie 1', chapitres: raw }];
        }

        if (parties.length === 0) {
            addNewPartieTexte();
        } else {
            parties.forEach((partie, pIdx) => {
                addNewPartieTexte();
                const currentIndex = partieIndexCounterTexte; // index créé
                // Remplir titre
                $(`input[name="parties[${currentIndex}][titre]"]`).val(partie.titre || `Partie ${pIdx+1}`);
                // Ajouter chapitres
                const chapitres = Array.isArray(partie.chapitres) ? partie.chapitres : [];
                // Premier chapitre déjà créé par addNewPartieTexte(); si besoin, on remplira/sura ajouter
                chapitres.forEach((chap, cIdx) => {
                    if (cIdx === 0) {
                        // déjà créé
                    } else {
                        addNewChapitreTexte(currentIndex);
                    }
                    const ci = cIdx + 1; // nos champs commencent à 1
                    $(`input[name="parties[${currentIndex}][chapitres][${ci}][intitule]"]`).val(chap.intitule || '');
                    $(`textarea[name="parties[${currentIndex}][chapitres][${ci}][description]"]`).val(chap.chapitre_description || '');
                    const snSel = `#sn_txt_part${currentIndex}_chap${ci}`;
                    const rawContent = (chap.summernote !== undefined && chap.summernote !== null)
                        ? chap.summernote
                        : (chap.editordata_video !== undefined && chap.editordata_video !== null)
                            ? chap.editordata_video
                            : '';
                    if (rawContent) {
                        setTimeout(() => {
                            try { $(snSel).summernote('code', decodeHtmlEntities(rawContent)); } catch(e) {}
                        }, 100);
                    }
                });
            });
        }
    } catch(e) {
        // fallback: au moins une partie
        addNewPartieTexte();
    }

    // Initialiser l'UI Parties→Chapitres (Vidéo) depuis $chapters si type=video
    try {
        if (true) {
            let rawVid = @json($chapters);
            if (typeof rawVid === 'string') { try { rawVid = JSON.parse(rawVid); } catch(e) { rawVid = []; } }
            let partiesVid = [];
            if (Array.isArray(rawVid) && rawVid.length > 0 && rawVid[0] && rawVid[0].chapitres !== undefined) {
                partiesVid = rawVid;
            } else if (Array.isArray(rawVid)) {
                partiesVid = [{ num_partie: 1, titre: 'Partie 1', chapitres: rawVid }];
            }
            const baseUrl = "{{ url('/') }}".replace(/\/$/, '');
            if (partiesVid.length === 0) {
                addNewPartieVideo(true);
            } else {
                partiesVid.forEach((partie, pIdx) => {
                    const currentIndex = addNewPartieVideo(false);
                    $(`input[name="parties_video[${currentIndex}][titre]"]`).val(partie.titre || `Partie ${pIdx+1}`);
                    const chapitres = Array.isArray(partie.chapitres) ? partie.chapitres : [];
                    chapitres.forEach((chap) => {
                        const rawContent = chap.editordata_video || chap.summernote || '';
                        addNewChapitreVideo(currentIndex, {
                            intitule: chap.intitule || '',
                            description: chap.chapitre_description || '',
                            contenu: decodeHtmlEntities(rawContent),
                            old_video_rel: chap.video_url || '',
                            preview_url: chap.video_url ? (baseUrl + (chap.video_url.startsWith('/') ? chap.video_url : '/' + chap.video_url)) : ''
                        });
                    });
                    if (chapitres.length === 0) addNewChapitreVideo(currentIndex);
                });
            }
        }
    } catch(e) { addNewPartieVideo(true); }

    // Afficher la bonne sous-section dans #step-6 au chargement
    function updateStep6Visibility() {
        $('#video').show();
    }
    updateStep6Visibility();

    $('input[type="file"][name="video[]"]').each(function(index, input) {
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            // Masquer l'ancienne vidéo si elle existe
            const oldPreview = input.parentNode.querySelector('.old-video-preview');
            if (oldPreview) {
                oldPreview.style.display = 'none';
            }
            let preview = input.parentNode.querySelector('video.video-preview');
            if (!preview) {
                preview = document.createElement('video');
                preview.className = 'video-preview';
                preview.controls = true;
                preview.style.width = '100%';
                preview.style.maxWidth = '400px';
                input.parentNode.appendChild(preview);
            }
            if (file) {
                const url = URL.createObjectURL(file);
                preview.src = url;
            } else {
                preview.src = '';
            }
        });
    });
});

function checkRadio() {
    if ($('#flexRadioDefault1').prop('checked')) {
        $('#prix_formation').css('display', 'block');
        $('#prix_certification').css('display', 'block');
    }
    if ($('#flexRadioDefault2').prop('checked')) {
        $('#prix_certification').css('display', 'block');
        $('#prix_formation').css('display', 'none');
    }
}

// Utilitaire pour décoder les entités HTML renvoyées par le backend
function decodeHtmlEntities(str) {
    if (!str) return '';
    const txt = document.createElement('textarea');
    txt.innerHTML = str;
    return txt.value;
}
</script>

@endsection