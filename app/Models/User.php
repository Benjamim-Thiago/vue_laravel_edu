<?php

namespace BEN\Models;

use BEN\Notifications\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface {

    use Notifiable;
    const ROLE_ADMIN = 1;
    const ROLE_TEACHER = 2;
    const ROLE_STUDENT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'enrolment'
    ];

    
    public static function createFully($data)
    {
        $password = str_random(6);
        $data['password'] = $password;
        $user = parent::create($data+['enrolment' => str_random(6)]);
        self::assignEnrolment($user, self::ROLE_ADMIN);
        self::assignRole($user, $data['type']);
        $user->save();
        if(isset($data['send_mail'])){
            $token = \Password::broker()->createToken($user);
            $user->notify(new UserCreated($token));
        }
        return compact('user', 'password');
    }
    
    public static function assignEnrolment(User $user, $type) {
        $types = [
            self::ROLE_ADMIN => 100000,
            self::ROLE_TEACHER => 400000,
            self::ROLE_STUDENT => 700000,
        ];
        
        $user->enrolment = $types[$type] + $user->id;
        return $user->enrolment;
    }
    
    public static function assignRole(User $user, $type) {
        $types = [
            self::ROLE_ADMIN => Admin::class,
            self::ROLE_TEACHER => Teacher::class,
            self::ROLE_STUDENT => Student::class,
        ];
        
        $model = $types[$type];
        $model = $model::create([]);
        $user->userable()->associate($model);
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function profile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }
    
    public function userable()
    {
        return $this->morphTo();
    }

    public function getTableHeaders(): array {
        return ['ID', 'Nome', 'Email'];
    }

    public function getValueForHeader($header) {
        switch ($header) {
            case 'ID':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Email':
                return $this->email;
        }
    }

}
