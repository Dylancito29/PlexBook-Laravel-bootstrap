<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * ANALOGY: The "White List" or VIP.
     * Only these details can enter "in a group" into the database.
     * It's a security measure so no one can change their own role or ID by injecting malicious data.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 
     * ANALOGY: The "Safe".
     * When we transform this user to text (JSON) to send it to an App or API,
     * these fields are automatically hidden. We never want to send the password over the internet!
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELATIONSHIP: "History of Borrowed Books"
    // One user can have MANY loans over time.
    // Usage: $user->loans (Get all loans made by this user).
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
