<?php
/**
 * Horaires d'ouverture et calcul des créneaux de rendez-vous.
 * À garder cohérent avec les horaires affichés dans la section « Contact » de la page vitrine.
 */
class Horaires
{
    /** Pas entre deux débuts de rendez-vous possibles (minutes). */
    public const PAS = 30;

    /** Plages d'ouverture par jour ISO (1 = lundi … 7 = dimanche). */
    private const PLAGES = [
        1 => [['10:30', '18:00']],
        2 => [['10:30', '13:30'], ['15:30', '19:30']],
        3 => [['10:00', '14:00']],
        4 => [],                                   // jeudi : fermé
        5 => [['10:30', '19:00']],
        6 => [['10:00', '14:00']],
        7 => [],                                   // dimanche : fermé
    ];

    /** Vrai si la chaîne est une date réelle AAAA-MM-JJ. */
    public static function dateValide(string $date): bool
    {
        $d = DateTime::createFromFormat('!Y-m-d', $date);
        return $d !== false && $d->format('Y-m-d') === $date;
    }

    public static function plagesDuJour(string $date): array
    {
        if (!self::dateValide($date)) {
            return [];
        }
        $jour = (int) (new DateTime($date))->format('N');
        return self::PLAGES[$jour];
    }

    /**
     * Débuts de rendez-vous possibles ce jour-là pour un soin de $dureeMinutes :
     * toutes les 30 minutes dans une plage d'ouverture, à condition que le soin
     * se termine avant la fermeture.  Ex : ['10:30', '11:00', …]
     */
    public static function creneauxPossibles(string $date, int $dureeMinutes): array
    {
        $creneaux = [];
        foreach (self::plagesDuJour($date) as [$ouverture, $fermeture]) {
            $debut = new DateTime("$date $ouverture");
            $limite = new DateTime("$date $fermeture");
            while ((clone $debut)->modify("+$dureeMinutes minutes") <= $limite) {
                $creneaux[] = $debut->format('H:i');
                $debut->modify('+' . self::PAS . ' minutes');
            }
        }
        return $creneaux;
    }

    /** Heure de fin (HH:MM:SS) d'un rendez-vous commençant à $heure. */
    public static function heureFin(string $heure, int $dureeMinutes): string
    {
        return (new DateTime("1970-01-01 $heure"))->modify("+$dureeMinutes minutes")->format('H:i:s');
    }

    /**
     * Vrai si [debut, fin[ chevauche l'un des rendez-vous existants.
     * @param array $existants lignes ['heure_rdv' => 'HH:MM:SS', 'heure_fin' => 'HH:MM:SS']
     */
    public static function chevauche(string $debut, string $fin, array $existants): bool
    {
        $debut = (new DateTime("1970-01-01 $debut"))->format('H:i:s');
        foreach ($existants as $rdv) {
            if ($debut < $rdv['heure_fin'] && $fin > $rdv['heure_rdv']) {
                return true;
            }
        }
        return false;
    }
}
