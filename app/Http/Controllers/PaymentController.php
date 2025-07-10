<?php

namespace App\Http\Controllers;

use App\Models\MethodePaiement;
use App\Models\Paiement;
use App\Services\PaymentService;
use App\Services\KkiapayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaiementReussi;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFormation;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $kkiapayService;

    public function __construct(PaymentService $paymentService, KkiapayService $kkiapayService)
    {
        $this->paymentService = $paymentService;
        $this->kkiapayService = $kkiapayService;
    }

    public function initialize(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string|in:XOF,XAF,CDF,GNF',
            'description' => 'nullable|string',
            'methode_paiement_id' => 'required|exists:methode_paiements,id',
            'formation_id' => 'required|exists:formations,id'
        ]);

        $methodePaiement = MethodePaiement::findOrFail($request->methode_paiement_id);

        $transaction = $this->paymentService->initializePayment(
            $request->amount,
            $request->currency,
            $request->description,
            $methodePaiement->type
        );

        // Créer un enregistrement du paiement
        Paiement::create([
            'description' => $request->description,
            'montant' => $request->amount,
            'statut' => 'en_attente',
            'formation_id' => $request->formation_id,
            'transaction_id' => $transaction['transaction_id'],
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    public function callback(Request $request)
    {
        \Log::info('Callback formation_id', [
            'formation_id' => $request->query('formation_id'),
            'transaction_id' => $request->query('transaction_id'),
            'user_id' => auth()->id()
        ]);
        try {
            $transaction = $this->paymentService->verifyTransaction($request->query('transaction_id'));

            if ($transaction['status'] === 'SUCCESS') {
                // Enregistrer dans la table paiements
                Paiement::create([
                    'user_id' => auth()->id(),
                    'transaction_id' => $request->query('transaction_id'),
                    'formation_id' => $request->query('formation_id'),
                    'montant' => $request->query('montant'),
                    'statut' => 'valide',
                    'description' => "Description",
                ]);

                // Inscrire l'utilisateur à la formation si ce n'est pas déjà fait
                $user = Auth::user();
                $formationId = $request->query('formation_id');
                $userFormation = UserFormation::where('user_id', $user->id)->first();
                $isAlreadyEnrolled = $userFormation ? $userFormation->isInscrit($formationId) : false;

                if (!$isAlreadyEnrolled) {
                    $newFormation = [
                        'id' => (string)$formationId,
                        'status' => 'Inscrire',
                        'progression' => 0,
                        'date_inscription' => now()
                    ];
                    if ($userFormation) {
                        $formations = json_decode($userFormation->formations, true) ?? [];
                        $formations[] = $newFormation;
                        \Log::info('Avant save userFormation', [
                            'user_id' => $user->id,
                            'formations' => $formations
                        ]);
                        $userFormation->formations = json_encode($formations);
                        $userFormation->save();
                    } else {
                        \Log::info('Avant create userFormation', [
                            'user_id' => $user->id,
                            'formations' => [$newFormation]
                        ]);
                        UserFormation::create([
                            'user_id' => $user->id,
                            'formations' => json_encode([$newFormation]),
                        ]);
                    }
                }
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    

    public function return(Request $request)
    {
        if ($request->status === 'success') {
            return redirect()->route('formations.confirmer-inscription', [
                'id' => $request->formation_id,
                'payment_status' => 'success'
            ]);
        }

        return redirect()->back()->with('error', 'Le paiement a échoué');
    }


    public function kkiapayCallback(Request $request)
    {
        \Log::info('KkiapayCallback formation_id', [
            'formation_id' => $request->input('formation_id'),
            'transaction_id' => $request->input('transactionId'),
            'user_id' => auth()->id()
        ]);
        $data = $request->validate([
            'transactionId' => 'required|string',
            'formation_id' => 'required|exists:formations,id',
        ]);

        try {
            // Optionnel : appeler l'API Kkiapay pour vérifier le statut
            // Mais ici, on va simplement enregistrer localement
            Paiement::create([
                'user_id' => auth()->id(),
                'transaction_id' => $data['transactionId'],
                'montant' => 0, // ou à récupérer si tu veux vérifier l'API plus tard
                'statut' => 'valide',
                'formation_id' => $data['formation_id'],
                'description' => 'Paiement via Kkiapay',
                'date_paiement' => now(),
            ]);

            // Inscrire l'utilisateur à la formation si ce n'est pas déjà fait
            $user = auth()->user();
            $formationId = $data['formation_id'];
            $userFormation = UserFormation::where('user_id', $user->id)->first();
            $isAlreadyEnrolled = $userFormation ? $userFormation->isInscrit($formationId) : false;

            if (!$isAlreadyEnrolled) {
                $newFormation = [
                    'id' => (string)$formationId,
                    'status' => 'Inscrire',
                    'progression' => 0,
                    'date_inscription' => now()
                ];
                if ($userFormation) {
                    $formations = json_decode($userFormation->formations, true) ?? [];
                    $formations[] = $newFormation;
                    \Log::info('Avant save userFormation', [
                        'user_id' => $user->id,
                        'formations' => $formations
                    ]);
                    $userFormation->formations = json_encode($formations);
                    $userFormation->save();
                } else {
                    \Log::info('Avant create userFormation', [
                        'user_id' => $user->id,
                        'formations' => [$newFormation]
                    ]);
                    UserFormation::create([
                        'user_id' => $user->id,
                        'formations' => json_encode([$newFormation]),
                    ]);
                }
            }

            // Mail facultatif
            Mail::to(auth()->user()->email)->send(new PaiementReussi([
                'transaction_id' => $data['transactionId'],
                'amount' => '0',
                'description' => 'Paiement via Kkiapay',
            ]));

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function handleKkiaPayCallback(Request $request)
    {
        $request->validate([
            'transactionId' => 'required|string',
            'formation_id' => 'required|integer|exists:formations,id',
        ]);

        $transactionId = $request->input('transactionId');
        $formationId = $request->input('formation_id');
        $user = Auth::user();

        \Log::info('Callback reçu KKIAPAY', [
            'user_id' => $user ? $user->id : null,
            'transactionId' => $transactionId,
            'formation_id' => $formationId,
        ]);

        // Vérifier si l'utilisateur est bien authentifié
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Utilisateur non authentifié.'], 401);
        }

        // 1. Vérifier la transaction auprès de KkiaPay (optionnel)
        // $isTransactionValid = $this->kkiapayService->verifyTransaction($transactionId);
        // if (!$isTransactionValid) {
        //     return response()->json(['success' => false, 'message' => 'La transaction n\'a pas pu être vérifiée.'], 400);
        // }

        // 2. Vérifier que l'utilisateur n'est pas déjà inscrit
        $isAlreadyEnrolled = UserFormation::where('user_id', $user->id)
            ->where('formation_id', $formationId)
            ->exists();

        if (!$isAlreadyEnrolled) {
            // Inscrire l'utilisateur à la formation
            $newFormation = [
                'id' => (string)$formationId,
                'status' => 'Inscrire',
                'progression' => 0,
                'date_inscription' => now()
            ];
            $userFormation = UserFormation::where('user_id', $user->id)->first();
            if ($userFormation) {
                $formations = json_decode($userFormation->formations, true) ?? [];
                $formations[] = $newFormation;
                \Log::info('Avant save userFormation', [
                    'user_id' => $user->id,
                    'formations' => $formations
                ]);
                $userFormation->formations = json_encode($formations);
                $userFormation->save();
            } else {
                \Log::info('Avant create userFormation', [
                    'user_id' => $user->id,
                    'formations' => [$newFormation]
                ]);
                UserFormation::create([
                    'user_id' => $user->id,
                    'formations' => json_encode([$newFormation]),
                ]);
            }
        }

        // 3. Enregistrer le paiement dans la base de données
        Paiement::create([
            'user_id' => $user->id,
            'transaction_id' => $transactionId,
            'montant' => 1000, // Mets ici le vrai montant si tu le connais
            'statut' => 'valide',
            'formation_id' => $formationId,
            'description' => 'Paiement via Kkiapay',
            'date_paiement' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Paiement réussi et inscription validée.']);
    }

    public function showVerificationPage(Request $request)
    {
        // On s'assure que les paramètres nécessaires sont dans l'URL
        if (!$request->has('transaction_id') || !$request->has('formation_id') || !$request->has('provider')) {
            // Redirige ou affiche une erreur si les infos manquent
            return redirect('/')->withErrors('Une erreur est survenue lors de la vérification du paiement.');
        }

        return view('Paiement.verifying', [
            'transaction_id' => $request->input('transaction_id'),
            'formation_id' => $request->input('formation_id'),
            'provider' => $request->input('provider'),
        ]);
    }

    public function handleFedaPayCallback(Request $request)
    {
        $data = $request->validate([
            'transactionId' => 'required|string',
            'formation_id' => 'required|exists:formations,id',
        ]);

        try {
            // Ici, tu peux appeler l'API Fedapay pour vérifier la transaction si tu veux
            // Pour l'exemple, on considère que la transaction est valide
            // Tu peux améliorer avec un vrai appel API si besoin
            $transactionId = $data['transactionId'];
            $formationId = $data['formation_id'];
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Utilisateur non authentifié.'], 401);
            }

            // Vérifier que l'utilisateur n'est pas déjà inscrit
            $isAlreadyEnrolled = UserFormation::where('user_id', $user->id)
                ->where('formation_id', $formationId)
                ->exists();

            if ($isAlreadyEnrolled) {
                return response()->json(['success' => true, 'message' => 'Déjà inscrit.']);
            }

            // Inscrire l'utilisateur à la formation
            $newFormation = [
                'id' => (string)$formationId,
                'status' => 'Inscrire',
                'progression' => 0,
                'date_inscription' => now()
            ];
            $userFormation = UserFormation::where('user_id', $user->id)->first();
            if ($userFormation) {
                $formations = json_decode($userFormation->formations, true) ?? [];
                $formations[] = $newFormation;
                \Log::info('Avant save userFormation', [
                    'user_id' => $user->id,
                    'formations' => $formations
                ]);
                $userFormation->formations = json_encode($formations);
                $userFormation->save();
            } else {
                \Log::info('Avant create userFormation', [
                    'user_id' => $user->id,
                    'formations' => [$newFormation]
                ]);
                UserFormation::create([
                    'user_id' => $user->id,
                    'formations' => json_encode([$newFormation]),
                ]);
            }

            // Enregistrer le paiement
            Paiement::create([
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'montant' => 0, // Tu peux récupérer le montant réel si tu vérifies l'API Fedapay
                'statut' => 'valide',
                'formation_id' => $formationId,
                'description' => 'Paiement via Fedapay',
                'date_paiement' => now(),
            ]);

            // Mail facultatif
            Mail::to($user->email)->send(new PaiementReussi([
                'transaction_id' => $transactionId,
                'amount' => '0',
                'description' => 'Paiement via Fedapay',
            ]));

            return response()->json(['success' => true, 'message' => 'Paiement réussi et inscription validée.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}