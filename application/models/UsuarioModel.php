<?php
defined('BASEPATH') || exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d-m-Y H:i:s');
            $dataHoraCriacao = array(
                "dataHoraCriacao" => $data
            );
            $dados = $dados + $dataHoraCriacao;
            return ($this->db->insert(usuario, $dados)) ? true : false;
        }
    }

    public function AtualizarRegistro($dados = null, $pessoa = null)
    {
        if ($dados && $pessoa) {
            $this->db->where('id', $pessoa);
            return ($this->db->update(usuario, $dados)) ? true : false;
        }
    }

    public function ObterRegistro()
    {
        $comando = 'select top 1000 name as "Banco de Dados",* from msdb.dbo.trace_dia_geral, msdb.dbo.banco_dados  where duration > 2
    and trace_dia_geral.DatabaseID = banco_dados.dbid order by StartTime desc';
        $cadastros = $this->db->query($comando);
        
        $lista = array();
        
        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados['blockedsid'] = $cadastro->blockedsid;
            $dados['blockingsid'] = $cadastro->blockingsid;
            $dados['eventinfo1'] = $cadastro->eventinfo1;
            $dados['eventinfo2'] = $cadastro->eventinfo2;
            $dados['waittime'] = $cadastro->waittime;
            $dados['hostname'] = $cadastro->hostname;
            $dados['dat_bloqueio'] = $cadastro->dat_bloqueio;
            $dados['program_name1'] = $cadastro->program_name1;
            $dados['program_name2'] = $cadastro->program_name2;
            $dados['host_blocking'] = $cadastro->host_blocking;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($pessoa = null)
    {
        if ($pessoa) {
            return $this->db->where('id', $pessoa)->delete(usuario);
        }
    }
}