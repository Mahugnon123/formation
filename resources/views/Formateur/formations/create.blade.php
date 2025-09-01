@extends("Formateur.app")
@section("content")

<style>
body {
    margin-top:40px;
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
                            <p class="fw-bold"><h5>Compétence à acquerir</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">4</a>
                            <p class="fw-bold"><h5>Bésoin</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-5" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">5</a>
                            <p class="fw-bold"><h5>A propos de la formation</h5></p>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-6" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">6</a>
                            <p class="fw-bold"><h5>Création de la formation</h5></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" action="/formations" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="row setup-content" id="step-1" style="display: block;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.general_info')
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-2" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.contenu_formation')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-3" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.competence')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-4" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.besoin')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-5" style="display: none;">
                            <div class="col-xs-12 col-md">
                                <div class="col-md-12">
                                    @include('Formateur.formations.a_propos')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-6" style="display: none;">
                            <div class="col-xs-12 col-md" id="texte">
                                <div class="col-md-12">
                                    @include('Formateur.formations.formation_texte')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Envoyer</button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md" id="video">
                                <div class="col-md-12">
                                    @include('Formateur.formations.formation_video')
                                    <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Supprimer l'initialisation globale de Summernote
    // $('#summernote').summernote();
});

$('select[name="type"]').change(function() {
    if ($(this).val() == "video") {
        $('#texte').hide();
        $('#video').show();
    } else if ($(this).val() == "texte") {
        $('#texte').show();
        $('#video').hide();
    }
});

$('select[name="category_id"]').change(function() {
    if ($(this).val() == "autre") {
        $('#autre').css('display', 'block');
    } else {
        $('#autre').css('display', 'none');
    }
});

var line = 1;
var contenu_line = 1;
var competence_line = 1;
var besoin_line = 1;
var chapitre_texte_line = 1;

