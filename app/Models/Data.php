<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'data';
    protected $primaryKey = 'data_id';  

    protected $fillable = [
        'user_id',
        'data_name',
        'type',
        'status',
        'data_url',
    ];

    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
