<!-- Builder Parties → Chapitres -->
<div id="parties_container"></div>

<div class="form-group row">
  <div class="col-md-12 my-3 d-flex justify-content-center gap-2">
    <button type="button" class="btn btn-success btn-sm col-sm-3 col-10" onclick="addNewPartie()">
      <ion-icon name="add-outline"></ion-icon> Nouvelle partie
    </button>
  </div>
</div>

<script>
let partieIndexCounter = 0;
const chapitreIndexCounters = {}; // map: partieIndex -> count

function buildPartieHtml(partieIndex, displayNumber) {
  const partieId = `partie_${partieIndex}`;
  return `
  <div id="${partieId}" class="partie-block border rounded p-3 mb-4 bg-light">
    <div class="d-flex align-items-center justify-content-between mb-2">
      <h4 class="mb-0">Partie ${displayNumber}</h4>
      <button type="button" id="remove_partie_btn_${partieIndex}" class="btn btn-outline-danger btn-sm" onclick="removePartie(${partieIndex})">
        <ion-icon name="trash-outline"></ion-icon> Supprimer la partie
      </button>
    </div>

    <div class="form-group row mb-3">
      <label class="col-md-2 col-form-label text-md-right">Titre de la partie</label>
      <div class="col-md-8">
        <input type="text" class="form-control" name="parties[${partieIndex}][titre]" placeholder="Titre de la partie">
      </div>
    </div>

    <div id="chapitres_partie_${partieIndex}"></div>

    <div class="form-group row mt-2">
      <div class="col-md-12 my-2 d-flex justify-content-center gap-2">
        <button type="button" class="btn btn-primary btn-sm col-sm-3" onclick="addNewChapitre(${partieIndex})">
          <ion-icon name="add-outline"></ion-icon> Nouveau chapitre
        </button>
        <button type="button" id="delete_last_chap_btn_${partieIndex}" class="btn btn-danger btn-sm col-sm-3" onclick="deleteLastChapitre(${partieIndex})">
          <ion-icon name="trash-outline"></ion-icon> Supprimer le dernier chapitre
        </button>
      </div>
    </div>
  </div>`;
}

function buildChapitreHtml(partieIndex, chapitreIndex) {
  const textareaId = `sn_part${partieIndex}_chap${chapitreIndex}`;
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
        <textarea id="${textareaId}" name="parties[${partieIndex}][chapitres][${chapitreIndex}][contenu]"></textarea>
      </div>
    </div>
  </div>`;
}

function addNewPartie() {
  partieIndexCounter += 1;
  const idx = partieIndexCounter;
  chapitreIndexCounters[idx] = 0;

  const displayNumber = $('#parties_container .partie-block').length + 1;
  const html = buildPartieHtml(idx, displayNumber);
  $('#parties_container').append(html);

  // auto-create first chapitre for this partie
  addNewChapitre(idx);
  // Update remove buttons visibility across all parties
  updateRemovePartieButtonsVisibility();
}

function removePartie(partieIndex) {
  if (!window.confirm('Voulez-vous vraiment supprimer cette partie ?')) {
    return;
  }
  $(`#partie_${partieIndex}`).remove();
  delete chapitreIndexCounters[partieIndex];
  // Renuméroter les titres affichés pour rester consécutifs à partir de 1
  let number = 1;
  $('#parties_container .partie-block').each(function(){
    $(this).find('h4.mb-0').text('Partie ' + number);
    number += 1;
  });
  // Gérer la visibilité des boutons supprimer-partie selon le nombre total
  updateRemovePartieButtonsVisibility();
}

function updateRemovePartieButtonsVisibility() {
  const total = $('#parties_container .partie-block').length;
  if (total <= 1) {
    // Hide the only remove button
    const only = $('#parties_container .partie-block').first();
    const id = only.attr('id');
    if (id) {
      const idx = id.split('_')[1];
      $(`#remove_partie_btn_${idx}`).hide();
    }
  } else {
    // Show remove on all parties
    $('#parties_container .partie-block').each(function(){
      const id = $(this).attr('id');
      if (!id) return;
      const idx = id.split('_')[1];
      $(`#remove_partie_btn_${idx}`).show();
    });
  }
}

function addNewChapitre(partieIndex) {
  chapitreIndexCounters[partieIndex] = (chapitreIndexCounters[partieIndex] || 0) + 1;
  const chapIdx = chapitreIndexCounters[partieIndex];
  const html = buildChapitreHtml(partieIndex, chapIdx);
  $(`#chapitres_partie_${partieIndex}`).append(html);

  const snId = `#sn_part${partieIndex}_chap${chapIdx}`;
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
    $(`#delete_last_chap_btn_${partieIndex}`).hide();
  } else {
    $(`#delete_last_chap_btn_${partieIndex}`).show();
  }
}

function deleteLastChapitre(partieIndex) {
  if (!window.confirm('Voulez-vous vraiment supprimer le dernier chapitre de cette partie ?')) {
    return;
  }
  const current = chapitreIndexCounters[partieIndex] || 0;
  if (current <= 0) return;
  const snId = `#sn_part${partieIndex}_chap${current}`;
  try { $(snId).summernote('destroy'); } catch (e) {}
  $(`#chapitres_partie_${partieIndex} .chapitre-block`).last().remove();
  chapitreIndexCounters[partieIndex] = current - 1;
  // Hide again if only one chapter remains
  if ((chapitreIndexCounters[partieIndex] || 0) <= 1) {
    $(`#delete_last_chap_btn_${partieIndex}`).hide();
  } else {
    $(`#delete_last_chap_btn_${partieIndex}`).show();
  }
}

$(document).ready(function() {
  // Auto-create first partie on load
  addNewPartie();
  // After initial creation: ensure correct visibility states
  $(`#delete_last_chap_btn_1`).hide();
  updateRemovePartieButtonsVisibility();
});
</script>