function addnewChapter() {
    line += 1;
    var cardfield = `
        <div id='line${line}'>
            <div class='form-group row'>
                <label for='intitule_${line}' class='col-md-2 col-form-label text-md-right'>Intitulé du chapitre</label>
                <div class='col-md-8'>
                    <input id='intitule_${line}' type='text' class='form-control' name='intitule[]' autocomplete='intitule' autofocus>
                </div>
            </div>
            <div class='form-group row'>
                <label for='description_${line}' class='col-md-2 col-form-label text-md-right'>Petite description</label>
                <div class='col-md-8'>
                    <textarea id='description_${line}' name='chapitre_description[]' class='form-control' autocomplete='description' autofocus rows='2' cols='60'></textarea>
                </div>
            </div>
            <div class='form-group row'>
                <label for='video_${line}' class='col-md-2 col-form-label text-md-right'>Video répresentative du chapitre</label>
                <div class='col-md-8'>
                    <input id='video_${line}' type='file' class='form-control' accept='video/mp4,video/x-m4v,video/*' name='video[]' placeholder='video représentative du chapitre'>
                    <span style='color: red; display: none;' class='text-center' id='message_${line}'></span>
                </div>
            </div>
            <div class='form-group row'>
                <label for='editordata_video_${line}' class='col-md-2 col-form-label text-md-right'>Texte/Notes</label>
                <div class='col-md-8'>
                    <textarea id='editordata_video_${line}' class='form-control summernote' name='editordata_video[]'></textarea>
                </div>
            </div>
        </div>`;
    var ajout = $("#newcard");
    ajout.append(cardfield);

    // Initialiser Summernote sur le nouveau champ
    setTimeout(function() {
        $('#editordata_video_' + line).summernote({
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
    }, 100);
}

function deleteChapter() {
    if (line > 1) {
        var line_id = "#line" + line;
        var card_line = $(line_id);
        card_line.remove();
        line -= 1;
    }
}

function addnewChapter_texte() {
    var chapterId = 'chapitre_texte_' + chapitre_texte_line;
    chapitre_texte_line += 1;
    var uniqueId = 'summernote_' + chapitre_texte_line;
    var cardfield = `
        <div id="${chapterId}">
            <div class='form-group row'>
                <label for='intitule_${chapterId}' class='col-md-2 col-form-label text-md-right'>{{ __('Intitulé du chapitre') }}</label>
                <div class='col-md-8'>
                    <input id='intitule_${chapterId}' type='text' class='form-control @error('intitule_texte') is-invalid @enderror' name='intitule_texte[]' value='{{ old('intitule_texte') }}' autocomplete='intitule' autofocus>
                </div>
            </div>
            <div class='form-group row'>
                <label for='description_${chapterId}' class='col-md-2 col-form-label text-md-right'>{{ __('Petite description') }}</label>
                <div class='col-md-8'>
                    <textarea id='description_${chapterId}' class='form-control' name='chapitre_description_texte[]' autocomplete='description' autofocus rows='2' cols='60'></textarea>
                </div>
            </div>
            <div class='form-group row'>
                <label for='${uniqueId}' class='col-md-12 col-form-label text-md-center'>{{ __('Rédiger le contenu du chapitre ici') }}</label>
            </div>
            <div class='form-group row'>
                <div class='col-md-12'>
                    <textarea id='${uniqueId}' name='editordata_texte[]'></textarea>
                </div>
            </div>
        </div>`;
    var ajout = $("#newchapitre_text");
    ajout.append(cardfield);

    $('#' + uniqueId).summernote({
        height: 50,
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

function deleteChapter_texte() {
    var ajout = $("#newchapitre_text");
    if (chapitre_texte_line > 1) {
        var dernierChapitreConteneur = ajout.children().last();
        if (dernierChapitreConteneur.length > 0) {
            dernierChapitreConteneur.remove();
            chapitre_texte_line -= 1;
        }
    }
}

function addnewcontenu() {
    contenu_line += 1;
    var cardfield = `
        <div id='contenu${contenu_line}'>
            <div class='form-group row'>
                <label for='contenu' class='col-md-2 col-form-label text-md-right'>Contenu n°${contenu_line}</label>
                <div class='col-md-8'>
                    <input id='contenu' type='text' class='form-control @error('contenu') is-invalid @enderror' name='contenu[]' value='{{ old('contenu') }}' required autocomplete='contenu' autofocus>
                </div>
            </div>`;
    var ajout = $("#newcontenu");
    ajout.append(cardfield);
}

function deletecontenu() {
    if (contenu_line > 1) {
        var line_id = "#contenu" + contenu_line;
        var card_line = $(line_id);
        card_line.remove();
        contenu_line -= 1;
    }
}

function addnewcompetence() {
    competence_line += 1;
    var cardfield = `
        <div id='competence${competence_line}'>
            <div class='form-group row'>
                <label for='competence' class='col-md-2 col-form-label text-md-right'>Compétence n°${competence_line}</label>
                <div class='col-md-8'>
                    <input id='competence' type='text' class='form-control @error('competence') is-invalid @enderror' name='competence[]' value='{{ old('competence') }}' required autocomplete='competence' autofocus>
                </div>
            </div>`;
    var ajout = $("#newcompetence");
    ajout.append(cardfield);
}

function deletecompetence() {
    if (competence_line > 1) {
        var line_id = "#competence" + competence_line;
        var card_line = $(line_id);
        card_line.remove();
        competence_line -= 1;
    }
}

function addnewbesoin() {
    besoin_line += 1;
    var cardfield = `
        <div id='besoin${besoin_line}'>
            <div class='form-group row'>
                <label for='besoin' class='col-md-2 col-form-label text-md-right'>Besoin n°${besoin_line}</label>
                <div class='col-md-8'>
                    <input id='besoin' type='text' class='form-control @error('besoin') is-invalid @enderror' name='besoin[]' value='{{ old('besoin') }}' required autocomplete='besoin' autofocus>
                </div>
            </div>`;
    var ajout = $("#newbesoin");
    ajout.append(cardfield);
}

function deletebesoin() {
    if (besoin_line > 1) {
        var line_id = "#besoin" + besoin_line;
        var card_line = $(line_id);
        card_line.remove();
        besoin_line -= 1;
    }
}

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

$(document).ready(function () {
    checkRadio();
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');
        
    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allPrevBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
        prevStepWizard.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file'],select,textarea"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>

@endsection