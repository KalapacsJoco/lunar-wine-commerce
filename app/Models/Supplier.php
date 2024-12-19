<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'lunar_suppliers';

    protected $fillable = ['name', 'contact_email', 'phone', 'address', 'tax_id', 'region', 'website'];
}
