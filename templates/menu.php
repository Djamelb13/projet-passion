
    <!-- Bouton pour activer le menu déroulant en version mobile -->
    <button class="d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">Menu</button>

    <div class="container-fluid px-5 py-5">
      <div class="row">
        <!-- Menu d'onglets Bootstrap -->
        <!-- Menu d'onglets Bootstrap -->
        <ul class="nav nav-pills flex-column col-2 d-none d-xl-block sidenav" id="myTabs">
          <h1>Menu de navigation</h1>
          <li class="nav-item p-2">
            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">Ma collection</a>
          </li>
          <li class="nav-item p-2">
            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">Market store</a>
          </li>
          <li class="nav-item p-2">
            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">Collection zone</a>
          </li>
          <h1>Guide d'utilisation</h1>
          <li class="nav-item"><a href="#" class="nav-link p-3" data-bs-toggle="tab" href="#faq" role="tab">FAQ</a></li>
          <li class="nav-item"><a href="#" class="nav-link p-3" data-bs-toggle="tab" href="#guide" role="tab">Guide d'utilisation</a></li>
          <li class="nav-item"><a href="#" class="nav-link p-3" data-bs-toggle="tab" href="#mentions" role="tab">Mentions légales</a></li>
        </ul>

        <!-- Menu de navigation masqué en version mobile -->
        <div class="collapse bg-warning w-100 position-fixed h-100 top-0 start-0 z-index-9999 collapsing" id="navMenu">
          <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Fermer"></button>
          <ul class="nav nav-pills flex-column">
            <li class="nav-item p-2">
              <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">Ma collection</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">Market store</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">Collection zone</a>
            </li>
            <h1>Guide d'utilisation</h1>
            <li class="nav-item"><a href="#" class="nav-link p-3">FAQ</a></li>
            <li class="nav-item"><a href="#" class="nav-link p-3">Guide d'utilisation</a></li>
            <li class="nav-item"><a href="#" class="nav-link p-3">Mentions légales</a></li>
          </ul>
        </div>

        <div class="vr vr-blurry g-0 d-none d-xl-block" style="height: 400px"></div>

        <!-- Contenu des onglets -->
        <div class="tab-content col-6" id="myTabsContent">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel">
            <h2>Onglet 1</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dignissimos dolor ea accusamus numquam accusantium quas consequatur
              nisi cum sed explicabo quasi magni, nostrum obcaecati temporibus? Error dignissimos nihil natus!
            </p>
          </div>
          <div class="tab-pane fade" id="tab2" role="tabpanel">
            <h2>Onglet 2</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia culpa molestiae magnam deleniti inventore impedit neque odit labore magni
              assumenda, repellat, commodi sint ullam perspiciatis! Animi quibusdam quaerat in voluptate?
            </p>
          </div>
          <div class="tab-pane fade" id="tab3" role="tabpanel">
            <h2>Onglet 3</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, aliquid nemo placeat alias, quo numquam voluptates quas similique
              voluptatum omnis minus est quibusdam velit culpa distinctio iure possimus perspiciatis? Asperiores.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusion des fichiers JavaScript Bootstrap (jQuery requis) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>
    <script src="app.js"></script>

