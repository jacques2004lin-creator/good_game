<?php
session_start();
include "good_game_db.php";
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';
$section = isset($_GET['section']) ? $_GET['section'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Game - Support Officiel</title>
    <link href="css/support.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        /* Styles rapides pour le formulaire de ticket et les CGV */
        .ticket-form { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
        .ticket-form input, .ticket-form textarea, .ticket-form select {
            padding: 12px; border-radius: 8px; border: 1px solid #333; background: #1a1a1a; color: white;
        }
        .btn-submit { background: var(--gaming-red, #ff4655); color: white; border: none; padding: 15px; cursor: pointer; font-weight: bold; border-radius: 8px; }
        .btn-ticket-open { display: block; width: fit-content; margin: 30px auto; padding: 15px 30px; background: #ff4655; color: white; text-decoration: none; border-radius: 50px; font-weight: bold; }
        .cgv-content { line-height: 1.6; color: #ccc; }
        .cgv-content h2 { color: white; margin-top: 25px; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .cgv-content h3 { color: var(--gaming-red, #ff4655); margin-top: 20px; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>

    <?php if($page == 'accueil'): ?>
        <h1 class="page-title">Support</h1>
        <div class="support-container">
            <a href="?page=commande" class="support-carte">
                <i class="fa-solid fa-box-open carte-icone"></i>
                <h3 class="carte-titre">Commandes et produits</h3>
                <p class="carte-texte">Assistance pour l'activation des clés et les informations sur les produits.</p>
            </a>

            <a href="?page=compte" class="support-carte">
                <i class="fa-solid fa-user carte-icone"></i>
                <h3 class="carte-titre">Compte et sécurité</h3>
                <p class="carte-texte">Assistance à la gestion des comptes et à la sécurité.</p>
            </a>

            <a href="?page=paiement" class="support-carte">
                <i class="fa-solid fa-credit-card carte-icone"></i>
                <h3 class="carte-titre">Paiement</h3>
                <p class="carte-texte">Aide pour tout problème ou question lié au paiement.</p>
            </a>
        </div>

        <div class="contact">
            <div class="contact-carte">
                <p class="carte-texte">Contactez-nous : <a href="mailto:support@goodgame.com" class="contact-lien">support@goodgame.com</a> (faux mail)</p>
            </div>
        </div>

<?php elseif($page == 'confidentialite'): ?>
    <a href="?page=accueil" class="btn-back"> < Retour</a>
    <h1>Politique de confidentialité</h1>

    <div class="content-box cgv-content">
        <h2>POLITIQUE DE CONFIDENTIALITE</h2>

        <h3>PREAMBULE</h3>
        <p>
       Le respect de la vie privée et des données à caractère personnel est pour ories une priorité, raison pour laquelle nous nous engageons à traiter celles-ci dans le plus strict respect de la Loi Informatique et Libertés du 6 janvier 1978 (ci-après « loi IEL ») modifiée et du Règlement (UE) général sur la protection des données du 27 avril 2016 (ci-après « RGPD »).
       Cette politique de confidentialité s’adresse aux Clients de Good Game, ayant pour objectif de vous informer sur la manière dont nous collectons et traitons vos informations personnelles.


        <h3>A propos</h3>
        <p>Ce site web est exploité par Aliasing DMCC, une société privée constituée en vertu des lois des Émirats arabes unis sous le numéro d'enregistrement DMCC179752 et dont le siège social est situé à l'adresse suivante : Office Unit 1204, Jumeirah Business Center 3, Cluster Y, Jumeirah Lakes Towers, Dubaï, Emirats Arabes Unis (ci-après « Instant Gaming », « nous », « notre », « nos »).
          Le site web www.instant-gaming.com et nos applications mobiles (ci-après « site Web ») répertorient divers contenus numériques, par exemple des jeux téléchargeables et d'autres contenus téléchargeables (ci-après « Contenu »). Nous vendons sur le site Web des clés officielles, émises par l'éditeur et/ou le développeur du Contenu concerné (ci-après « Développeur »), qui permettent à l'utilisateur de déverrouiller, d'accéder et de télécharger le Contenu concerné à partir de la plateforme du Développeur (ci-après « Code(s) »). Nous ne sommes pas le Développeur du Contenu et nous ne possédons ni n'exploitons la plateforme du Développeur.
        </p>

        <h3>1. À qui s'applique cette politique de confidentialité ?</h3>
        <p>
        Cette politique de confidentialité s'applique aux personnes qui accèdent, naviguent et utilisent notre site Web. Son objectif est de vous informer sur la manière dont nous collectons et traitons vos données personnelles lorsque vous utilisez notre site Web. Nous collectons des données personnelles lorsque vous accédez à notre site Web, vous vous inscrivez chez nous, vous nous contactez, vous nous envoyez des commentaires et des avis sur les produits, vous achetez des codes et d'autres produits via notre site Web, vous publiez du Contenu sur notre site Web, vous demandez des mises à jour marketing et vous participez à des promotions, des enquêtes, des programmes d'affiliation ou de partenariat via notre site Web.
        Si vous êtes partenaire d'Instant Gaming, la présente politique de confidentialité s'applique à vous comme à tout autre utilisateur du site Web. Cependant, nous traiterons également certaines données à caractère personnel vous concernant afin d'exécuter notre contrat de partenariat avec vous.
        Il est important que vous lisiez la présente politique de confidentialité ainsi que toute autre politique de confidentialité que nous pouvons fournir à des occasions spécifiques lorsque nous collectons ou traitons des données personnelles vous concernant, afin que vous sachiez comment et pourquoi nous utilisons vos données personnelles.
        </p>

        <h3>2. Qui est le responsable de traitement ?</h3>
        <p>
       Dans le cadre de la fourniture des différents Services, Instant Gaming jouera auprès de vous le rôle de « Responsable de traitement » au sens du RGPD :
       Aliasing DMCC,
Enregistrée au DMCC sous le numéro 179752
Unit 1204, Jumeirah Business Center 3, Cluster Y, Jumeirah Lakes Towers, Dubaï, Emirats Arabes Unis
        </p>

        <h3>3. Quels types de donnees personnelles traitons-nous ?</h3>
        <p>
        Les « données personnelles » désignent les informations relatives à une personne physique qui permettent de l'identifier ou de la rendre identifiable, de manière directe ou indirecte.
        Dans la présente politique de confidentialité, nous utilisons le terme « traitement » pour une opération, ou ensemble d’opérations, portant sur des données personnelles, quel que soit le procédé utilisé (collecte, enregistrement organisation, conservation, adaptation, modification, extraction consultation, utilisation, communication par transmission ou diffusion ou toute autre forme de mise à disposition, rapprochement).
        Les données personnelles que nous collectons à votre sujet dépendent des activités menées sur notre site Web. A titre d’exemple, nous collectons différents types de données personnelles selon que vous créez un compte utilisateur, achetez des codes ou naviguez simplement sur le site Web. En règle générale, nous collectons et traitons les types de données personnelles suivants :
        </p>
    <ul>
        <li>Les données d'identité et de contact comprennent votre nom, votre adresse postale, votre adresse e-mail, votre date de naissance et toutes les données personnelles fournies lorsque vous nous contactez. Dans le cas des partenaires Instant Gaming, toutes les données personnelles fournies dans le cadre de notre partenariat. Dans certains cas spécifiques, la copie d’un titre d’identité.</li>
        <li>Les données financières comprennent les informations nécessaires au traitement des paiements et à la prévention de la fraude, et en ce qui concerne les partenaires Instant Gaming, cela inclut toutes les informations relatives à la facturation. Si vous nous payez par carte bancaire, cela inclut les numéros de carte de paiement, le(s) nom(s) du(des) titulaire(s) de la carte, les codes de sécurité et les dates d'expiration. Pour tous les types de paiement, nous traiterons les détails de paiement reçus de l'émetteur de votre carte bancaire ou du fournisseur du mode de paiement que vous avez choisi ;</li>
        <li>Les données transactionnelles comprennent les détails relatifs aux paiements que vous avez effectués et reçus, ainsi que d'autres détails concernant les produits et services que vous avez achetés chez nous. Dans le cas des partenaires Instant Gaming, cela inclut les données personnelles relatives à l'administration, à la gestion et à l'exécution de notre relation commerciale.</li>
        <li>Les données techniques peuvent inclure l'adresse IP, le type et la version du navigateur, le fuseau horaire et l'emplacement, les types et versions des plug-ins du navigateur, le système d'exploitation et la plateforme, ainsi que d'autres technologies présentes sur les appareils que vous utilisez pour accéder à notre site Web.</li>
        <li>Les données d'utilisation comprennent des informations sur la manière dont vous utilisez le site Web, telles que les services que vous consultez ou recherchez, les temps de réponse des pages, les erreurs de téléchargement, la durée des visites et les informations sur l'interaction avec les pages (telles que le défilement, les clics et les survols de souris) ; </li>
        <li>Les données de marketing et de communication comprennent vos préférences en matière de réception de communications marketing de notre part et vos préférences en matière de communication.</li>
        </ul>
    <p>Nous collectons, utilisons et partageons également des données agrégées telles que des données statistiques ou démographiques à diverses fins. Les données agrégées peuvent être dérivées de vos données personnelles, mais ne sont pas considérées comme des données personnelles au sens de la loi, car elles ne révèlent pas directement ou indirectement votre identité.
       A titre d’exemple, nous pouvons agréger vos données d'utilisation afin de calculer le pourcentage d'utilisateurs accédant à une fonctionnalité spécifique d'un site Web. Toutefois, si nous combinons ou relions des données agrégées à vos données personnelles de manière qu'elles puissent vous identifier directement ou indirectement, nous traitons les données combinées comme des données personnelles qui seront utilisées conformément à la présente politique de confidentialité.
       Nous ne collectons aucune catégorie particulière de données personnelles vous concernant, relevant de l'origine raciale ou ethnique, des opinions politiques, des convictions religieuses ou philosophiques ou de l'appartenance syndicale, des données génétiques, des données biométriques visant à identifier de manière unique une personne ou des données concernant la santé ou l'orientation sexuelle. Nous ne collectons pas non plus d'informations sur les condamnations pénales et les infractions. Veuillez ne pas fournir sur le site Web ou dans toute communication avec nous des catégories particulières de données à caractère personnel et/ou des données à caractère personnel relatives à des condamnations pénales et à des infractions vous concernant, ni aucune donnée à caractère personnel concernant toute autre personne.
       Lorsque nous devons collecter des données à caractère personnel en vertu de la loi ou des dispositions d'un contrat que nous avons conclu avec vous (par exemple, en vertu de nos conditions générales de vente), et que vous ne fournissez pas ces données à caractère personnel lorsque cela vous est demandé, nous pouvons ne pas être en mesure d'exécuter le contrat que nous avons conclu ou que nous essayons de conclure avec vous.
       Au moment de la collecte de vos données personnelles, nous vous informerons si vous devez fournir ces données pour utiliser le site Web ou l'un de nos services, et si la fourniture des données personnelles que nous vous demandons est facultative.</p>

        <h3>4. Comment vos donnees personnelles sont-elles reçues ?</h3>
        <p>
    Nous pouvons recevoir vos données personnelles par divers moyens, notamment :
        </p>
    <ul>
        <li>Interactions directes: vous pouvez nous fournir vos données d'identité et de contact, vos données de profil, vos données financières et vos données de transaction en créant et en gérant votre compte utilisateur, en achetant des Codes, en utilisant des crédits Instant Gaming et des cartes-cadeaux, en sélectionnant vos préférences, en fournissant des avis sur les produits, en remplissant des formulaires sur le site Web, en partageant des informations sur les produits ou en correspondant avec nous par courrier postal, téléphone, e-mail, SMS, réseaux sociaux ou autres moyens. Cela inclut les données personnelles que vous fournissez lorsque vous participez à un concours, une promotion ou une enquête, lorsque vous nous faites part de vos commentaires ou lorsque vous nous contactez.</li>
        <li>Technologies ou interactions automatisées: lorsque vous interagissez avec notre site Web, nous collectons des données techniques et des données d'utilisation, notamment des informations sur votre appareil, vos actions et habitudes de navigation, vos recherches, les sections consultées, les données de trafic, les journaux Web et autres données de communication, ainsi que les ressources auxquelles vous accédez. Nous collectons ces données personnelles à l'aide de cookies, de codes de suivi, de journaux de serveur et d'autres technologies similaires. Nous pouvons également recevoir des données techniques si vous visitez d'autres sites Web utilisant nos cookies.</li>
        <li>Sources tierces: nous pouvons également recevoir des données personnelles vous concernant de la part de tiers, comme indiqué ci-dessous :</li>
        <li>i. Données de transaction, provenant des développeurs, confirmant l'utilisation des Codes que vous achetez chez nous.</li>
        <li>ii. Données techniques provenant de notre fournisseur d'analyses, Google Analytics.</li>
        <li>iii. Données d'identité et de contact, données financières et données de transaction provenant de fournisseurs de services de paiement tels que PayPal, HiPay et Paysafecard.</li>
         <li>iv. Données d'identité et de contact, données de profil, données financières et données de transaction provenant de Transactial Limited, notre filiale irlandaise qui fournit divers services liés à l'achat et à l'échange de Codes, notamment le traitement des paiements en fonction du mode de paiement sélectionné lors de l'achat des Codes, le service client et l'assistance technique.</li>
         <li>v. Données d'identité et de contact provenant de sources accessibles au public, telles que le registre des sociétés.</li>
         <li>vi. Données d'identité et de contact (votre adresse e-mail et votre nom) lorsque vous vous connectez en utilisant les services de Facebook ou Google.</li>
        </ul>
    </div>

    <?php elseif($page == 'cgv'): ?>
        <a href="?page=accueil" class="btn-back"> < Retour</a>
        <h1>Conditions Générales de Vente</h1>
        <div class="content-box cgv-content">
            <p><strong>CODES D'ACCÈS AU CONTENU NUMÉRIQUE - CONDITIONS GÉNÉRALES DE VENTE</strong></p>
            <p>Veuillez lire attentivement les conditions générales importantes suivantes avant d'acheter des codes pour des jeux et/ou du contenu numériques via ce site web.</p>

            <h3>1. Qui sommes-nous ?</h3>
            <p>1.1. Les présentes constituent les conditions générales (« Conditions ») selon lesquelles Aliasing DMCC, une société privée constituée en vertu des lois des Émirats arabes unis sous le numéro d’enregistrement DMCC179752 et ayant son siège social à l’adresse suivante : Office Unit 1204, Jumeirah Business Center 3, Cluster Y, Jumeirah Lakes Towers, Dubaï, Émirats arabes unis (« ories.com », « nous », « notre »), vous vend et vous fournit des codes d’accès à du contenu numérique par le biais du site Good Game et par le biais de nos applications mobiles (« Site web »).</p>
            <p>1.2. Notre site Web propose divers contenus numériques, tels que des jeux et autres contenus téléchargeables (« Contenus »). Nous vendons sur le site Web des clés officielles, émises par l'éditeur et/ou le développeur des Contenus concernés (« Développeur »), permettant à l'utilisateur de déverrouiller, d'accéder et de télécharger ces Contenus depuis la plateforme du Développeur (« Codes »). Nous ne sommes pas le Développeur des Contenus et nous ne possédons ni n'exploitons la plateforme du Développeur. Outre les présentes Conditions, vous pouvez également être soumis au contrat de licence utilisateur final du Développeur et à d'autres conditions relatives à ses Contenus et à sa plateforme.</p>

            <h3>2. Notre société du groupe</h3>
            <p>2.1 L'une des sociétés de notre groupe, Transactial Limited, une société à responsabilité limitée irlandaise immatriculée sous le numéro 664195, numéro de TVA IE3684378BH et dont le siège social est situé à Harcourt Center, Block 4, Harcourt Road, D02 HW77 Dublin, Irlande (Société irlandaise), fournit divers services liés à votre achat et à l'utilisation de vos codes, notamment le traitement de vos paiements en fonction du mode de paiement que vous avez choisi lors de l'achat des codes, le service client, l'assistance technique, la gestion de vos droits d'annulation et l'émission d'un remboursement ou d'un autre paiement, le cas échéant.</p>

            <h3>3. Comment nous contacter</h3>
            <p>3.1. Vous pouvez nous contacter via les liens « Assistance » et « Nous contacter » sur le site web ( https://www.Good game.com/fr/support/), en vous connectant à votre compte utilisateur (défini à la section 4.1) et en créant une demande d'assistance client, ou en nous écrivant à support@Good Game.com . La société irlandaise gère le service client et les demandes d'assistance technique pour le compte ories.</p>
            <p>3.2. Si nous devons vous contacter, nous le ferons à l'adresse électronique que vous avez fournie dans les paramètres de votre compte utilisateur.</p>

            <h3>4. À propos de vous</h3>
            <p>4.1. Pour acheter des codes sur notre site web, vous devez posséder un compte utilisateur valide (« Compte utilisateur »), un moyen de paiement valide que nous acceptons, être autorisé à utiliser ce moyen de paiement (par exemple, qu'il soit à votre nom ou que vous ayez le droit de l'utiliser) et un appareil mobile, ordinateur, télévision, montre connectée ou autre appareil compatible (« Appareil ») permettant d'accéder au contenu et de le télécharger. Vous devez préserver la confidentialité de vos identifiants de compte utilisateur et ne les communiquer à personne.</p>
            <p>4.2. Si la loi de votre pays vous considère comme mineur, vous devez avoir l'autorisation de votre parent ou tuteur légal pour acheter des codes auprès de nous et pour conclure ces conditions.</p>
            <p>4.3. Certains contenus sont soumis à des restrictions d'âge. Par conséquent, les codes d'accès à ces contenus ne seront pas vendus aux personnes n'ayant pas atteint l'âge requis, lorsque nous en avons connaissance. Vous devez respecter toutes les restrictions d'âge applicables à l'achat et à l'utilisation de tout contenu. Si la loi de votre pays vous considère comme mineur, il vous incombe, ainsi qu'à votre parent ou tuteur légal, de veiller à ce que vous achetiez un contenu adapté à votre âge.</p>

            <h3>5. Votre appareil et vos données</h3>
            <p>5.1. Avant de passer votre commande, veuillez vérifier que la configuration matérielle et logicielle de votre appareil vous permet d'accéder au contenu et de le télécharger. Cliquez sur le bouton « Informations » du contenu choisi pour consulter la configuration minimale et recommandée, telle que fournie par le développeur.</p>
            <p>5.2. Vous êtes responsable des frais d'accès ou de données facturés par des tiers (tels que votre fournisseur d'accès Internet et votre opérateur mobile) liés à votre utilisation du Site Web, notamment l'achat de Codes et le téléchargement et l'accès au Contenu. Veuillez vérifier attentivement la taille des fichiers de votre Contenu, car une consommation de données excessive pourrait entraîner un dépassement de votre forfait et des frais supplémentaires.</p>

            <h3>6. Votre vie privée et vos données personnelles</h3>
            <p>6.1. Toutes les données personnelles que vous nous fournissez seront traitées conformément à notre Politique de confidentialité, qui explique quelles données personnelles nous collectons, comment et pourquoi nous les collectons, les stockons, les utilisons et les partageons, ainsi que vos droits relatifs à vos données personnelles. Notre Politique de confidentialité est disponible à l’adresse suivante : https://www.Good Game/fr/politique-de-confidentialite/ .</p>
            <p>6.2. Pour les partenaires souhaitant collaborer avec nous, nous pouvons utiliser les services API de YouTube. Vous serez alors soumis aux conditions d'utilisation de YouTube, accessibles via le lien suivant : ici.</p>

            <h3>7. Notre contrat avec vous</h3>
            <p>7.1. Conditions applicables. En achetant des codes via le Site Web, vous concluez un contrat avec nous pour la fourniture de codes permettant d'accéder au Contenu et de le télécharger depuis la plateforme du Développeur. Vous serez légalement lié par les conditions suivantes :</p>
            <p>7.1.1. les présentes Conditions ;
                7.1.2. nos Conditions d’utilisation... [Texte tronqué pour l'affichage ici, mais complet dans le fichier final]</p>
            <p>7.2. Conditions spécifiques applicables à certains Contenus. Nous vendons des codes d'accès permettant de télécharger des Contenus, mais nous n'en sommes pas le développeur. Il peut être nécessaire de vous rendre sur la plateforme du développeur afin de vérifier votre code (voir section 10) et de télécharger le Contenu concerné. Outre les conditions du présent contrat, vous devez également respecter le contrat de licence utilisateur final du développeur ainsi que les autres conditions relatives à son Contenu et à sa plateforme.</p>

            <h3>8. Informations clés</h3>
            <p>8.1. Nous vendons uniquement des codes pour du contenu téléchargeable... 8.3. Nous ne fournissons aucune mise à niveau ni mise à jour de votre Contenu après l'achat de vos Codes...</p>

            <h3>9. Commander chez nous</h3>
            <p>9.1. Passer une commande... 9.5. Précommandes... Vous pouvez annuler votre précommande de ce code en nous envoyant une demande d'annulation claire et concise par e-mail à l'adresse support@oris.com jusqu'à la réception de cet e-mail vous informant de la disponibilité de votre code dans votre compte utilisateur.</p>

            <h3>10. Accès à votre code et à votre contenu</h3>
            <p>10.1. Utilisation de votre code... 10.3. Compte banni ou fermé sur la plateforme du développeur. Nous ne sommes pas responsables et ne vous rembourserons pas le prix payé pour un code si vous ne pouvez pas l'utiliser ou si votre accès au contenu concerné est refusé, bloqué ou interrompu suite à une exclusion (temporaire ou définitive) de la plateforme du développeur.</p>

            <h3>11. Prix et paiement</h3>
            <p>11.1. Où trouver le prix des codes... 11.4. Modalités et conditions de paiement. La société Irish Company gère, pour notre compte, le traitement de vos paiements selon le mode de paiement sélectionné lors de l'achat de codes.</p>

            <h3>12. Vos droits de résilier le contrat</h3>
            <p>12.1. Résiliation du contrat... 12.2. Droit de rétractation. Vous pouvez annuler votre commande de codes à tout moment dans les 14 jours suivant l'envoi de notre courriel de confirmation. 12.3. Absence de droit de rétractation après validation du Code. En achetant et en utilisant un Code auprès de nous, vous acceptez l'exécution immédiate du présent contrat et renoncez à tout droit de rétractation légal.</p>

            <h3>13. Autorisation d'utiliser le contenu</h3>
            <p>13.1. Licence de contenu. Lorsque vous achetez un Code conformément aux présentes Conditions, vous n'acquérez pas la propriété du Contenu concerné. Vous recevez en revanche du Développeur l'autorisation d'utiliser ce Contenu.</p>

            <h3>14. Notre droit de résilier le contrat</h3>
            <p>14.1. Nous pouvons résilier le contrat relatif aux Codes à tout moment en vous contactant par e-mail si vous enfreignez l'une des clauses du contrat...</p>

            <h3>15. Nature des codes et contenu</h3>
            <p>15.1. Vous pouvez bénéficier de certains droits légaux concernant les Codes que nous vendons et le Contenu associé...</p>

            <h3>16. Codes défectueux</h3>
            <p>16.2. Veuillez nous contacter si vous souhaitez : un remplacement du code ; une réduction de prix ; ou refuser le code et obtenir un remboursement.</p>

            <h3>17. Limitation de notre responsabilité envers vous</h3>
            <p>17.1. En cas de manquement à nos obligations contractuelles, nous sommes responsables des pertes ou dommages que vous subissez et qui sont une conséquence prévisible...</p>

            <h3>18. Autres termes importants</h3>
            <p>18.1.. Cession de droits. Nous pouvons céder nos droits et obligations au titre des présentes Conditions à une autre organisation. Vous ne pouvez céder vos droits ou obligations au titre des présentes Conditions à une autre personne qu'avec notre accord écrit. 18.2. Divisibilité... 18.3. Même si nous tardons à faire appliquer ce contrat, nous conservons le droit de l'appliquer ultérieurement.</p>
            <p>18.2. Divisibilité. Chacune des clauses des présentes Conditions générales s'applique indépendamment des autres. Si un tribunal ou une autorité compétente juge une clause ou une partie de clause illégale, les autres clauses et parties de clause demeureront pleinement applicables.</p>
            <p>18.3. Même si nous tardons à faire appliquer ce contrat, nous conservons le droit de l'appliquer ultérieurement. Si nous n'exigeons pas immédiatement que vous respectiez vos obligations en vertu des présentes Conditions, ou si nous tardons à prendre des mesures à votre encontre en cas de manquement à ces Conditions, cela ne vous dispensera pas de vos obligations et ne nous empêchera pas d'agir contre vous ultérieurement.</p>
            <p>18.4. Droits et recours. Les droits et recours prévus par les présentes Conditions s’ajoutent à, et ne remplacent pas, les droits et recours prévus par la loi applicable.</p>
            <p>18.5. Droit applicable : Les présentes conditions générales sont régies par le droit irlandais. Tout litige sera soumis à la compétence des tribunaux irlandais. Aucune disposition du présent article 18.5 ne limite ni n’exclut les protections obligatoires des consommateurs applicables dans votre pays de résidence et auxquelles nous sommes tenus de nous conformer.</p>
            <p>18.6. Heure : Les références à l'heure doivent être interprétées en référence au calendrier grégorien.</p>
            <h3>19. Mise à jour des présentes conditions</h3>
            <p>19.1. Nous pouvons modifier les présentes Conditions générales de temps à autre. Veuillez les consulter à chaque commande de codes afin de vous assurer que vous acceptez les Conditions en vigueur à ce moment-là, car toute nouvelle condition s'appliquera à tous vos achats ultérieurs. Les modifications apportées aux présentes Conditions générales après l'acceptation de votre commande n'auront aucune incidence sur celle-ci.</p>
            <p>19.2. Ces conditions ont été modifiées pour la dernière fois le 2 novembre 2023. Les versions précédentes de ces conditions, y compris leurs dates d'entrée en vigueur, sont disponibles ici .</p>
        </div>

</div> <?php elseif($page == 'ticket'): ?>
        <a href="?page=accueil" class="btn-back"> < Retour</a>
        <h1>Ouvrir un ticket d'assistance</h1>
        <div class="content-box">
            <form class="ticket-form">
                <input type="text" placeholder="Votre Nom" required>
                <input type="email" placeholder="Votre Email" required>
                <input type="text" placeholder="Numéro de commande (ex: #12345)">
                <select required>
                    <option value="">Sélectionnez un motif</option>
                    <option value="remboursement">Demande de remboursement</option>
                    <option value="cle">Clé invalide / déjà utilisée</option>
                    <option value="paiement">Problème de paiement</option>
                    <option value="autre">Autre demande</option>
                </select>
                <textarea rows="5" placeholder="Décrivez votre problème en détail..." required></textarea>
                <button type="submit" class="btn-submit">Envoyer ma demande</button>
            </form>
        </div>

    <?php elseif($page == 'paiement'): ?>
        <a href="?page=accueil" class="btn-back"> < Retour</a>
        <h1>Support Paiement</h1>
        <?php if($section == ''): ?>
            <div class="support-card-grid">
                <a href="?page=paiement&section=debiter" class="card"><h3>L'argent a été débité mais aucun produit n'a été reçu</h3></a>
                <a href="?page=paiement&section=refuse" class="card"><h3>Je ne peux pas effectuer le paiement</h3></a>
                <a href="?page=paiement&section=transaction" class="card"><h3>Vous avez trouvé une transaction que vous n'avez pas faite ?</h3></a>
                <a href="?page=paiement&section=remboursement" class="card"><h3>Comment obtenir un remboursement ?</h3></a>
            </div>
        <?php else: ?>
            <div class="content-box">
                <a href="?page=paiement" class="btn-back" style="color:var(--gaming-red)"> < Retour aux questions</a>

                <?php if($section == 'refuse'): ?>
                    <section class="support-section">
                        <h3>Je ne peux pas effectuer le paiement</h3>
                        <p>Si vous rencontrez des difficultés pour effectuer un paiement sur notre site web, vous pouvez essayer de résoudre le problème.</p>
                        <h4>Voici quelques raisons courantes pour lesquelles cela peut se produire :</h4>
                        <ol>
                            <li>Vérifiez que toutes les informations que vous avez saisies sont correctes, comme votre adresse de facturation et les informations relatives à votre carte de crédit.</li>
                            <li>Assurez-vous que l'adresse de facturation que vous avez saisie correspond à celle associée à votre carte de crédit.</li>
                            <li>Confirmez que votre carte de crédit n'a pas expiré ou atteint sa limite.</li>
                            <li>Vérifiez que votre carte est activée pour les achats en ligne.</li>
                            <li>Essayez d'utiliser un autre mode de paiement ou un autre navigateur.</li>
                            <li>Effacez le cache et les cookies de votre navigateur pour vous assurer que vous n'utilisez pas d'anciennes informations.</li>
                            <li>Vérifiez que vous disposez d'une connexion internet stable.</li>
                        </ol>
                        <p>Si vous rencontrez toujours des difficultés, veuillez contacter notre équipe d'assistance. Préparez votre numéro de commande, le message d'erreur reçu et vos informations de paiement.</p>
                        <h3>Veuillez préparer les informations suivantes lorsque vous contactez notre équipe d'assistance à la clientèle :</h3>
                        <ol>
                                                    <li>e numéro de commande, le cas échéant</li>
                                                    <li>Le message d'erreur que vous avez reçu, le cas échéant</li>
                                                    <li> Informations relatives au paiement</li>
                        </ol>
                    <p>Notre équipe sera heureuse de vous assister et de vous aider à résoudre le problème le plus rapidement possible. Nous prenons très au sérieux la satisfaction de nos clients, alors n'hésitez pas à nous contacter si vous avez des questions ou des inquiétudes via le formulaire de contact ou le chat fourni sur notre site web. Nous sommes là pour vous aider !</p>
                    </section>

                <?php elseif($section == 'debiter'): ?>
                    <section class="support-section">
                        <h3>L'argent a été débité mais aucun produit n'a été reçu</h3>
                        <p>Si vous avez été facturé mais que vous n'avez pas reçu le produit, contactez immédiatement notre équipe d'assistance.</p>
                        <p><strong>Informations à préparer :</strong> Numéro de commande et preuve de paiement (capture d'écran de la transaction).</p>
                        <h3>Il peut y avoir plusieurs raisons à cela :</h3>
                       <ul>
                        <li>Retard de traitement</li>
                         <li>Problème de paiement</li>
                       </ul>
                   <h3>Veuillez préparer les informations suivantes lorsque vous contactez notre équipe d'assistance à la clientèle :</h3>
                   <ul>
                    <li>Numéro de commande</li>
                    <li>Preuve de paiement (capture d'écran ou photo de la transaction)</li>
                    </ul>
                 <p>Notre équipe examinera le problème et prendra les mesures nécessaires pour le résoudre le plus rapidement possible. Nous nous excusons pour les désagréments que ce problème a pu causer et nous ferons de notre mieux pour y remédier. Nous vous remercions de votre patience et de votre compréhension pendant que nous nous efforçons de résoudre le problème. Si nous ne sommes pas en mesure de résoudre le problème, nous procéderons à un remboursement ou à une nouvelle livraison du produit dès que possible. La satisfaction de nos clients nous tient à cœur. N'hésitez donc pas à nous contacter si vous avez des questions ou des inquiétudes en utilisant le formulaire de contact ou le chat disponible sur notre site web. Nous sommes là pour vous aider !</p>
                    </section>

                <?php elseif($section == 'transaction'): ?>
                    <section class="support-section">
                        <h3>Vous avez trouvé une transaction que vous n'avez pas faite ?</h3>
                        <p>Si vous avez découvert sur votre compte un prélèvement que vous n'avez pas effectué, il est important que vous agissiez immédiatement.</p>
                        <h3>Voici quelques mesures que vous pouvez prendre :</h3>
                        <ul>
                            <li>Vérifiez qu'il ne s'agit pas d'une erreur ou d'un double prélèvement.</li>
                            <li>Vérifiez si un proche n'a pas utilisé votre compte.</li>
                            <li>Modifiez le mot de passe de votre compte et toute autre information de connexion associée dès que possible.</li>
                            <li>Vérifiez la date et le montant de l'achat pour confirmer que ce n'est pas vous ou quelqu'un que vous connaissez qui l'avez effectué.</li>
                            <li>Examinez régulièrement votre relevé de compte afin de détecter tout autre prélèvement suspect ou non autorisé.</li>

                        </ul>
                    <h3>Veillez à préparer les informations suivantes lorsque vous contactez notre équipe d'assistance :</h3>
                    <ul>
                                                <li>Votre nom complet.</li>
                                                <li>Les 6 premiers et les 4 derniers numéros de votre carte, ou votre adresse e-mail Paypal si le paiement a été effectué avec Paypal.</li>
                                                <li>Modifiez le mot de passe de votre compte et toute autre information de connexion associée dès que possible.</li>
                                                <li>Le montant exact de chaque débit.</li>
                                                <li>L'heure et la date de la (des) transaction(s).</li>

                    </ul>
                <p>Tout autre detail ou information lié à la transaction. Nous prenons la sécurité de nos clients au sérieux, alors n'hésitez pas à nous contacter si vous avez des questions ou des inquiétudes. Nous sommes là pour vous aider !</p>
                    </section>

                <?php elseif($section == 'remboursement'): ?>
                    <section class="support-section">
                        <h3>Comment obtenir un remboursement pour un produit ?</h3>
                        <p>Nous appliquons une politique de remboursement flexible pour garantir votre satisfaction, tout en respectant les contraintes liées aux licences numériques.</p>

                        <h4>Critères d'éligibilité impératifs :</h4>
                        <ul>
                            <li><strong>État de la licence :</strong> Le remboursement n'est possible que si la clé n'a JAMAIS été affichée sur votre écran. Une fois que vous avez cliqué sur "Voir la clé", nous considérons que le produit a été consommé.</li>
                            <li><strong>Délai légal :</strong> Vous disposez de 14 jours calendaires après la date d'achat pour formuler votre demande, à condition que le point précédent soit respecté.</li>
                            <li><strong>Problème technique :</strong> Si la clé est défectueuse (code déjà utilisé ou invalide), un remplacement ou un remboursement complet sera effectué après vérification auprès de l'éditeur, sans limite de temps.</li>
                        </ul>

                        <h4>Comment faire ma demande ?</h4>
                        <ol>
                            <li>Ne faites pas d'opposition bancaire (litige PayPal/CB), cela bloquerait définitivement votre compte client.</li>
                            <li>Rendez-vous en bas de cette page et cliquez sur "Ouvrir un ticket".</li>
                            <li>Choisissez le motif "Demande de remboursement" et joignez votre numéro de commande.</li>
                        </ol>
                        <p>Le délai de traitement moyen est de 12 à 24 heures. Les fonds sont reversés directement sur le mode de paiement utilisé lors de l'achat.</p>
                    </section>
                <?php endif; ?>
                <a href="?page=ticket" class="btn-ticket-open">Ouvrir un ticket</a>
            </div>
        <?php endif; ?>

    <?php elseif($page == 'commande'): ?>
        <a href="?page=accueil" class="btn-back"> < Retour</a>
        <h1>Support Commandes</h1>
        <?php if($section == ''): ?>
            <div class="support-card-grid">
                <a href="?page=commande&section=aide_passee" class="card"><h3>J'ai besoin d'aide pour une commande passée</h3></a>
                <a href="?page=commande&section=info_avant" class="card"><h3>Informations avant d'acheter</h3></a>
                <a href="?page=commande&section=ou_trouver" class="card"><h3>Où se trouve mon produit ?</h3></a>
            </div>
        <?php else: ?>
            <div class="content-box">
                <a href="?page=commande" class="btn-back" style="color:var(--gaming-red)"> < Retour</a>

                <?php if($section == 'aide_passee'): ?>
                    <section class="support-section">
                        <h3>J’ai besoin d’aide pour une commande que j’ai passée</h3>
                         <p>Vous rencontrez une difficulté avec un achat ? Pas de panique, 99% des situations se règlent en quelques minutes. Voici comment procéder :</p>

                        <h3>A.Ma commande est "En attente de validation"</h3>
                        <p>Notre système de sécurité peut suspendre temporairement une transaction pour une vérification de routine.</p>
                    <ul>
                       <li>Délai moyen : 5 à 20 minutes. Vérifiez vos e-mails pour une éventuelle vérification de sécurité.</li>
                       <li>Action : Vérifiez vos e-mails (et vos spams). Si nous avons besoin d'une confirmation de votre part, un message vous expliquant la marche à suivre vous a été envoyé. Une fois validée, la clé apparaîtra instantanément dans votre compte.</li>

                     </ul>
                    <h3>B. Le code est indiqué comme "Déjà utilisé" ou "Invalide" C'est une erreur rare mais qui peut arriver si l'éditeur a un souci de base de données.</h3>
                     <ol>
                          <li>Vérifiez le format : Assurez-vous de ne pas confondre le chiffre 8 avec la lettre B, ou le 0 avec le O.</li>
                          <li>Preuve requise : Prenez une capture d'écran de la fenêtre d'erreur entière (votre écran complet, pas juste le message) en incluant bien le message d'erreur et votre compte de plateforme (Steam, Epic, etc.) visible.</li>
                           <li>Envoyez-nous cette capture via un ticket. Nous lançons une enquête avec l'éditeur pour vous fournir une nouvelle clé ou un remboursement.</li>


                     </ol>
                 <h3>C. J'ai acheté le mauvais jeu ou je me suis trompé de plateforme</h3>
                 <p>Tant que vous n'avez pas cliqué sur "Afficher la clé", nous pouvons annuler la commande immédiatement. Si la clé a été révélée, nous ne pouvons malheureusement plus la reprendre.</p>
                    </section>

                <?php elseif($section == 'info_avant'): ?>
                    <section class="support-section">
                        <h3>Je souhaite obtenir des informations avant d'acheter</h3>
                        <p>Vous voulez être sûr de votre choix ? Voici les points clés à vérifier pour éviter toute erreur avant de valider votre panier :</p>

                        <h4>A. Vérification de la Région (Le point le plus important !)</h4>
                        <p>Sur chaque fiche produit, une zone "Région" est indiquée.</p>
                        <ul>
                            <li><strong>Global :</strong> Le jeu s'active partout dans le monde.</li>
                            <li><strong>Europe :</strong> Le jeu ne s'active que si votre compte de plateforme et votre connexion sont localisés en Europe.</li>
                            <li><strong>Attention :</strong> Si vous achetez une clé "US" pour un compte français, elle ne fonctionnera pas et ne pourra pas être remboursée si elle est révélée.</li>
                        </ul>

                        <h4>B. Plateformes d'activation</h4>
                        <p>Nous vendons des clés pour différentes boutiques. Vérifiez bien l'icône sur la fiche : Steam, Epic Games, Rockstar, Ubisoft Connect, EA App (Origin). Vous devez posséder un compte gratuit sur la plateforme concernée pour utiliser votre code.</p>

                        <h4>C. Fonctionnement des Précommandes</h4>
                        <p>En précommandant chez nous, vous profitez du prix réduit garanti.</p>
                        <ul>
                            <li><strong>Livraison :</strong> La clé vous est envoyée quelques heures avant la sortie officielle, vous permettant souvent de profiter du "Pre-load" (pré-téléchargement).</li>
                            <li><strong>Bonus :</strong> Les bonus de précommande sont inclus sauf mention contraire explicite sur la fiche produit.</li>
                        </ul>

                        <h4>D. Modes de paiement et Frais</h4>
                        <p>Le prix affiché est le prix final. Cependant, selon le mode de paiement choisi (PayPal, Paysafecard, Carte Bleue), des frais de transaction propres à ces services peuvent s'ajouter au moment du checkout.</p>
                    </section>

                <?php elseif($section == 'ou_trouver'): ?>
                    <section class="support-section">
                        <h3>Où se trouve mon produit après l'achat ?</h3>
                        <p>La livraison sur notre plateforme est entièrement automatisée. Dès que le système de paiement confirme la transaction, le produit est débloqué. Voici les trois endroits où vous pouvez le retrouver :</p>

                        <ol>
                            <li><strong>Votre Espace Client (Le plus rapide) :</strong> Connectez-vous à votre compte, cliquez sur votre profil en haut à droite, puis sélectionnez "Mes Commandes". Votre dernier achat apparaîtra avec un statut "Complété". Cliquez sur la ligne correspondante pour révéler votre clé d'activation.</li>
                            <li><strong>Votre boîte de messagerie :</strong> Un mail intitulé "Confirmation de commande - [N° de commande]" vous est envoyé à la seconde où le paiement est validé. Il contient un lien sécurisé "Accéder à mon produit". Pensez à vérifier vos courriers indésirables (Spams).</li>
                            <li><strong>Cas particuliers (Vérification manuelle) :</strong> Pour des raisons de sécurité contre la fraude, environ 5% des commandes passent par une vérification manuelle. Si votre statut affiche "En cours de vérification", pas de panique : notre équipe valide ces commandes en moins de 30 minutes (24h/24 et 7j/7).</li>
                        </ol>
                    </section>
                <?php endif; ?>
                <a href="?page=ticket" class="btn-ticket-open">Ouvrir un ticket</a>
            </div>
        <?php endif; ?>

    <?php elseif($page == 'compte'): ?>
        <a href="?page=accueil" class="btn-back"> < Retour</a>
        <h1>Support Compte & Sécurité</h1>
        <?php if($section == ''): ?>
            <div class="support-card-grid">
                <a href="?page=compte&section=connexion" class="card"><h3>Problème de connexion / Activation</h3></a>
                <a href="?page=compte&section=preserver" class="card"><h3>Préserver la sécurité du compte</h3></a>
                <a href="?page=compte&section=sauvegarder" class="card"><h3>Données sauvegardées (RGPD)</h3></a>
                <a href="?page=compte&section=supprimer" class="card"><h3>Supprimer mon compte</h3></a>
            </div>
        <?php else: ?>
            <div class="content-box">
                <a href="?page=compte" class="btn-back" style="color:var(--gaming-red)"> < Retour</a>

                <?php if($section == 'preserver'): ?>
                    <section class="support-section">
                        <h3>Comment préserver la sécurité de mon compte ?</h3>
                        <p>Il est essentiel de sécuriser votre compte sur notre site web pour vous protéger contre la fraude en ligne. En prenant les mesures nécessaires pour protéger votre compte, vous pouvez contribuer à garantir la sécurité de votre compte et réduire le risque d'accès non autorisé à votre compte :</p>
                        <ol>
                            <li>Utilisez un mot de passe fort et unique pour votre compte. Évitez d'utiliser des mots ou des phrases courants et combinez des lettres, des chiffres et des caractères spéciaux.</li>
                            <li>Ne communiquez jamais votre mot de passe à qui que ce soit et ne l'enregistrez pas sur un ordinateur public.</li>
                            <li>Maintenez vos coordonnées, en particulier votre adresse électronique, à jour afin de pouvoir recevoir les notifications importantes en matière de sécurité.</li>
                            <li>Déconnectez-vous de votre compte lorsque vous avez fini de l'utiliser, surtout si vous utilisez un appareil public ou partagé.</li>
                            <li>Soyez vigilant face aux tentatives d'hameçonnage. Faites attention aux courriels ou aux messages vous demandant vos informations personnelles, et ne cliquez jamais sur des liens ou ne saisissez jamais vos informations sur un site web qui ne vous est pas familier.</li>
                            <li>Soyez prudent lorsque vous communiquez des informations personnelles par téléphone ou sur Internet. Ne communiquez que ce qui est nécessaire à la transaction et mettez en doute l'authenticité de la personne qui vous contacte avant de communiquer des données sensibles.</li>
                            <li>Utilisez l'authentification à deux facteurs pour protéger votre compte. Cette méthode ajoute une couche de sécurité supplémentaire en exigeant un code envoyé sur votre téléphone en plus de votre mot de passe.</li>
                            <li>Maintenez votre appareil et votre navigateur à jour, afin d'éviter les failles de sécurité.</li>
                            <li>Surveillez régulièrement l'activité de votre compte pour vous assurer qu'il n'y ait pas de transactions non autorisées.</li>
                        </ol>
                        <p>Nous sommes conscients de la valeur de vos informations et nous faisons tout ce qui est en notre pouvoir pour les protéger. Si vous soupçonnez une activité suspecte on votre compte, veuillez contacter immédiatement notre équipe d'assistance à la clientèle.</p>
                        <p>Si vous avez des questions ou des inquiétudes concernant la sécurité de votre compte, n'hésitez pas à nous contacter. Nous sommes toujours là pour vous aider à protéger vos informations personnelles et à sécuriser votre compte.</p>
                    </section>

                <?php elseif($section == 'connexion'): ?>
                    <section class="support-section">
                        <h3>Vous n'arrivez pas à vous connecter à votre compte ?</h3>
                        <h4>Je n'ai pas reçu mon e-mail d'activation</h4>
                        <p>Si vous n'avez pas reçu votre courriel d'activation après avoir ouvert un compte sur notre site web, vous pouvez essayer plusieurs choses :</p>
                        <ol>
                            <li>Vérifiez votre dossier de spam ou de courrier indésirable. Il arrive que des courriels s'y retrouvent accidentellement.</li>
                            <li>Assurez-vous d'avoir saisi la bonne adresse électronique lors de votre inscription. Vérifiez qu'il n'y a pas de fautes de frappe ou d'erreurs.</li>
                            <li>Attendez quelques minutes et vérifiez à nouveau votre courrier électronique. Il peut arriver que la réception des courriels soit retardée.</li>
                            <li>Contactez notre équipe d'assistance à la clientèle en nous envoyant un courriel à l'adresse suivante support@instant-gaming.com. Veuillez indiquer les informations relatives à votre compte et l'adresse électronique que vous avez utilisée pour vous inscrire, afin que nous puissions vous aider le plus rapidement possible.</li>
                        </ol>
                        <p>Nous vous présentons nos excuses pour les désagréments que cela a pu causer et nous ferons de notre mieux pour vous aider à résoudre le problème le plus rapidement possible.</p>
                    </section>

                <?php elseif($section == 'sauvegarder'): ?>
                    <section class="support-section">
                        <h3>Quelles données sauvegardez-vous à mon sujet ?</h3>
                        <p>En tant qu'entreprise opérant en conformité avec le règlement général sur la protection des données (RGPD), nous prenons très au sérieux la vie privée de nos clients. Les données que nous collectons et stockons sur nos clients sont utilisées uniquement pour leur offrir la meilleure expérience possible sur notre site web, et pour les tenir informés des produits et services que nous proposons.</p>
                        <p>Les types de données suivants sont collectés et stockés lorsque vous créez un compte ou effectuez un achat sur notre site web :</p>
                        <ul>
                            <li><strong>Informations personnelles :</strong> telles que votre nom, votre adresse électronique et votre adresse postale.</li>
                            <li><strong>Informations de paiement :</strong> telles que les détails de votre carte de crédit ou de débit. Ces informations sont stockées et protégées en toute sécurité par notre prestataire de services de paiement et ne sont utilisées qu'aux fins du traitement de votre paiement.</li>
                            <li><strong>Historique :</strong> Des informations sur votre historique de navigation et d'achat sur notre site web, afin d'améliorer votre expérience et de vous suggérer des produits susceptibles de vous intéresser.</li>
                            <li><strong>Informations volontaires :</strong> Les informations que vous fournissez volontairement, telles que les commentaires, les enquêtes, les inscriptions au marketing par courrier électronique, etc.</li>
                            <li><strong>Informations techniques :</strong> telles que votre adresse IP, votre type de navigateur et les pages que vous visitez sur notre site web, à des fins d'analyse du site, de prévention de la fraude et de sécurité.</li>
                        </ul>
                        <p>Vos données sont protégées et conservées en toute sécurité. Elles ne sont communiquées à des tiers que si nous sommes légalement tenus de le faire ou s'ils fournissent un service en notre nom, comme la livraison d'une commande. Nous ne conservons les données que le temps nécessaire à la fourniture du service et aussi longtemps que la loi l'exige.</p>
                        <p>Vous pouvez nous contacter à tout moment pour demander l'accès aux données que nous avons collectées et stockées à votre sujet, ou pour demander que vos données soient supprimées. Vous pouvez également demander à ne plus recevoir d'e-mails marketing en cliquant sur le lien "se désinscrire" au bas de tout e-mail marketing que vous recevez de notre part.</p>
                        <p>Nous nous engageons à sécuriser vos données personnelles et à respecter votre droit à la vie privée. Si vous avez des questions ou des inquiétudes, n'hésitez pas à nous contacter.</p>
                    </section>

                <?php elseif($section == 'supprimer'): ?>
                    <section class="support-section">
                        <h3>Comment puis-je supprimer mon compte ?</h3>
                        <p>Il est essentiel de sécuriser votre compte sur notre site web pour vous protéger contre la fraude en ligne. En prenant les mesures nécessaires pour protéger votre compte, vous pouvez contribuer à garantir la sécurité de votre compte et réduire le risque d'accès non autorisé à votre compte :</p>
                        <ol>
                            <li>Utilisez un mot de passe fort et unique pour votre compte. Évitez d'utiliser des mots ou des phrases courants et combinez des lettres, des chiffres et des caractères spéciaux.</li>
                            <li>Ne communiquez jamais votre mot de passe à qui que ce soit et ne l'enregistrez pas sur un ordinateur public.</li>
                            <li>Maintenez vos coordonnées, en particulier votre adresse électronique, à jour afin de pouvoir recevoir les notifications importantes en matière de sécurité.</li>
                            <li>Déconnectez-vous de votre compte lorsque vous avez fini de l'utiliser, surtout si vous utilisez un appareil public ou partagé.</li>
                            <li>Soyez vigilant face aux tentatives d'hameçonnage. Faites attention aux courriels ou aux messages vous demandant vos informations personnelles, et ne cliquez jamais sur des liens ou ne saisissez jamais vos informations sur un site web qui ne vous est pas familier.</li>
                            <li>Soyez prudent lorsque vous communiquez des informations personnelles par téléphone ou sur Internet. Ne communiquez que ce qui est nécessaire à la transaction et mettez en doute l'authenticité de la personne qui vous contacte avant de communiquer des données sensibles.</li>
                            <li>Utilisez l'authentification à deux facteurs pour protéger votre compte. Cette méthode ajoute une couche de sécurité supplémentaire en exigeant un code envoyé sur votre téléphone en plus de votre mot de passe.</li>
                            <li>Maintenez votre appareil et votre navigateur à jour, afin d'éviter les failles de sécurité.</li>
                            <li>Surveillez régulièrement l'activité de votre compte pour vous assurer qu'il n'y ait pas de transactions non autorisées.</li>
                        </ol>
                        <p>Nous sommes conscients de la valeur de vos informations et nous faisons tout ce qui est en notre pouvoir pour les protéger. Si vous soupçonnez une activité suspecte sur votre compte, veuillez contacter immédiatement notre équipe d'assistance à la clientèle.</p>
                        <p>Si vous avez des questions ou des inquiétudes concernant la sécurité de votre compte, n'hésitez pas à nous contacter. Nous sommes toujours là pour vous aider à protéger vos informations personnelles et à sécuriser votre compte.</p>
                    </section>
                <?php endif; ?>
                <a href="?page=ticket" class="btn-ticket-open">Ouvrir un ticket</a>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="js/script.js"></script>
<script src="js/tom.js"></script>

</body>
</html>