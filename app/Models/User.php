<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\UserResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'nombre_comercial',
        'direccion',
        'codigo_postal',
        'localidad',
        'tipo',
        'fondo',
        'logo',
        'descripcion',
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
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function assignaments()
    {
        return $this->hasMany(UserAssignment::class,'user_id');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('fondo')
            ->useFallbackUrl('/images/placeholder-fondo.jpg')
            ->useFallbackPath(public_path('/images/placeholder-fondo.jpg'));

        $this->addMediaCollection('logo')
            ->useFallbackUrl('/images/placeholder-logo.jpg')
            ->useFallbackPath(public_path('/images/placeholder-logo.jpg'));
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (env('RESIZE_IMAGE') === true) {

            $this->addMediaConversion('resized-image')
                ->width(env('IMAGE_WIDTH', 300))
                ->height(env('IMAGE_HEIGHT', 300));
        }
    }

     // Relación con notificaciones (N:M)
     public function notificaciones()
     {
         return $this->belongsToMany(Notificacion::class, 'notificaciones_usuarios', 'id_usuario', 'id_notificacion')
                     ->withPivot('leida')
                     ->withTimestamps();
     }

     //Inmobiliarias
    public function viviendas()
    {
        return $this->hasMany(Vivienda::class, 'id_inmobiliaria');
    }
}
