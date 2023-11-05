<?php

namespace App\Models\Upload;

use App\Models\Ref\Ref_Upload_Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFileHistory extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'upload_file_history';
    protected $guarded = [];
    public $timestamps = true;

    public function ref_status()
    {
        return $this->belongsTo(Ref_Upload_Status::class, 'STATUS_CODE', 'CODE');
    }
}
