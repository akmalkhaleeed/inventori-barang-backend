<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    // 🌟 PERUBAHAN/TAMBAHAN: Matikan timestamps karena tabel 'users' di SQL-mu tidak punya kolom created_at & updated_at
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: Satu user bisa mencatat banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
