# STI - Projet 1 - Manuel 
## Auteurs : CIANI Antony, HERNANDEZ Thomas



### Installation:

- Copier les fichiers dans le dossier html de la VM
- Lancer le script initdatabase.php pour créer et peupler la base de données (cette page devrait être supprimée du serveur par la suite)
- Accéder à la page d'accueil index.php 
- initdatabase.php crée 3 utilisateurs : 
	- username / mot de passe / role / compte actif
	- admin@sti.ch / admin / admin / oui
	- alice@sti.ch / 1234 / simple user / oui
	- bob@sti.ch / 4567 / simple user / non
	
	
### Utilisation:

- Se loguer avec un des comptes utilisateurs, si le login réussit, vous êtes redirigé vers la page de récéption des messages. Elle permet de consulter les messages reçus, d'y répondre ou de les supprimer.
- L'onglet Envoi permet d'envoyer un message à un autre utilisateur déjà enregistré en le séléctionnant dans la liste déroulante
- L'onglet Compte permet de changer son propre mot de passe
- L'onglet Admin, uniquement accessible aux admnistrateurs permet 
	- d'ajouter un utilisateur et de définir son role et la validité de son compte (attention le nom d'utilisateur est un email)
	-  de supprimer un utilisateur déjà enregistré via le menu déroulant 
	-  de modifier les attributs d'un utilisateur existant (veillez à renseigner tous les champs)