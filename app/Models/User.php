<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use App\Models\AdsModels\AdsPlan;
use App\Models\AdsModels\AdsToken;
use App\Models\UserAttributes\HasSpAttributes;
use App\Models\UserAttributes\HasTypeAttributes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class User
 * @package App\Models
 * @property integer id
 * @property string name
 * @property string email
 * @property Carbon email_verified_at
 * @property string password
 * @property boolean is_active
 * @property string user_type
 * @property integer parent_id
 * @property string seller_id
 * @property string profile_id
 * @property integer marketplace_id
 * @property string region_code
 * @property string delete_status
 * @property Carbon last_activity_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User parent
 * @property User[] children
 * @property User[] siblings
 * @property User[] user_accounts
 * @property Marketplace marketplace
 * @property SpToken sp_token
 * @property Connection connection
 * @property AdsToken ads_token
 * @property AdsPlan ads_plan
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasTypeAttributes,HasSpAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dob',
        'email_verified_at',
        'password',
        'is_active',
        'user_type',
        'parent_id',
        'seller_id',
        'profile_id',
        'marketplace_id',
        'region_code',
        'delete_status',
        'last_activity_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => UserTypeEnum::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'dob' => 'date',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function isSuperAdminUser(): bool
    {
        return $this->id === 1;
    }

}
