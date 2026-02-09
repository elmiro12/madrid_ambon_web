<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['nama', 'deskripsi','ketentuan','tanggal_event','lokasi','is_active'];
}
