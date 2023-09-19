<?php
use Phinx\Seed\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

class UsersSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Primeiro Usuário',
                'email' => 'a@b.com',
                'senha' => $this->_hashPassword('senha1'), // Criptografa a senha usando SHA-256
            ],
            [
                'nome' => 'Segundo Usuário',
                'email' => 'usuario2@example.com',
                'senha' => $this->_hashPassword('senha2'), // Criptografa a senha usando SHA-256
            ],
            [
                'nome' => 'Terceiro Usuário',
                'email' => 'usuario3@example.com',
                'senha' => $this->_hashPassword('senha3'), // Criptografa a senha usando SHA-256
            ],
            [
                'nome' => 'Quarto Usuário',
                'email' => 'usuario4@example.com',
                'senha' => $this->_hashPassword('senha4'), // Criptografa a senha usando SHA-256
            ],
            [
                'nome' => 'Quinto Usuário',
                'email' => 'usuario5@example.com',
                'senha' => $this->_hashPassword('senha5'), // Criptografa a senha usando SHA-256
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }

    // Função para criptografar a senha com SHA-256
    protected function _hashPassword($password)
    {
        return hash('sha256', $password);
    }
}
