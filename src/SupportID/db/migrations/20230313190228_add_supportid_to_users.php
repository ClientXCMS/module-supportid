<?php

use App\SupportID\SupportIDUser;
use Phinx\Migration\AbstractMigration;

class AddSupportidToUsers extends AbstractMigration
{
    public function change()
    {
        $codes = SupportIDUser::generateCodes($this->fetchRow('SELECT COUNT(id) as count FROM users')['count']);
        $userTable = (new \App\Auth\Database\UserTable($this->getAdapter()->getConnection()));
        $ids = $userTable->makeQuery()->select('id')->fetchAll()->getIds();
        $this->table('users')->addColumn('support_id', 'integer', ['null' => true])->save();

        foreach ($codes as $i => $code){
            $userTable->update($ids[$i], ['support_id' => $codes[$i]]);
        }

    }
}
