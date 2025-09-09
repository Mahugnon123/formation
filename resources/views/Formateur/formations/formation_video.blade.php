<!-- Builder Parties → Chapitres pour formations vidéo -->
<div id="parties_container_video"></div>

    <div class="form-group row">
  <div class="col-md-12 my-3 d-flex justify-content-center gap-2">
    <button type="button" class="btn btn-success btn-sm col-sm-3 col-10" onclick="addNewPartieVideo()">
      <ion-icon name="add-outline"></ion-icon> Nouvelle partie
    </button>
  </div>
</div>
<style>
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
/* Fullscreen: use real video size within the screen */
.video-preview:fullscreen, .video-preview-wrapper:fullscreen .video-preview {
  width: 100%;
  height: 100%;
  object-fit: contain;
  background: #000;
}
/* Vendor prefixes for broader support */
.video-preview:-webkit-full-screen, .video-preview-wrapper:-webkit-full-screen .video-preview {
  width: 100%;
  height: 100%;
  object-fit: contain;
  background: #000;
}
</style>
<script>
let partieIndexCounterVideo = 0;
const chapitreIndexCountersVideo = {}; // map: partieIndex -> count

function buildPartieVideoHtml(partieIndex, displayNumber) {
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

function buildChapitreVideoHtml(partieIndex, chapitreIndex) {
  const textareaId = `sn_video_part${partieIndex}_chap${chapitreIndex}`;
  const fileInputId = `file_video_part${partieIndex}_chap${chapitreIndex}`;
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
      <label class="col-md-2 col-form-label text-md-right">Vidéo du chapitre</label>
        <div class="col-md-8">
        <input id="${fileInputId}" type="file" class="form-control" accept="video/mp4,video/x-m4v,video/*" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][video]" placeholder="Vidéo du chapitre">
        <span style="color: red; display: none;" class="text-center" id="message_video_${partieIndex}_${chapitreIndex}"></span>
        <div class="video-preview-wrapper">
          <video class="video-preview" controls></video>
        </div>
        </div>
    </div>

    <div class="form-group row">
      <label class="col-md-12 col-form-label text-md-center">Texte/Notes du chapitre</label>
      <div class="col-md-12">
        <textarea id="${textareaId}" name="parties_video[${partieIndex}][chapitres][${chapitreIndex}][contenu]"></textarea>
</div>
    </div>
  </div>`;
}

function addNewPartieVideo() {
  partieIndexCounterVideo += 1;
  const idx = partieIndexCounterVideo;
  chapitreIndexCountersVideo[idx] = 0;

  // Calculer le numéro d'affichage basé sur le nombre de parties existantes
  const existingParties = $('#parties_container_video .partie-block').length;
  const displayNumber = existingParties + 1;
  const html = buildPartieVideoHtml(idx, displayNumber);
  $('#parties_container_video').append(html);

  // auto-create first chapitre for this partie
  addNewChapitreVideo(idx);
  // Update remove buttons visibility across all parties
  updateRemovePartieVideoButtonsVisibility();
}

function removePartieVideo(partieIndex) {
  if (!window.confirm('Voulez-vous vraiment supprimer cette partie ?')) {
    return;
  }
  $(`#partie_video_${partieIndex}`).remove();
  delete chapitreIndexCountersVideo[partieIndex];
  // Renuméroter les titres affichés pour rester consécutifs à partir de 1
  let number = 1;
  $('#parties_container_video .partie-block').each(function(){
    $(this).find('h4.mb-0').text('Partie ' + number);
    number += 1;
  });
  // Gérer la visibilité des boutons supprimer-partie selon le nombre total
  updateRemovePartieVideoButtonsVisibility();
}

function updateRemovePartieVideoButtonsVisibility() {
  const total = $('#parties_container_video .partie-block').length;
  if (total <= 1) {
    // Hide the only remove button when there's only one partie
    $('#parties_container_video .partie-block').each(function(){
      const id = $(this).attr('id');
      if (!id) return;
      const idx = id.split('_')[2]; // partie_video_X
      $(`#remove_partie_video_btn_${idx}`).hide();
    });
  } else {
    // Show remove on all parties when there are 2 or more
    $('#parties_container_video .partie-block').each(function(){
      const id = $(this).attr('id');
      if (!id) return;
      const idx = id.split('_')[2]; // partie_video_X
      $(`#remove_partie_video_btn_${idx}`).show();
    });
  }
}

function addNewChapitreVideo(partieIndex) {
  chapitreIndexCountersVideo[partieIndex] = (chapitreIndexCountersVideo[partieIndex] || 0) + 1;
  const chapIdx = chapitreIndexCountersVideo[partieIndex];
  const html = buildChapitreVideoHtml(partieIndex, chapIdx);
  $(`#chapitres_partie_video_${partieIndex}`).append(html);

  const snId = `#sn_video_part${partieIndex}_chap${chapIdx}`;
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

  // Hide delete-last-chapter when only one chapter exists in this partie
  if (chapIdx === 1) {
    $(`#delete_last_chap_video_btn_${partieIndex}`).hide();
  } else {
    $(`#delete_last_chap_video_btn_${partieIndex}`).show();
  }

  // Aperçu vidéo sur sélection
  const fileInput = document.getElementById(`file_video_part${partieIndex}_chap${chapIdx}`);
  if (fileInput) {
    fileInput.addEventListener('change', function(event) {
      const file = event.target.files[0];
      const $group = $(fileInput).closest('.form-group');
      const wrapper = $group.find('.video-preview-wrapper')[0];
      const preview = $group.find('video.video-preview')[0];
      if (file) {
        const url = URL.createObjectURL(file);
        preview.src = url;
        if (wrapper) wrapper.style.display = 'block';
      } else {
        preview.src = '';
        if (wrapper) wrapper.style.display = 'none';
      }
    });
  }
}

function deleteLastChapitreVideo(partieIndex) {
  if (!window.confirm('Voulez-vous vraiment supprimer le dernier chapitre de cette partie ?')) {
    return;
  }
  const current = chapitreIndexCountersVideo[partieIndex] || 0;
  if (current <= 0) return;
  const snId = `#sn_video_part${partieIndex}_chap${current}`;
  try { $(snId).summernote('destroy'); } catch (e) {}
  $(`#chapitres_partie_video_${partieIndex} .chapitre-block`).last().remove();
  chapitreIndexCountersVideo[partieIndex] = current - 1;
  // Hide again if only one chapter remains
  if ((chapitreIndexCountersVideo[partieIndex] || 0) <= 1) {
    $(`#delete_last_chap_video_btn_${partieIndex}`).hide();
  } else {
    $(`#delete_last_chap_video_btn_${partieIndex}`).show();
  }
}

$(document).ready(function() {
  // Auto-create first partie on load
  addNewPartieVideo();
  // After initial creation: ensure correct visibility states
  $(`#delete_last_chap_video_btn_1`).hide();
  updateRemovePartieVideoButtonsVisibility();
});
</script>