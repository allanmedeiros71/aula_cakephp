<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table
            ->addColumn('nome', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('senha', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addPrimaryKey('id')
            ->addIndex('email', ['unique' => true])
            ->create();
    }
}
