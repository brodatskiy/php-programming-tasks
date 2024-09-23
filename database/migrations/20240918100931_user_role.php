<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserRole extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_role');
        $table->addColumn('user_id', 'integer')
            ->addColumn('role_id', 'integer')
            ->addForeignKey('user_id',
                'users',
                'id',
                ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('role_id',
                'roles',
                'id',
                ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->create();
    }
}
