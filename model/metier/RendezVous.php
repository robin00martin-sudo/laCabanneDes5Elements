<?php

class RendezVous
{
    private ?int $idRdv = null;
    private string $dateRdv;
    private string $heureRdv;
    private string $statut;
    private string $message;

    private Utilisateur $utilisateur;
    private Service $service;

    public function __construct(int $idRdv, string $dateRdv, string $heureRdv, Service $service, string $statut = "en attente", string $message = '') {
        $this->idRdv = $idRdv;
        $this->dateRdv = $dateRdv;
        $this->heureRdv = $heureRdv;
        $this->service = $service;
        $this->statut = $statut;
        $this->message = $message;
    }

    //GETTER
    public function getIdRdv(): ?int {
        return $this->idRdv;
    }

    public function getDateRdv(): string {
        return $this->dateRdv;
    }

    public function getHeureRdv(): string {
        return $this->heureRdv;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function getMessage(): string {
        return $this->message;
    }



    public function getService(): Service {
        return $this->service;
    }


    //SETTER
    public function setIdRdv(int $idRdv): void {
        $this->idRdv = $idRdv;
    }

    public function setDateRdv(string $dateRdv): void {
        $this->dateRdv = $dateRdv;
    }

    public function setHeureRdv(string $heureRdv): void {
        $this->heureRdv = $heureRdv;
    }

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }
    
    public function setService(Service $service): void {
        $this->service = $service;
    }

    //FONCTION POUR LE STATUT
    public function confirmer(): void {
        $this->statut = "confirmé";
    }

    public function annuler(): void {
        $this->statut = "annulé";
    }

    
}
