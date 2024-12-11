<?php

namespace App\Http\Controllers;

use App\Providers\GraphTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    protected $disk;

    public function __construct(GraphTokenService $oneDriveService)
    {
        $this->disk = Storage::build([
            'driver' => config('filesystems.disks.onedrive.driver'),
            'root' => config('filesystems.disks.onedrive.root'),
            'directory_type' => config('filesystems.disks.onedrive.directory_type'),
            'access_token' => $oneDriveService->getAccessToken()
        ]);
    }

    public function pageView($routeName, $page = null)
    {
        // Construct the view name based on the provided routeName and optional page parameter
        $viewName = ($page) ? $routeName . '.' . $page : $routeName;
        // Check if the constructed view exists
        if (\View::exists($viewName)) {
            // If the view exists, return the view
            return view($viewName);
        } else {
            // If the view doesn't exist, return a 404 error
            abort(404);
        }
    }

    public function saveFile(Request $request)
    {
        $file = $request->file;
        $path = 'Nueva Carpeta';
        $this->disk->putFileAs($path, $file, $file->getClientOriginalName());
        return redirect('/upload-onedrive');
    }


    public function testOneDrive()
    {
        $files = $this->disk->files("Nueva Carpeta");
        return view("files", ["files" => $files]);
    }

    public function detectMimeType($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'zip' => 'application/zip',
        ];
        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }

    public function downloadFromOneDrive(Request $request)
    {
        $fileName = $request->file;
        if (!$this->disk->exists($fileName)) {
            return response()->json(['error' => 'Archivo no encontrado en OneDrive'], 404);
        }
        $fileContent = $this->disk->get($fileName);
        $mimeType = $this->detectMimeType($fileName);
        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . basename($fileName) . '"');
    }
}
