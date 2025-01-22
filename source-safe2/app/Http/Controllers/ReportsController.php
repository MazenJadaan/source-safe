<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\User;
use App\Services\OperationService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $operationService;

    public function __construct(OperationService $operationService)
    {
        $this->operationService = $operationService;
    }

    /**
     * Show file operations report.
     *
     * @param int $fileId
     * @return \Illuminate\View\View
     */
    public function showFileReports($fileId)
    {
        $operations = $this->operationService->getFileOperations($fileId);
        return view('groups.group-files-reports', compact('operations'));
    }
    /**
     * Show member operations report.
     *
     * @param int $memberId
     * @return \Illuminate\View\View
     */
    public function showMemberReports($memberId)
    {
        $member = User::findOrFail($memberId);
        $operations = $this->operationService->getUserOperations($memberId);

        return view('groups.group-members-reports', compact('member', 'operations'));
    }
}
