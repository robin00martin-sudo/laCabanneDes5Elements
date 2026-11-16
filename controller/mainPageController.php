<?php
class mainPageController
{
    public function afficherFormulaire(): void
    {
        require __DIR__ . '/../view/mainPage.php';
        exit;
    }
}
