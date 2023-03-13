<?php

namespace App\SupportID;

class SupportIDUser extends \App\Account\User
{
    public ?int $supportId = null;

    /**
     * @return int|null
     */
    public function getSupportId(): ?int
    {
        return $this->supportId;
    }

    /**
     * @param int|null $supportId
     */
    public function setSupportId(?int $supportId): void
    {
        $this->supportId = $supportId;
    }


    public static function generateCodes($nbCodes) {
        $codes = [];

        while (count($codes) < $nbCodes) {
            $code = strval(mt_rand(1000, 9999));

            if (!in_array($code, $codes)) {
                $codes[] = $code;
            }
        }

        return $codes;
    }

}