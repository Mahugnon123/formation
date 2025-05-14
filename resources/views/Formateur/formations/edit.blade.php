@extends("Formateur.app")
@section("content")
<div class="container my-5" style="min-height: 63vh">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step mb-4">
                            <a href="#step-1" type="button" class="btn btn-circle btn-default btn-primary">1</a>
                            <h5 class="fw-bold">Informations générales</h5>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">2</a>
                            <h5 class="fw-bold">Contenu de la formation</h5>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">3</a>
                            <h5 class="fw-bold">Compétence à acquérir</h5>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">4</a>
                            <h5 class="fw-bold">Besoin</h5>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-5" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">5</a>
                            <h5 class="fw-bold">À propos de la formation</h5>
                        </div>
                        <div class="stepwizard-step mb-4">
                            <a href="#step-6" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">6</a>
                            <h5 class="fw-bold">Création de la formation</h5>
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
                                    <button class="btn btn-primary prevBtn btn-lg float-start" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg float-end" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-3" style="display: none;">
                            <div class="col-12">
                                <div class="p-4">
                                    @include('Formateur.formations.edit_competence')
                                    <button class="btn btn-primary prevBtn btn-lg float-start" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg float-end" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-4" style="display: none;">
                            <div class="col-12">
                                <div class="p-4">
                                    @include('Formateur.formations.edit_besoin')
                                    <button class="btn btn-primary prevBtn btn-lg float-start" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg float-end" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-5" style="display: none;">
                            <div class="col-12">
                                <div class="p-4">
                                    @include('Formateur.formations.edit_a_propos')
                                    <button class="btn btn-primary prevBtn btn-lg float-start" type="button">Retour</button>
                                    <button class="btn btn-primary nextBtn btn-lg float-end" type="button">Suivant</button>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-6" style="display: none;">
                            <div class="col-12">
                                <div class="p-4">
                                    <div id="texte" style="display: none;">
                                        @include('Formateur.formations.edit_formation_texte')
                                    </div>
                                    <div id="video" style="display: none;">
                                        @include('Formateur.formations.edit_formation_video')
                                    </div>
                                    <button class="btn btn-primary prevBtn btn-lg float-start" type="button">Retour</button>
                                    <button class="btn btn-success btn-lg float-end" type="submit">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
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
.setup-content {
    min-height: 400px;
    overflow: hidden; /* Empêche le débordement */
}
.setup-content .card {
    margin-bottom: 0; /* Supprime les marges internes indésirables */
}
.setup-content img {
    max-width: 100%;
    height: auto;
}
.form-control {
    max-width: 100%;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
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

        if (curStepBtn === 'step-5') {
            const typeSelect = document.querySelector('select[name="type"]');
            const texteSection = document.getElementById('texte');
            const videoSection = document.getElementById('video');
            if (typeSelect && texteSection && videoSection) {
                const type = typeSelect.value || 'texte';
                texteSection.style.display = type === 'texte' ? 'block' : 'none';
                videoSection.style.display = type === 'video' ? 'block' : 'none';
            }
        }

        if (isValid) {
            nextStepWizard.removeAttr('disabled').trigger('click');
        }
    });

    // Initialisation
    $('div.setup-panel div a.btn-primary').trigger('click');
    const typeSelect = document.querySelector('select[name="type"]');
    const texteSection = document.getElementById('texte');
    const videoSection = document.getElementById('video');
    if (typeSelect && texteSection && videoSection) {
        const type = typeSelect.value || 'texte';
        texteSection.style.display = type === 'texte' ? 'block' : 'none';
        videoSection.style.display = type === 'video' ? 'block' : 'none';
    }
});
</script>
@endsection