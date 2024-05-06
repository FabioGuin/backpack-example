<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Common\DealerCustomerHasCommonMethods;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;
    use DealerCustomerHasCommonMethods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'code',
        'company',
        'vat',
        'tax_code',
        'pec',
        'phone_number',
        'phone_number_alt',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Generates a code based on the given prefix, company name, and ID.
     *
     * @param  string      $prefix  the prefix for the code
     * @param  string|null $company The company name. Defaults to null.
     * @param  int|null    $id      The ID. Defaults to null.
     * @return string      the generated code
     */
    public function generateCode(string $prefix, ?string $company = null, ?int $id = null): string
    {
        $id = ($id === null) ? $this->user->id : $id;

        $company = ($company === null) ? $this->company : $company;
        $company = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $company);
        $company = str_replace(' ', '', $company);
        $company = substr($company, 0, 3);
        $company = strtoupper($company);

        $code = $prefix . '-' . $company . '-' . $id;

        return $code;
    }

    /**
     * Get the addresses associated with the user.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class)
            ->with(['state', 'region', 'province', 'municipality']);
    }

    /**
     * Get the invoiceable addresses for the given entity.
     */
    public function invoiceable(): HasOne
    {
        return $this->HasOne(Address::class)
            ->with(['state', 'region', 'province', 'municipality'])
            ->isInvoiceable();
    }

    /**
     * Get the default addresses.
     */
    public function default(): HasOne
    {
        return $this->HasOne(Address::class)
            ->with(['state', 'region', 'province', 'municipality'])
            ->isDefault();
    }

    /**
     * Get the user that owns the resource.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the municipality associated with the model.
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * Get the province that this model belongs to.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the region for this model.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Scope to filter invoiceable items.
     */
    public function scopeIsInvoiceable(Builder $query): Builder
    {
        return $query->whereHas('addresses', function (Builder $query) {
            $query->where('addresses.is_invoiceable', true);
        });
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeIsActive(Builder $query): Builder
    {
        return $query->whereHas('user', function (Builder $query) {
            $query->where('users.is_active', true);
        });
    }

    /**
     * Scope to filter disabled records.
     */
    public function scopeIsDisabled(Builder $query): Builder
    {
        return $query->whereHas('user', function (Builder $query) {
            $query->where('users.is_active', false);
        });
    }

    /**
     * Scope a query to only include records where the user is to be approved.
     */
    public function scopeIsToApprove(Builder $query): Builder
    {
        return $query->whereHas('user', function (Builder $query) {
            $query->where('users.approved_at', null);
        });
    }

    /**
     * Scope to filter trashed records.
     *
     * @param  Builder $query the query builder instance
     * @return Builder the modified query builder instance
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
        return $query->whereNull($this->getTable() . '.deleted_at');
    }
}
