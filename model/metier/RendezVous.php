<?php

class RendezVous
{
    // Statuts possibles (une seule graphie, utilisée partout)
    public const STATUT_EN_ATTENTE = 'en_attente';
    public const STATUT_CONFIRME   = 'confirmé';
    public const STATUT_ANNULE     = 'annulé';

    private ?int $idRdv = null;
    private string $dateRdv;
    private string $heureRdv;
    private string $statut;
    private string $message;

    private string $nomClient;
    private string $emailClient;
    private string $telephone;
    private Service $service;

    public function __construct(int $idRdv, string $dateRdv, string $heureRdv, Service $service, string $statut = self::STATUT_EN_ATTENTE, string $message = '', string $nomClient = '', string $emailClient = '', string $telephone = '') {
        $this->idRdv = $idRdv;
        $this->dateRdv = $dateRdv;
        $this->heureRdv = $heureRdv;
        $this->service = $service;
        $this->statut = $statut;
        $this->message = $message;
        $this->nomClient = $nomClient;
        $this->emailClient = $emailClient;
        $this->telephone = $telephone;
    }

    public function getNomClient(): string { return $this->nomClient; }
    public function getEmailClient(): string { return $this->emailClient; }
    public function getTelephone(): string { return $this->telephone; }

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
        $this->statut = self::STATUT_CONFIRME;
    }

    public function annuler(): void {
        $this->statut = self::STATUT_ANNULE;
    }

    
}
