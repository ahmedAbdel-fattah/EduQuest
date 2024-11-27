<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'path'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }



}
