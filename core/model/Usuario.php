<?php

namespace core\model;

use core\CRUD;
use Exception;

class Usuario extends CRUD {

    const TABELA = "usuario";
    const COL_USUARIO_ID = "usuario_id";
    const COL_NOME = "nome";
    const COL_CPF = "cpf";
    const COL_SENHA = "senha";
    const COL_EMAIL = "email";
    const COL_DATA_NASCIMENTO = "data_nascimento";
    const COL_TELEFONE = "telefone";
    const COL_ENDERECO = "endereco";
    const COL_BAIRRO = "bairro";
    const COL_ESTADO = "estado";
    const COL_CIDADE = "cidade";
    const COL_CEP = "cep";
    const COL_NACIONALIDADE = "nacionalidade";
    const COL_OCUPACAO = "ocupacao";
    const COL_ADMIN = "admin";

    /**
     * @param $dados
     * @return bool
     */
    public function adicionar($dados) {

        try {

            $retorno = $this->create(self::TABELA, $dados);

        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
            return false;
        }

        return $retorno;
    }

    /**
     * @param $dados
     * @return bool
     * @throws Exception
     */
    public function alterar($dados) {

        if (!isset($dados[self::COL_USUARIO_ID])) {
            throw new Exception("É necessário informar o ID do usuário para atualizar");
        }

        $where_condicao = self::COL_USUARIO_ID . " = ?";
        $where_valor[] = $dados[self::COL_USUARIO_ID];

        try {

            $this->update(self::TABELA, $dados, $where_condicao, $where_valor);

        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
            return false;
        }

        return $dados[self::COL_USUARIO_ID];
    }

    /**
     * @param null $campos
     * @param array $busca
     * @param null $ordem
     * @param null $limite
     * @return array
     */
    public function listar($campos = null, $busca = [], $ordem = null, $limite = null) {

        $campos = $campos != null ? $campos : "*";
        $ordem = $ordem != null ? $ordem : self::COL_NOME . " ASC";
        $limite = $limite != null ? $limite : 10;

        $where_condicao = "1 = 1";
        $where_valor = [];

        if (count($busca) > 0) {

            if (isset($busca[self::COL_NOME]) && !empty($busca[self::COL_NOME])) {
                $where_condicao .= " AND " . self::COL_NOME . " LIKE ?";
                $where_valor[] = "%{$busca[self::COL_NOME]}%";
            }

            if (isset($busca[self::COL_CPF]) && !empty($busca[self::COL_CPF])) {
                $where_condicao .= " AND " . self::COL_CPF . " = ?";
                $where_valor[] = $busca[self::COL_CPF];
            }

        }

        $retorno = [];

        try {

            $retorno = $this->read(self::TABELA, $campos, $where_condicao, $where_valor, null, $ordem, $limite);

        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
        }

        return $retorno;
    }

    /**
     * @param $usuario_id
     * @return array
     */
    public function selecionarUsuario($usuario_id) {

        $where_condicao = self::COL_USUARIO_ID . " = ?";
        $where_valor[] = $usuario_id;

        $retorno = [];

        try {

            $retorno = $this->read(self::TABELA, "*", $where_condicao, $where_valor, null, null, 1);

        } catch (Exception $e) {
            echo "Mensagem: " . $e->getMessage() . "\n Local: " . $e->getTraceAsString();
        }

        return $retorno;
    }
}
