<?php

namespace App\Jobs;

use App\Models\Upload\UploadCSV;
use App\Models\Upload\UploadFileHistory;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UploadCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_path, $file_name, $file_hash, $upload_id, $user_id;
    public $currentUploading;
    public $tries = 5;

    public function __construct($path, $file_name, $hash, $upload_id, $user_id)
    {
        $this->file_path = $path;
        $this->file_name = $file_name;
        $this->file_hash = $hash;
        $this->upload_id = $upload_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $upload_history = UploadFileHistory::create([
            'UPLOAD_ID' => $this->upload_id,
            'FILENAME' => $this->file_name,
            'STATUS_CODE' => 0,
            'CREATED_BY' => $this->user_id,
            'UPDATED_BY' => $this->user_id,
            'HASH' => $this->file_hash,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->currentUploading = $upload_history->where('UPLOAD_ID', $upload_history->UPLOAD_ID)->first();

        // read csv file
        $file = fopen($this->file_path, "r");

        $importData_arr = array();
        $i=0;

        while (!feof($file)) 
        {
            $row = fgetcsv($file, 0, ",");
            if ($i > 0) { // This will skip the header row
                $importData_arr[] = $row;
            }

            $i++;
        }
        fclose($file);

        // Insert data from CSV to MySQL
        foreach($importData_arr as $data)
        {
            if (is_array($data)) {
                $clean_data = special_chars($data);
                
                try {
                    // insertion/update logic
                    UploadCSV::updateOrCreate(
                        ['unique_key' => (isset($data[0]) ? $data[0] : '')],
                        [
                            'product_title' => (isset($clean_data[1]) ? $clean_data[1] : ''),
                            'product_description' => (isset($clean_data[2]) ? $clean_data[2] : ''),
                            'style' => (isset($data[3]) ? $data[3] : ''),
                            'sanmar_mainframe_color' => (isset($data[28]) ? $data[28] : ''),
                            'size' => (isset($data[18]) ? $data[18] : ''),
                            'color_name' => (isset($data[14]) ? $data[14] : ''),
                            'piece_price' => (isset($data[21]) ? $data[21] : ''),
                            'UPLOAD_ID' => $this->upload_id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]
                    );
                } catch (Exception $e) {
                    UploadFileHistory::where('UPLOAD_ID', $this->currentUploading->UPLOAD_ID)->update([
                        'STATUS_CODE' => 3,
                    ]);
                    Log::error("Message: " . $e->getMessage());
                }

                // $percent_insert = ($count_data / $total_data) * 100;

                if($this->currentUploading->STATUS_CODE == 0)
                {
                    UploadFileHistory::where('UPLOAD_ID', $this->currentUploading->UPLOAD_ID)->update([
                        'STATUS_CODE' => 1,
                    ]);
                }
            }
            else{
                // Handle the case where $data is not an array
                Log::error("Error processing data. Data is not in array");
            }
        }

        UploadFileHistory::where('UPLOAD_ID', $this->currentUploading->UPLOAD_ID)->update([
            'STATUS_CODE' => 2,
        ]);
    }

    public function failed(Exception $exception)
    {
        // Send user notification of failure, log it, etc.
        return response()->json(['message' => 'Data failed to store. Please try again.', 'uploadId' => $this->currentUploading->UPLOAD_ID]);
    }
}
