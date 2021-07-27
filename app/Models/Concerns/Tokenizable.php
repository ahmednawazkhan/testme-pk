<?php

namespace App\Models\Concerns;

use JWTAuth;
use Carbon\Carbon;

trait Tokenizable
{
    /**
     * Determine if the user want to remember
     * @var bool
     */
    public static $remember = false;

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $claims = $this->toArray();

        // $extraClaims = ['guest' => null];

        // if (!self::$remember) {
        //     $extraClaims = [
        //         'exp'  => Carbon::now()->addMinutes(config('session.lifetime'))->timestamp
        //     ];
        // }

        // if ($this->guest) {
        //     $extraClaims['guest'] = $this->guest->toArray();
        // }

        // $claims = array_merge($claims, $extraClaims);

        return $claims;
    }

    /**
     * Regenerate a new token
     * @return string
     */
    public function regenerateToken()
    {
        // Set the remember to regenerate the token
        self::$remember = is_null(JWTAuth::getClaim('exp'));

        // $payload = JWTAuth::payload();
        // $id = $payload->get('guest.id');

        // $guest = self::find($id);
        // if ($guest) {
        //     $this->setGuestUser($guest);
        // }

        return JWTAuth::fromUser($this);
    }
}
