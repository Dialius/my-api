<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'category_id',
        'seller_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'sku',
        'image',
        'weight',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Auto generate UUID, slug, dan SKU saat create
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
            if (empty($model->sku)) {
                $model->sku = 'PRD-' . strtoupper(Str::random(8));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // Relasi: Product belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Product belongs to Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // Accessor: Format harga ke Rupiah
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Accessor: Cek apakah stok tersedia
    public function getIsAvailableAttribute()
    {
        return $this->stock > 0 && $this->is_active;
    }
}
