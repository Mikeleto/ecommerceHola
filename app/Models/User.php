<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public function restaurar(User $user) {
        $user->restore();
        $user->perfil()->restore();
        session()->flash('success', 'Usuario restaurado correctamente');
        return redirect()->route('admin.usuarios.index');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'deleted_at',
        'profession_name',
        'bio',
        'twitter',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }



    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'profession' => 'required_without:profession_name|exists:professions,name',
            'profession_name' => 'required_without:profession|string|max:255',
            'bio' => 'required_without:profession|string|max:255',
            'twitter' => 'required_without:profession|url|max:255',
            'password' => 'sometimes|required|string|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
        ];
    }


}
