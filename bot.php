<?php

$botToken = '7122917815:AAGueLNZGrqBUO-_4MRhZrZuKvBdtMhsrEw';

function programmerBot($method, $datas = [])
{
    global $botToken;
    $curl = curl_init("https://api.telegram.org/bot" . $botToken . "/" . $method);
    curl_setopt_array($curl, [
        CURLOPT_POSTFIELDS => $datas,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = json_decode(curl_exec($curl));
    return $response;
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$entities = $message->entities;
// $webhookInfo = programmerBot('getWebhookInfo');
// var_dump($webhookInfo);

// Création du clavier avec des boutons
$keyboard = [
    // ['Lucky Jet Prédiction (Signal ⚡️🚀)', 'Bouton 2'],
    // ['Bouton 3', 'Bouton 4'],
    ['Lucky Jet Prédiction (Signal ⚡️🚀)'],
];


if ($text == "Lucky Jet Prédiction (Signal ⚡️🚀)") {
    function fairePrediction()
    {
        // Simule une prédiction dans la plage de 1.5 à 3
        return mt_rand(150, 300) / 100.0;
    }

    $tempsAttente = 180; // 3 minutes en secondes

    while (true) {
        // Enregistrez l'heure actuelle
        $heureDebut = time();

        // Effectuez la prédiction
        $prediction = fairePrediction();

        // Affichez la prédiction
        programmerBot('sendMessage', ['chat_id' => $chat_id, 'text' => "$prediction\n"]);

        // Attendez jusqu'à ce que le temps écoulé atteigne 0
        while (time() - $heureDebut < $tempsAttente) {
            // Calculez le temps écoulé
            $tempsEcoule = time() - $heureDebut;

            // Affichez le temps restant
            $tempsRestant = max(0, $tempsAttente - $tempsEcoule);
            echo "Il reste $tempsRestant secondes avant la prochaine prédiction.\n";

            // Attendez 1 seconde avant de vérifier à nouveau
            sleep(1);
        }

        // Affichez un message pour indiquer le début d'une nouvelle prédiction
        programmerBot('sendMessage', ['chat_id' => $chat_id, 'text' => "Nouvelle prédiction !\n"]);
    }
} else {
    if ($text == "/help") {

        programmerBot('sendMessage', ['chat_id' => $chat_id, 'text' => "🚀 Bienvenue sur ExpressFlowBot Prédictions Bot! 🚀

✨ Laissez la chance vous guider vers la victoire avec notre compagnon de jeu exclusif sur Telegram! ✨

🔮 Prédictions de haut niveau :
LuckyJet Predictions Bot utilise une technologie de pointe pour vous offrir des prédictions précises et fiables pour le jeu passionnant LuckyJet. Profitez d'un avantage stratégique en recevant des prédictions qui maximisent vos chances de succès.

📊 Statistiques en temps réel :
Accédez aux statistiques les plus récentes du jeu LuckyJet, analysez les tendances passées et anticipez les futurs mouvements. Notre bot vous fournit des informations utiles pour prendre des décisions éclairées et optimiser votre stratégie de jeu.

🤖 Interface conviviale :
Naviguez facilement à travers notre interface conviviale, conçue pour rendre votre expérience de prédiction aussi agréable que possible. Recevez des prédictions instantanées, consultez les statistiques et suivez votre progression, le tout avec la simplicité de Telegram.

💬 Communauté active :
Rejoignez une communauté passionnée de joueurs avides de LuckyJet. Partagez des conseils, discutez des dernières prédictions et célébrez vos victoires ensemble. Notre bot favorise l'esprit d'équipe pour que chaque membre puisse tirer le meilleur parti de cette expérience de jeu unique.

🔐 Sécurité avant tout :
Votre confidentialité et la sécurité de vos données sont notre priorité. Profitez de nos prédictions en toute tranquillité d'esprit, sachant que vos informations sont entre de bonnes mains.

🚀 Embarquez pour une aventure passionnante avec LuckyJet Predictions Bot dès maintenant et transformez chaque tour en une opportunité de gagner gros! 🚀

👉 @ExpressFlowBot
👉 Inscrivé vous avec le code promo : CHARL567 

#ExpressFlowBot #Prédictions #TelegramBot #GamingLuck 🎰💰"]);
    } else {
        // Encodage du clavier en format JSON
        $keyboard = json_encode(['keyboard' => $keyboard, 'resize_keyboard' => true]);

        // Paramètres du message
        $message_params = [
            'chat_id' => $chat_id,
            'text' => 'Express Flow Prédiction (EFP) choissez l\'option :',
            'reply_markup' => $keyboard,
        ];


        // Envoi du message avec le clavier
        programmerBot('sendMessage', $message_params);
    }
}


// $result= programmerBot('sendMessage',['chat_id'=>5927971184,'text'=>"Hello"]);
// echo $result->ok;


//Menu inline

// $menuInline = [
//     ['text' => 'Bouton 1', 'callback_data' => 'button1'],
//     ['text' => 'Bouton 2', 'callback_data' => 'button2'],
//     // ... autres boutons ...
// ];
// // Recherchez la commande /help et supprimez-la si elle est présente
// foreach ($menuInline as $key => $button) {
//     if ($button['callback_data'] == 'help') {
//         unset($menuInline[$key]);
//         break; // Sortez de la boucle après la suppression
//     }
// }

// // Encodage du menu en format JSON
// $menuInline = json_encode(['inline_keyboard' => [$menuInline]]);

// // Paramètres du message
// $message_params = [
//     'chat_id' => $chat_id,
//     'text' => 'Choisissez une option :',
//     'reply_markup' => $menuInline,
// ];