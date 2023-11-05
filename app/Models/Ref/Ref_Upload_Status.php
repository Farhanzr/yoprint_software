<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ref_Upload_Status extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'ref_upload_status';
    protected $guarded = [];
    public $timestamps = true;
}
