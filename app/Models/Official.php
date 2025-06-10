<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'rank', 'nip', 'department', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}