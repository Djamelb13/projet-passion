<?php  
echo $_SERVER['DOCUMENT_ROOT']. '/templates/formulaire_game.php'; ?>

<div class="container  d-flex justify-content-center ">
    <div class=" row w-100 d-flex justify-content-center">
        
        <div class="col-8 col-xl-3 btnadd btn  mx-5 " type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un jeu</div>
        <div class="col-8 col-xl-3 btnedit btn mx-5 ">Editer collection</div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content bgcf">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout d'un jeu</h5>
        <button  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php include_once($_SERVER['DOCUMENT_ROOT'] .'/templates/formulaire_game.php'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<div class="contenupage">
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/templates/jaquette.php'); ?>
<?php  
echo $_SERVER['DOCUMENT_ROOT']. '/templates/jaquette.php'; ?></div>
<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>