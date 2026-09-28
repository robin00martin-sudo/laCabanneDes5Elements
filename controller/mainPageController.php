<?php

class mainPageController{
    public function afficherFormulaire(): void {

        /*affiche la page principale du sie*/
        require __DIR__ . '\..\view\mainPage.php';
        exit;
    }
}