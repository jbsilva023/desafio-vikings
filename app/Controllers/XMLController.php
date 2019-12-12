<?php


namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Cartorios;

class XMLController extends Controller
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


    public function index()
    {
        return $this->view('app.form-upload-xml');
    }

    /**
     * @return array
     */
    public function importar()
    {
        $allowedType = ['text/xml'];

        if (in_array($_FILES['arquivo']['type'], $allowedType)) {
            try {
                $xml = simplexml_load_file($_FILES['arquivo']['tmp_name']);

                foreach ($xml as $item) {
                    $cartorio = new Cartorios;

                    $documento = strlen(Helper::unmask($item->documento)) > 11 ?
                        str_pad($item->documento, 14, '0', STR_PAD_RIGHT) :
                        $item->documento;

                    $cartorio = $cartorio->findByColumn(['documento', $documento]);

                    $cartorio->nome = $item->nome;
                    $cartorio->razao = $item->razao;
                    $cartorio->tipo_documento = $item->tipo_documento;
                    $cartorio->documento = $documento;
                    $cartorio->tabeliao = $item->tabeliao;
                    $cartorio->status = $item->ativo;
                    $cartorio = $cartorio->save();

                    if ($cartorio->id) {
                        $endereco = $cartorio->endereco();
                        $endereco->cep = Helper::unmask($item->cep);
                        $endereco->nome = $item->endereco;
                        $endereco->bairro = $item->bairro;
                        $endereco->cidade = $item->cidade;
                        $endereco->uf = $item->uf;
                        $endereco->cartorio_id = $cartorio->id;
                        $endereco->save();
                    }
                }

                return [
                    'title' => 'Sucesso!',
                    'msg' => 'Registro importados com sucesso.',
                    'type' => 'success',
                    'reload' => true
                ];

            } catch (\Exception $e) {
                return [
                    'title' => 'Erro!',
                    'msg' => "Não foi possível importar os registros. <br/>{$e->getMessage()}",
                    'type' => 'error',
                    'reload' => false
                ];
            }
        }

        return [
            'title' => 'Atenção!',
            'msg' => "Faça upload de um arquivo XML",
            'type' => 'info',
            'reload' => false
        ];
    }
}