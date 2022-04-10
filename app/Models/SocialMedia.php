<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class SocialMedia extends Model
{
    use HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "twitter",
        "instagram",
        "tiktok",
        "snapchat",
        "youtube",
        "facebook",
        "whatsapp",
        "reddit",
    ];

    /**
     * Make selected properties of the model hidden for display
     * @var array
     */
    protected $hidden = ["created_at", "updated_at", "id", "user_id"];


    /**
     * Find the user that the socials belong to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
