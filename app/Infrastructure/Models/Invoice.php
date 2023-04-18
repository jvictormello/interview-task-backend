<?php

namespace App\Infrastructure\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];

    protected $appends = [
        'total'
    ];

    /**
     * Get the company for the invoice.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the invoice product lines for the invoice.
     */
    public function invoice_product_lines()
    {
        return $this->hasMany(InvoiceProductLine::class);
    }

    public function getTotalAttribute()
    {
        $total = 0;
        if ($this->invoice_product_lines) {
            foreach ($this->invoice_product_lines as $invoice_product_line) {
                $total = $total + $invoice_product_line->total;
            }
        }
        return $total;
    }
}
