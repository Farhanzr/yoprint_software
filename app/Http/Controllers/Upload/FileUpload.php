<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use App\Jobs\UploadCSVJob;
use App\Models\Upload\UploadFileHistory;
use Illuminate\Http\Request;

class FileUpload extends Controller
{
    public $count_data, $total_data_csv;

    public function index()
    {
        $upload_history = $this->uploadFileHistory();
        
        // return view('Upload.index');
        return view('upload.fileupload', compact('upload_history'))->render();
    }

    public function store(Request $request)
    {
        if($request->file('upload_file') != NULL)
        {
            // $file_upload = $_FILES['upload_file'];
            $valid_extension = array("csv");
            $file_upload = $request->file('upload_file');
            $file_name = $file_upload->getClientOriginalName();
            $file_extension = $file_upload->getClientOriginalExtension();
            $fileContent = file_get_contents($file_upload->getRealPath());
            $fileHash = hash('sha256', $fileContent);
            $existingFile = UploadFileHistory::where('HASH', $fileHash)->first();
            $upload_id = uploadIDGenerator();

            // If not same file
            if(!$existingFile)
            {
                // validate file extension
                if(in_array(strtolower($file_extension),($valid_extension)))
                {
                    // store uploaded file
                    $file_upload->storeAs('Files/Upload/', $file_name, 'public');

                    // Move file
                    $move_Path = public_path('Files/Upload/');
                    $file_upload->move($move_Path,$file_name);
                    $read_path = $move_Path."/".$file_name;


                    // dispatching the job
                    UploadCSVJob::dispatch($read_path, $file_name, $fileHash, $upload_id, 1001);

                    return redirect('upload')->withStatus('success', 'File successfully uploaded');
                }
                else
                {
                    return redirect('upload')->withStatus('error', 'Invalid file format. Please upload CSV file.');
                }
            }
            else
            {
                $upload_history = UploadFileHistory::create([
                        'UPLOAD_ID' => uploadIDGenerator(),
                        'FILENAME' => $file_name,
                        'STATUS_CODE' => 3,
                        'CREATED_BY' => 1001,
                        'UPDATED_BY' => 1001,
                        'HASH' => $fileHash,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                return redirect('upload')->withStatus('error', 'Same file is being uploaded by another process.');
            }
        }
    }

    public function uploadFileHistory()
    {
        $upload_history = UploadFileHistory::with('ref_status')->get();

        $result = "";
        if(count($upload_history) > 0)
        {
            foreach($upload_history as $history)
            {
                $result .= '
                <tr>
                    <td class="p-2" style="border:1px solid black;">'.$history->created_at.'</td>
                    <td class="p-2" style="border:1px solid black;">'.$history->FILENAME.'</td>
                    <td class="p-2" style="border:1px solid black;">'.$history->ref_status->DESCRIPTION.'</td>
                </tr>
                ';
            }
            
        }
        else {
            $result .= '
                <tr>
                    <td colspan="3" class="p-2 text-center" style="border:1px solid black;">No record found</td>
                </tr>
            ';
        }

        return $result;
    }
}
