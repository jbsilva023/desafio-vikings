<?php


namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Cartorios;

use Carbon\Carbon;
use PHPExcel_Cell;
use PHPExcel_IOFactory;
use SpreadsheetReader;

class ExcelController extends Controller
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function index()
    {
        return $this->view('app.form-upload-excel');
    }

    /**
     * @return array
     */
    public function importar()
    {
        $allowedType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        $columns = [
            'nome',
            'razao',
            'documento',
            'cep',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'telefone',
            'email',
            'tabeliao',
            'status'
        ];

        if (in_array($_FILES["arquivo"]["type"], $allowedType)) {
            $reader = PHPExcel_IOFactory::createReader('Excel2007');
            $reader->setReadDataOnly(true);

            $phpExcel = $reader->load($_FILES['arquivo']['tmp_name']);
            $worksheet = $phpExcel->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

            $rows = [];

            for ($row = 1; $row <= $highestRow; $row++) {
                for ($col = 0; $col < $highestColumnIndex; $col++) {
                    $rows[$row][$columns[$col]] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                }
            }

            array_shift($rows);

            try {
                foreach ($rows as $row) {
                    $cartorio = new Cartorios;

                    $documento = strlen($row['documento']) > 11 ?
                        str_pad($row['documento'], 14, '0', STR_PAD_RIGHT) :
                        $row['documento'];

                    $cartorio = $cartorio->findByColumn(['documento', $documento]);

                    $cartorio->nome = $row['nome'];
                    $cartorio->razao = $row['razao'];
                    $cartorio->telefone = Helper::unmask($row['telefone']);
                    $cartorio->email = $row['email'];
                    $cartorio->tipo_documento = strlen($row['documento']) > 11 ? 2 : 1;
                    $cartorio->documento = $documento;
                    $cartorio->tabeliao = $row['tabeliao'];
                    $cartorio->status = $row['status'] === "SIM" ? 1 : 0;
                    $cartorio = $cartorio->save();

                    if ($cartorio->id) {
                        $endereco = $cartorio->endereco();
                        $endereco->cep = Helper::unmask($row['cep']);
                        $endereco->nome = $row['endereco'];
                        $endereco->bairro = $row['bairro'];
                        $endereco->cidade = $row['cidade'];
                        $endereco->uf = $row['uf'];
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
                    'msg' => "Não foi possível importar registros.<br/><b>Erro:</b> {$e->getMessage()}",
                    'type' => 'error',
                    'reload' => false
                ];
            }
        }

        return [
            'title' => 'Atenção!',
            'msg' => "Faça upload de um arquivo .XLS ou XLSX.",
            'type' => 'info',
            'reload' => false
        ];
    }

    public function exportar()
    {
        $objPHPExcel = new \PHPExcel;
        $cartorio = new Cartorios;
        $cartorios = $cartorio->all();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NOME');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'RAZÃO');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'DOCUMENTO');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CEP');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ENDEREÇO');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'BAIRRO');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CIDADE');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'UF');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'TELEFONE');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'E-MAIL');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'TABELIÃO');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'ATIVO');

        $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setBold(true);

        $count = 2;
        foreach ($cartorios as $cartorio) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $count, $cartorio->nome);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $count, $cartorio->razao);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $count, $cartorio->documento);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $count, $cartorio->endereco()->cep);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $count, $cartorio->endereco()->nome);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $count, $cartorio->endereco()->bairro);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $count, $cartorio->endereco()->cidade);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $count, $cartorio->endereco()->uf);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $count, $cartorio->telefone);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $count, $cartorio->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $count, $cartorio->tabeliao);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $count, ($cartorio->status == 1 ? "SIM" : "NÃO"));
            $count++;
        }

        $tmpfile = tempnam(sys_get_temp_dir(), 'phpxltmp');
//        $tmpfile = tempnam('php://output', 'phpxltmp');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($tmpfile);

        $excel = file_get_contents($tmpfile);
        unlink($tmpfile);

        return [
            'title' => 'Sucesso!',
            'msg' => 'Arquivo gerado com sucesso.',
            'type' => 'success',
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($excel),
            'name' => 'Cartorios_' . Carbon::now()->format('d-m-Y_H-i-s') . '.xlsx'
        ];
    }
}