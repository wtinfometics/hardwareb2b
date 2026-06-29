<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\BackupServices;
use App\Helpers\PaginationHelper;

class BackupController extends Controller
{
     protected $backupService;

    // Inject Attribute Image service using constructor
    public function __construct(BackupServices $backupService){
        $this->backupService = $backupService;
    }

    public function indexRestore(){
        return view('Admin.banner-create');
    }

    // Create The Backup
    public function create(){
        try {
            //code...
            $createBackup = $this->backupService->createBackup();

            if (!empty($createBackup['success']) && $createBackup['success'] === true) {
                return redirect()->back()->with('success', $createBackup['message'] ?? 'Back Up Created successfully!');
            }
            return redirect()->back()->with('error', $createBackup['message'] ?? 'Failed to Create Back Up.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // View Backup
    public function index(){
        try {
            //code...
            $backups=$this->backupService->viewBackup();
            $success = $backups['success'] ?? false;
            $message = $backups['message'] ?? '';
            $data    = $backups['data'] ?? [];
            $paginatedData = PaginationHelper::paginate($data, 10);
            return view('Admin.backup', compact('success', 'message', 'paginatedData'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Download Backup
    public function download($backup_id){
        try {
            //code...
            return $this->backupService->downloadBackup($backup_id);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    // Restore backup
    public function restore(Request $request){
        try {
            //code...
            $validate=Validator::make($request->all(),[
                'backup'=>'required|file|mimes:zip'
            ]);
            if ($validate->fails()) {
                # If Validation Fails
                return redirect()->back()->withErrors($validate)->withInput();
            }
            $backupData=$request->file('backup');
            $restore = $this->backupService->downloadBackup($backupData);

            if (!empty($restore['success']) && $restore['success'] === true) {
                return redirect()->back()->with('success', $restore['message'] ?? 'Backup Restored successfully!');
            }
            return redirect()->back()->with('error', $restore['message'] ?? 'Failed to Store Backup.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    //  Delete Backup
    public function delete(){
        try {
            //code...
            $delete = $this->backupService->deleteBanner($banner_id);

            if (!empty($delete['success']) && $delete['success'] === true) {
                return redirect()->back()->with('success', $delete['message'] ?? 'Backup deleted successfully!');
            }
            return redirect()->back()->with('error', $delete['message'] ?? 'Failed to delete Backup.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }
    
}
