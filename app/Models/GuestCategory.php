<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'color', 'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}