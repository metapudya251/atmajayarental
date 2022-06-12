<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ["id"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        }
    }

    public function getUpdateAtAttribute(){
        if(!is_null($this->attributes['update_at'])){
            return Carbon::parse($this->attributes['update_at'])->format('Y-m-d H:i:s');
        }
    }
}
