<?php

namespace App\SupportID\Actions;

use App\Auth\Database\UserTable;
use ClientX\Actions\Action;
use ClientX\Database\NoRecordException;
use ClientX\Router;
use ClientX\Session\FlashService;
use ClientX\Translator\Translater;
use Psr\Http\Message\ServerRequestInterface;

class SupportIDSearchAction extends Action
{

    private UserTable $userTable;

    public function __construct(UserTable $userTable, FlashService $flash, Translater $translater, Router $router)
    {
        $this->userTable = $userTable;
        $this->flash = $flash;
        $this->translater = $translater;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $code = $request->getParsedBody()['code'];
        try {
            $user = $this->userTable->findBy('support_id', $code);
            $this->success($this->trans('supportid.success'));
            return $this->redirectToRoute('account.admin.edit', ['id'=> $user->getId()]);
        } catch (NoRecordException $e){
            $this->error($this->trans('supportid.notfound'));
            return $this->back($request);
        }
    }
}