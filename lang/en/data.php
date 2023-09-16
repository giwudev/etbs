<?php

return [
    /*
    |--------------------------------------------------------------------------
    |   UTILISATEUR
    |--------------------------------------------------------------------------
    */
    'id_user'=>'Utilisateur',
    'name'=>'Nom',
    'prenom'=>'Prénom(s)',
    'email'=>'E-mail',
    'tel_user'=>'Téléphone',
    'other_infos_user'=>'Autres infos.',
    'id_role'=>'Rôle',
    'id_ini'=>'Initiateur',
    'is_active'=>'Etat du compte',
    'entite_id'=>'Entité',

    /*
    |--------------------------------------------------------------------------
    |   MENU
    |--------------------------------------------------------------------------
    */
    'id_menu'=>'Identifiant',
    'libelle_menu'=>'Menu',
    'menu_icon'=>'Icône',
    'num_ordre'=>'N° Ordre',
    'order_ss'=>'order_ss',
    'route'=>'Route',
    'titre_page'=>'Titre page',
    'topmenu_id'=>'Menu parent',
    'user_id'=>'Initiateur',
    'architecture'=>'Architecture',
    'controler'=>'Contrôler',
    'elmt_menu'=>'Appartient au menu',
    'role' => 'Rôle',
    'libelle_action'=>'Action',
    'dev_action'=>'Dev Action',
    /*
    |--------------------------------------------------------------------------
    |   ROLE
    |--------------------------------------------------------------------------
    */
    'id_role'=>'Identifiant',
    'libelle_role'=>'Rôle',
    'sous_role'=>'Sous Rôle',
    'user_save_id'=>'Initiateur',
    'libelle_trace'=>'Trace',
    'created_at'=>'Date opération',


	/*
	|--------------------------------------------------------------------------
	|   ECOLE
	|--------------------------------------------------------------------------
	*/
	'id_eco'=>'Identifiant',
	'nom_eco'=>'Nom',
	'sigle_eco'=>'Sigle',
	'adres_eco'=>'Adresse',
	'ville_eco'=>'Ville',
	'CodePos_eco'=>'Code postal',
	'pays_eco'=>'Pays',
	'tel_eco'=>'Contact',
	'email_eco'=>'E-mail',
	'directeur_eco'=>'Directeur',
	'niveau_educ_eco'=>'Niveau éducation',

	/*
	|--------------------------------------------------------------------------
	|   ANNEESCO
	|--------------------------------------------------------------------------
	*/
	'id_annee'=>'Identifiant',
	'libelle_annee'=>'Année Scolaire',
	'annee_debut'=>'Année début',
	'annee_fin'=>'Année fin',
	'statut_annee'=>'Statut',
	'init_id'=>'Initiateur',
	'etablis_id'=>'Etablissement',

	/*
	|--------------------------------------------------------------------------
	|   TRIMSEM
	|--------------------------------------------------------------------------
	*/
	'id_trimSem'=>'Identifiant',
	'libelle_trimSem'=>'Libellé',
	'statut_trimSem'=>'Statut',
	'annee_id'=>'Année',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   CLASSE
	|--------------------------------------------------------------------------
	*/
	'id_clas'=>'Identifiant',
	'libelle_clas'=>'Classe',
	'annee_id'=>'Année',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   PROMOTION
	|--------------------------------------------------------------------------
	*/
	'id_pro'=>'Identifiant',
	'libelle_pro'=>'Promotion',
	'class_id'=>'Classe',
	'init_id'=>'Initiateur',


	/*
	|--------------------------------------------------------------------------
	|   DISCIPLINE
	|--------------------------------------------------------------------------
	*/
	'id_disci'=>'Identifiant',
	'code_disci'=>'Code',
	'libelle_disci'=>'Discipline',
	'ecole_id'=>'Ecole',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   ELEVE
	|--------------------------------------------------------------------------
	*/
	'id_el'=>'Identifiant',
	'nom_el'=>'Nom',
	'prenom_el'=>'Prénom(s)',
	'matricule_el'=>'Matricule',
	'date_nais_el'=>'Date naissance',
	'sexe_el'=>'Sexe',
	'photo_el'=>'Photo',
	'tuteur_el'=>'Tuteur',
	'email_el'=>'E-mail',
	'tel_el'=>'Contact',
	'ecole_id'=>'Ecole',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   EMPLOITEMP
	|--------------------------------------------------------------------------
	*/
	'id_empl'=>'Identifiant',
	'heure_debut'=>'Heure début',
	'heure_fin'=>'Heure fin',
	'jour_semaine'=>'Jour semaine',
	'discipline_id'=>'Discipline',
	'promotion_id'=>'Promotion',
	'annee_id'=>'Année',
	'prof_id'=>'Professeur',
	'init_id'=>'Initiateur',

	/*
	|--------------------------------------------------------------------------
	|   FREQUENTER
	|--------------------------------------------------------------------------
	*/
	'id_freq'=>'Identifiant',
	'eleve_id'=>'Elève',
	'promotion_id'=>'Promotion',
	'nbre_heure_abs'=>'Nbre d\'heures d\'ABS',
	'nbre_heure_justifie'=>'Nbre d\'heures justifiée',
	'nbre_heure_non_justifie'=>'Nbre d\'heures non justifiée',
	'conduite'=>'Conduite',

	/*
	|--------------------------------------------------------------------------
	|   APPELER
	|--------------------------------------------------------------------------
	*/
	'id_appel'=>'Identifiant',
	'emploi_id'=>'Emploi',
	'eleve_id'=>'Elève',
	'init_id'=>'Initiateur',
	'etat_appel'=>'Présence',
	'justifier'=>'Justifier (Oui / Non)',
	'motif_just'=>'Motif',
	'fichier_justif'=>'Pièce jointe justificative',

	/*
	|--------------------------------------------------------------------------
	|   DEFINIPROMOTION
	|--------------------------------------------------------------------------
	*/
	'id_def'=>'Identifiant',
	'prof_id'=>'Professeur',
	'promo_id'=>'Promotion',

	//data-giwu-cms


    'not_found_direc' => '--',
    'not_found' => 'Non trouvé',
    'img_defaut' => 'defaut.jpg',

    // Message
    'MsgCheckPage' => 'Vous n\'êtes pas autorisé <br/>à accéder à cette page.',
    'AucunInfosTrouve' => '&nbsp;Aucun enregistrement trouvé.',
    'titre_delete' => 'Suppression',
    'titre_transmettre' => 'Transmettre cette information',
    'titre_publier' => 'Publier cette information',
    'titre_Arreterdepublier' => 'Arrêter la publication de cette information',
    'infos_error' => 'Une erreur est survenue lors du chargement de l\'enregistrement de l\'utilisateur. Veuillez contactez l\'administrateur',
    'infos_add' => 'Enregistrement effectué avec succès.',
    'infos_update' => 'Modification effectuée avec succès.',
    'infos_delete' => 'Un élément supprimé avec succès',
    'infos_trans' => 'Un élément transmis avec succès',
    'infos_go' => 'Publication effetuée avec succès',
    'infos_stop' => 'Publication arrêtée avec succès',
    'MsgCheckPage' => 'Vous n\'êtes pas autorisé <br/>à accéder à cette page.',
    'MsgCheckApp' => 'Votre compte est désactivité. Veuillez contactez l\'administrateur.',

    //CSS
    //#212529 : Noire
    'colorTemplate' => '#113ac3',
    'bar_page_stylePdf' => ' <style>
        .footer {width: 100%; font-size:10px; text-align: center;position: fixed;}
        .footer {bottom: 0px;}
        .pagenum:before {content: counter(page);}
    </style> ',

    'stylePdf' => ' <style>
        .footer {width: 100%;text-align: right;position: fixed;}
        .footer {bottom: 0px;}
        .pagenum:before {content: counter(page);}

        .td{padding: 3px 3px 3px 3px; }
        .table {border-collapse:collapse;}
        .th,.td {border:1px solid black;}
    </style> ',
    'signaturePdf' => 'Imprimé par '.Config('app.name').' Page ',
    'styleLignePdf' => '#b4b4a4',
];
