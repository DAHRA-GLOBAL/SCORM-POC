<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Peopleaps\Scorm\Entity\Scorm;
use Peopleaps\Scorm\Manager\ScormManager;
use Peopleaps\Scorm\Model\ScormModel;
use Peopleaps\Scorm\Model\ScormScoModel;

class ScormController extends Controller
{
    /** @var ScormManager */
    private $scormManager;

    /**
     * ScormController constructor.
     */
    public function __construct(ScormManager $scormManager)
    {
        $this->scormManager = $scormManager;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scorms = ScormModel::all();

        return view('scorm.index', compact('scorms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scorm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $file = $request->file('scorm_file'); // Assuming you have an input field named 'scorm_file' in your form.

        //        $scorm = auth()->user()->scorms()->create($file);
        //        dd($scorm);

        //        $scormModel = new ScormModel();
        //        $scormModel->resourceable()->create([
        //            'resource_id' => auth()->user()->id,
        //            'resource_type' => User::class,
        //        ]);
        // You can use the `uploadScormArchive` method to upload a SCORM package from a file.
        $scormModel = $this->scormManager->uploadScormArchive($file);

        // Save the SCORM package with the associated user.
        $scormModel->save();

        dd($scormModel);

        // Response with the saved SCORM model.
        return $this->respond(ScormModel::with('scos')->whereUuid($scormModel->uuid)->first());
    }

    public function playScorm($uuid)
    {
        $scoUuid = ScormModel::with('scos')->first();
        $scormContent = $this->scormManager->getScoByUuid($scoUuid->uuid);

        return view('scorm.play', ['data' => $scormContent]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Scorm $scorm)
    {
        $item = ScormScoModel::with('scoTrackings')->first();

        // response helper function from base controller reponse json.
        return view('scorm.play', compact('item'));
    }

    public function createScormTracking(Request $request)
    {
        Log::info('createScormTracking');
        $createTracking = $this->scormManager->createScoTracking($request->uuid, auth()->user()->id, auth()->user()->name);

        Log::info('tracking completed', ['trackingData' => $createTracking]);

        return response()->json($createTracking);
    }

    public function updateScormTracking(Request $request)
    {
        Log::info('updateScormTracking');
        $updateTracking = $this->scormManager->updateScoTracking($request->uuid, auth()->user()->id, $request->data);
        Log::info('tracking update completed', ['updateTrackingData' => $updateTracking]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scorm $scorm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scorm $scorm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scorm $scorm)
    {
        //
    }
}
