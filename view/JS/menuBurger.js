/*
  Ce fichier gère l’ouverture et la fermeture du menu "burger"
  (le menu latéral qui apparaît sur mobile ou petit écran).

  Objectif :
  - ouvrir le menu quand on clique sur l’icône ☰
  - fermer le menu quand on clique ailleurs sur la page
*/


/*
  Fonction appelée lorsqu’on clique sur l’icône du menu burger
*/
function toggleMenu() {

  /*
    Récupération des éléments de la page :
    - la sidebar : le menu latéral
    - le burger : l’icône ☰
  */
  const sidebar = document.getElementById("sidebar");
  const burger = document.querySelector(".burger");

  /*
    Ajoute ou enlève la classe "active" sur la sidebar.

    - Si le menu est fermé → il s’ouvre
    - S’il est ouvert → il se ferme

    L’effet visuel dépend du CSS.
  */
  sidebar.classList.toggle("active");

  /*
    Ligne optionnelle (désactivée) :
    pourrait servir à animer l’icône burger
  */
  // burger.classList.toggle("active");
}


/*
  Écoute tous les clics effectués sur la page
*/
document.addEventListener("click", function (e) {

  /*
    Récupération du menu et du bouton burger
  */
  const sidebar = document.getElementById("sidebar");
  const burger = document.querySelector(".burger");

  /*
    Si :
    - le menu est ouvert
    - ET que le clic n’est pas à l’intérieur du menu
    - ET que le clic n’est pas sur l’icône burger

    Alors :
    → on ferme le menu
  */
  if (
    sidebar.classList.contains("active") &&
    !sidebar.contains(e.target) &&
    !burger.contains(e.target)
  ) {
    sidebar.classList.remove("active");

    /*
      Ligne optionnelle (désactivée) :
      permettrait aussi de réinitialiser l’icône burger
    */
    // burger.classList.remove("active");
  }
});
