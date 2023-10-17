<?php

namespace App\Http\Controllers;

use App\Services\ScormService;
use EscolaLms\Core\Dtos\OrderDto;
use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Scorm\Http\Requests\ScormDeleteRequest;
use EscolaLms\Scorm\Http\Requests\ScormListRequest;
use EscolaLms\Scorm\Services\Contracts\ScormQueryServiceContract;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Peopleaps\Scorm\Exception\InvalidScormArchiveException;
use Peopleaps\Scorm\Model\ScormModel;
use ZipArchive;

class ScormController extends EscolaLmsBaseController
{
    private ScormService $scormService;

    //    private ScormQueryServiceContract $scormQueryService;

    public function __construct(
        ScormService $scormService,
        //        ScormQueryServiceContract $scormQueryService
    ) {
        $this->scormService = $scormService;
        //        $this->scormQueryService = $scormQueryService;
    }

    public function create()
    {
        return view('scorm.create');
    }

    public function upload(Request $request)
    {
        $file = $request->file('zip');

        //        // Checks if it is a valid scorm archive
        //        $zip = new ZipArchive();
        //        $openValue = $zip->open($file);
        //        $isScormArchive = ($openValue === true) && $zip->getStream('imsmanifest.xml');
        //
        //        $zip->close();
        //
        //        if (! $isScormArchive) {
        //            throw new InvalidScormArchiveException('invalid_scorm_archive_message');
        //        }
        //
        //        $scormData = $this->scormService->generateScorm($file);
        //        dd($scormData);
        //
        //        // save to db
        //        if ($scormData && is_array($scormData)) {
        //            $scorm = new ScormModel();
        //            $scorm->version = $scormData['version'];
        //            $scorm->hash_name = $scormData['hashName'];
        //            $scorm->origin_file = $scormData['name'];
        //            $scorm->origin_file_mime = $scormData['type'];
        //            $scorm->uuid = $scormData['hashName'];
        //            $scorm->save();
        //
        //            $this->saveToDb($scormData['scos'], $scorm);
        //        }
        //
        //        return [
        //            'scormData' => $scormData,
        //            'model' => $scorm ?? null,
        //        ];

        try {

            $data = $this->scormService->uploadScormArchive($file);
            dd($file);
            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($data, 'Scorm Package uploaded successfully');
    }

    public function parse(Request $request): JsonResponse
    {
        $file = $request->file('zip');

        try {

            $data = $this->scormService->parseScormArchive($file);

            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($data, 'Scorm Package uploaded successfully');
    }

    public function show(string $uuid, Request $request): View
    {
        $data = $this->scormService->getScoViewDataByUuid(
            $uuid,
            $request->user() ? $request->user()->getKey() : null,
            $request->bearerToken()
        );

        return view('scorm::player', ['data' => $data]);
    }

    public function index(ScormListRequest $request): JsonResponse
    {
        $list = $this->scormQueryService->get($request->pageParams(), ['*'], $request->searchParams(), OrderDto::instantiateFromRequest($request));

        return $this->sendResponse($list, 'Scorm list fetched successfully');
    }

    public function getScos(ScormListRequest $request): JsonResponse
    {
        $columns = [
            'id',
            'scorm_id',
            'uuid',
            'entry_url',
            'identifier',
            'title',
            'sco_parameters',
        ];

        $list = $this->scormQueryService->allScos($columns);

        return $this->sendResponse($list, 'Scos list fetched successfully');
    }

    public function delete(ScormDeleteRequest $request, ScormModel $scormModel): JsonResponse
    {
        $this->scormService->deleteScormData($scormModel);

        return $this->sendSuccess('Scorm Package deleted successfully');
    }
}
