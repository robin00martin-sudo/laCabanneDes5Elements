# laCabanneDes5Elements
Projet réaliser pour un particulier lors d'un stage, réaliser un site vitrine pour présenter la personne, qui elle est, ce qu'elle fait, où elle est, ses tarifs et prestations, qu'elle est son parcours professionnel.

A préciser le développement d'une logique pour prise de rendez vous avec formulaire et communication avec une BDD à été réalisé mais arrêté à la demande du particulier cependant elle existe toujours -> ligne à décommenter n°28

Structure en MVC avec comme langage du PHP, HTML, CSS, JavaScript.

BDD.sql -> script pour la base de donnée même si potentiellement imcompléte

Index.php -> point d'entrée

controller -> redirection en fonction du choix de l'utilisateur

model/dao et model/metier -> logique pour la récupération et la manipulation d'objet mais abandonnée car cité plus tôt

config/Database -> connexion à la BDD

view -> on retrouvera principalement la page vitrine mais aussi le CSS et le JavaScript.
     -> Contact.php est une ébauche pour rendre le formulaire de contact fonctionnel. 
     -> rdv/form.php est la vue pour le formulaire de prise de RDV. 
