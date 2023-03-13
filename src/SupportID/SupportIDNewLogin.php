<?php

namespace App\SupportID;

use App\Auth\Database\UserTable;
use ClientX\Database\NoRecordException;
use ClientX\Event\Event;

class SupportIDNewLogin
{
    private UserTable $userTable;

    public function __construct(UserTable $userTable)
    {
        $this->userTable = $userTable;
    }

    public function __invoke(Event $loginEvent){
        /** @var SupportIDUser $target */
        $target = $loginEvent->getTarget();
        if (!$target instanceof \App\Auth\User){
            return;
        }

        if ($target->supportId == null){
            $while = true;
            $code = SupportIDUser::generateCodes(1)[0];
            while ($while){
                $code = SupportIDUser::generateCodes(1)[0];
                try {
                    $user = $this->userTable->findBy('support_id', $code);
                } catch (NoRecordException $e){
                    $while = false;
                }

            }
            $this->userTable->update($target->getId(), ['support_id' => $code]);
        }

    }
}