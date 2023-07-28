<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CompteController extends Controller
{
    public function depot(Request $request, $compte_id){
        // $operateur=Compte::all('operateur');
        // dd($operateur);
        Transaction::create([
            'type_transfert'=>'depot',
            'compte_source_id' => $request->compte_id,
            'compte_destination_id' =>$request-> destinataire,
            // if ($operateur==='Orange Money') {
            //     if ($request->montant>500) {
            //     'montant' => $request->montant,
            //     }
            // }
            'montant' => $request->montant,
            'date' => now(),

        ]);

        $nouveauSolde = Compte::findOrFail($compte_id);
        $nouveauSolde->update([
            'solde' => $nouveauSolde->solde + $request->montant,
        ]);
        return [
            'statusCode' => Response::HTTP_ACCEPTED ,
            'message' => 'Depot effectué avec succés' ,
        ];
    }

    public function retrait(Request $request, $compte_id){
        $transaction=Transaction::create([
            'type_transfert'=>'retrait',
            'compte_source_id' => $request->compte_id,
            'compte_destination_id' =>$request-> destinataire,
            'montant' => $request->montant,
            'date' => now(),

        ]);

        $nouveauSolde = Compte::findOrFail($compte_id);
        if ($nouveauSolde->solde>=$request->montant) {
            $nouveauSolde->update([
                'solde' => $nouveauSolde->solde - $request->montant,
            ]);   
        }else{
            return response()->json(['message' => 'Solde insuffisant! Veuillez verifier votre compte'], 400);
        }
        
        return [
            'statusCode' => Response::HTTP_ACCEPTED ,
            'message' => 'Retrait effectué avec succés' ,
        ];
    }

    public function transfert(Request $request, $source_id){

        $request->validate([
            'compte_destination' => 'required|exists:comptes,id',
            'montant' => 'required|numeric|min:0',
        ]);

        $compteSource = Compte::findOrFail($source_id);

        if ($compteSource->solde < $request->montant) {
            return response()->json(['message'=> 'Solde insuffisant pour effectuer le transfert.'], 400);
        }
       Transaction::create([
            'type_transfert'=>'transfert_compte',
            'compte_source_id' => $request->source_id,
            'destination_compte_id' =>$request->destination_compte_id ,
            'montant' => $request->montant,
            'date' => now(),
        ]);
        $compteSource->update([
            'solde' => $compteSource->solde - $request->montant,
        ]);

        $compteDestination = Compte::findOrFail($request->destination_compte_id);
        $compteDestination->update([
            'solde' => $compteDestination->solde + $request->montant,
        ]);
        return [
            'statusCode' => Response::HTTP_ACCEPTED ,
            'message' => 'transfert effectué avec succés' ,
        ];

    }
}

