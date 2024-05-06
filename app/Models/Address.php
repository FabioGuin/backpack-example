<?php

declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'alias',
        'customer_id',
        'municipality_id',
        'province_id',
        'region_id',
        'state_id',
        'postal_code',
        'address',
        'house_number',
        'completion_address',
        'latitude',
        'longitude',
        'is_default',
        'is_invoiceable',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'municipality_id' => 'integer',
        'province_id' => 'integer',
        'region_id' => 'integer',
        'state_id' => 'integer',
        'latitude' => 'double',
        'longitude' => 'double',
        'is_default' => 'boolean',
        'is_invoiceable' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the municipality associated with the model.
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * Get the province associated with the model.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the region associated with the model.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the state associated with the model.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Scope the query to only include default records.
     */
    public function scopeIsDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope query to exclude default records.
     */
    public function scopeIsNotDefault(Builder $query): Builder
    {
        return $query->where('is_default', false);
    }

    /**
     * Scope a query to only include invoiceable items.
     */
    public function scopeIsInvoiceable(Builder $query): Builder
    {
        return $query->where('is_invoiceable', true);
    }

    /**
     * Scope a query to only include records that are not invoiceable.
     */
    public function scopeIsNotInvoiceable(Builder $query): Builder
    {
        return $query->where('is_invoiceable', false);
    }

    /**
     * Scope the query to only include trashed records.
     */
    public function scopeIsTrashed(Builder $query): Builder
    {
        return $query->onlyTrashed();
    }

    /**
     * Scope to filter out trashed records.
     */
    public function scopeIsNotTrashed(Builder $query): Builder
    {
        return $query->whereNull('addresses.deleted_at');
    }
}
