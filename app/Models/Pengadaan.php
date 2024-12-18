<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\VendorTagPublished;

class Pengadaan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengadaans';

    // Primary key
    protected $primaryKey = 'idpengadaan';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'timestamp',
        'status',
        'iduser',
        'vendor_idvendor',
        'subtotal_nilai',
        'ppn',
        'total_nilai',
    ];

    // Menonaktifkan timestamps bawaan (jika tidak menggunakan `created_at` dan `updated_at`)
    public $timestamps = false;

    /**
     * Relasi ke model User (Jika ada)
     * Asumsi iduser merujuk ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    /**
     * Relasi ke model Vendor (Jika ada)
     * Asumsi vendor_idvendor merujuk ke tabel vendors
     */
    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class, 'vendor_idvendor', 'idvendor');
    // }
}
