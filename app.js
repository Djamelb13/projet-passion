console.log("coucou");
      var navMenu = document.getElementById("navMenu");

      navMenu.addEventListener("show.bs.collapse", function () {
        console.log('ici ca marche');
        navMenu.classList.remove("collapsed");
        navMenu.classList.add("collapsing");
      });

      navMenu.addEventListener("hide.bs.collapse", function () {
        console.log('et la aussi');
        navMenu.classList.remove("collapsing");
        navMenu.classList.add("collapsed");
      });