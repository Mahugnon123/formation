<?php

namespace App\Http\Controllers;
use App\Models\Resume;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Requests\ResumeRequest;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resumeChapitre = [];
        $resumes = Resume::where('user_id',auth()->user()->id)->get();
        $formations = Formation::all();

        $fmts = [];
        $i = 0;
        $j = 1;
        foreach($resumes as $r){
            $formation = Formation::where('id',$r->formation_id)->first();
            if($formation!=null){
                $fmts[$r->formation_id] = $formation->titre;
            }
            
        }
        return view('Apprenant.resume.index', ['resumes'=> $resumes, 'formation'=> $fmts]);
    }
    

    public function chapitre(Request $request){
        $resume = Resume::where('id', $request->input('id'))->first();
        $resumeChapitre = is_array($resume->resumeChapitre)
            ? $resume->resumeChapitre
            : json_decode($resume->resumeChapitre, true);

        $chapitre = $resumeChapitre[$request->input('id_chapitre')];

        // Affichage simple de la note du chapitre
        return view('Apprenant.resume.chapitre', compact('chapitre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ResumeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Store method called with data:', $request->all());

            // Vérifier si tous les champs requis sont présents
            if (!$request->has(['formation_id', 'chapitre_id', 'titre', 'description'])) {
                \Log::error('Missing required fields', [
                    'formation_id' => $request->formation_id,
                    'chapitre_id' => $request->chapitre_id,
                    'titre' => $request->titre,
                    'description' => $request->description
                ]);
                return response()->json(['error' => 'Missing required fields'], 400);
            }

            if (!isset($request->chapitre_id) || $request->chapitre_id === '' || !is_numeric($request->chapitre_id)) {
                \Log::error('Invalid chapter ID', ['chapitre_id' => $request->chapitre_id]);
                return response()->json(['error' => 'Invalid chapter ID'], 400);
            }
            $chapitreId = (int)$request->chapitre_id;

            \Log::info('Looking for existing resume', [
                'formation_id' => $request->formation_id,
                'user_id' => auth()->user()->id
            ]);

            $resumes = Resume::where('formation_id', $request->formation_id)
                            ->where('user_id', auth()->user()->id)
                            ->first();

            if($resumes == null){
                \Log::info('No existing resume found, creating new one');
                $resumeChapitre = [
                    $chapitreId => [
                        'chapitre_id' => $chapitreId,
                        'titre' => $request->titre,
                        'description' => $request->description,
                        'commentaire' => $request->commentaire ?? '',
                        'updated_at' => date('d/m/Y H:i:s'),
                    ]
                ];

                try {
                    $resume = Resume::create([
                        'titre' => 'Note des chapitre',
                        'resumeChapitre' => json_encode($resumeChapitre),
                        'user_id' => auth()->user()->id,
                        'formation_id' => $request->formation_id,
                    ]);

                    \Log::info('New resume created successfully', ['resume' => $resume->toArray()]);
                } catch (\Exception $e) {
                    \Log::error('Error creating new resume', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return response()->json(['error' => 'Error creating resume: ' . $e->getMessage()], 500);
                }
            } else {
                \Log::info('Existing resume found, updating it');
                try {
                    $resumeChapitre = (is_array($resumes->resumeChapitre)) 
                        ? $resumes->resumeChapitre 
                        : json_decode($resumes->resumeChapitre, true);

                    if (!is_array($resumeChapitre)) {
                        \Log::warning('resumeChapitre is not an array, initializing empty array');
                        $resumeChapitre = [];
                    }

                    $resumeChapitre[$chapitreId] = [
                        'chapitre_id' => $chapitreId,
                        'titre' => $request->titre,
                        'description' => $request->description,
                        'commentaire' => $request->commentaire ?? '',
                        'updated_at' => date('d/m/Y H:i:s'),
                    ];

                    $resume = Resume::where('formation_id', $request->formation_id)
                                ->where('user_id', auth()->user()->id)
                                ->update([
                        'resumeChapitre' => json_encode($resumeChapitre),
                    ]);

                    \Log::info('Resume updated successfully', ['resumeChapitre' => $resumeChapitre]);
                } catch (\Exception $e) {
                    \Log::error('Error updating resume', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    return response()->json(['error' => 'Error updating resume: ' . $e->getMessage()], 500);
                }
            }

            return response()->json([
                'success' => true,
                'resultat' => $resumeChapitre
            ]);

        } catch (\Exception $e) {
            \Log::error('Unexpected error in store method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$chapitre_id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Add these lines for debugging
        \Log::info('Update method called');
        \Log::info('Request data: ' . json_encode($request->all()));

        $resume = Resume::where('id',$request->input('id_resume'))->first();

        if (!$resume) {
            \Log::error('Resume not found');
            return redirect()->back()->with('error', 'Resume not found.'); // Explicit error message
        }

        \Log::info('Found Resume: ' . json_encode($resume));


        if(is_array($resume->resumeChapitre)){
            $resumeChapitre = $resume->resumeChapitre;
        }else{
            $resumeChapitre = json_decode($resume->resumeChapitre, true);
        }
        $resumeChapitre [$request->chapitre_id]= [
            'chapitre_id' => $request->chapitre_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'commentaire'=> $request->commentaire,
            'updated_at'=> date('d/m/Y H:i:s'),

        ];
        \Log::info('resumeChapitre array: ' . json_encode($resumeChapitre));

        $resumeUpdate = Resume::where('id',$request->input('id_resume'))->update([
            'resumeChapitre' => json_encode($resumeChapitre)            
            ]);

        if(!$resumeUpdate){
            \Log::error('Resume update failed');
            return redirect()->back()->with('error', 'Failed to update resume.');
        }
        \Log::info('Resume updated successfully');
        return redirect()->back()->with('success', 'La note de ce chapitre a été modifiée avec succès.');
    }

    public function supChapitre(Request $request)
    {
        $resume = Resume::where('id', $request->input('id_resume'))->first();
        $resumeChapitre = (is_array($resume->resumeChapitre)) ? $resume->resumeChapitre : json_decode($resume->resumeChapitre, true);

        unset($resumeChapitre[$request->id_chpt]);

        if (empty($resumeChapitre)) {
            // S'il n'y a plus de chapitre, on supprime la ligne Resume
            $resume->delete();
            return redirect()->back()->with('success', 'Le résumé a été supprimé.');
        } else {
            // Sinon, on met à jour le champ
            $resume->update(['resumeChapitre' => json_encode($resumeChapitre)]);
            return redirect()->back()->with('success', 'La note de ce chapitre a été supprimée du résumé.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
    
    public function getChapitreNote(Request $request)
    {
        $resume = \App\Models\Resume::where('formation_id', $request->formation_id)
            ->where('user_id', auth()->id())
            ->first();

        $note = null;
        if ($resume && $resume->resumeChapitre) {
            $resumeChapitre = is_array($resume->resumeChapitre) ? $resume->resumeChapitre : json_decode($resume->resumeChapitre, true);
            if (isset($resumeChapitre[$request->chapitre_id])) {
                $note = $resumeChapitre[$request->chapitre_id];
            }
        }
        return response()->json(['note' => $note]);
    }
}
