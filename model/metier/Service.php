<?php

class Service
{
    private ?int $idService = null;
    private string $nomService;
    private string $description;
    private int $duree; // en minutes

    public function __construct( int $idService, string $nomService, string $description, int $duree) {
        $this->idService = $idService;
        $this->nomService = $nomService;
        $this->description = $description;
        $this->duree = $duree;
    }

    //GETTER
    public function getIdService(): ?int {
        return $this->idService;
    }

    public function getNomService(): string {
        return $this->nomService;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDuree(): int {
        return $this->duree;
    }

    //SETTER
    public function setIdService(int $idService): void {
        $this->idService = $idService;
    }

    public function setNomService(string $nomService): void {
        $this->nomService = $nomService;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDuree(int $duree): void {
        $this->duree = $duree;
    }
}
