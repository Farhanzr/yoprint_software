<?php

namespace App\Models\Upload;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadCSV extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'upload_file';
    protected $primaryKey = 'unique_key';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = true;
}
