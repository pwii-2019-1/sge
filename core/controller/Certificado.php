<?php

namespace core\controller;

use Mpdf\Mpdf;
use Mpdf\MpdfException;

class Certificado {

    /**
     * @return bool
     * @throws MpdfException
     */
    public function gerarCertificado() {

        $converte_mes = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $data_inicio = '2019-05-22';
        $data_fim = '2019-05-25';

        if ($data_inicio != $data_fim) {

            $di = explode('-', $data_inicio);
            $df = explode('-', $data_fim);

            $periodo = "no período de {$di[2]} a {$df[2]} de {$converte_mes[$df[1]]} de {$df[0]}";

        } else {

            $di = explode('-', $data_inicio);

            $periodo = "na data de {$di[2]} de {$converte_mes[$di[1]]} de {$di[0]}";

        }

        $data_emissao = date('d') . " de " . $converte_mes[date('m')] . " de " . date('Y');

        $dados = [
            'nome' => 'Fulado de Tal da Silva',
            'cpf' => '012.345.678-90',
            'evento' => 'III Semana Acadêmica da Graduação e Pós-Graduação do Campus Ceres',
            'periodo' => $periodo,
            'carga_horaria' => '06',
            'data_emissao' => $data_emissao
        ];

        $html = "<!DOCTYPE html>";
        $html .= "<html lang='pt-br'>";
        $html .= "<head>";
        $html .= "    <meta charset='UTF-8'>";
        $html .= "    <title>Certificado</title>";
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center bold fs16 pt10'>MINISTÉRIO DA EDUCAÇÃO</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center bold fs16'>SECRETARIA DE EDUCAÇÃO PROFISSIONAL E TECNOLÓGICA</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center bold fs16 pb170'>INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA GOIANO<br/> CAMPUS CERES</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center'>O IF Goiano - Campus Ceres no uso de suas atribuições e em consonância com a legislação vigente certifica que</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center fs18 p10'>{$dados['nome']}</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='center pb80 lh'>
                            CPF nº {$dados['cpf']}, participou das atividades do(a) {$dados['evento']}, promovido pelo(a) Coordenação de Sistemas
                            de Informação {$dados['periodo']} com carga horária de {$dados['carga_horaria']}h.
                          </td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td colspan='3' class='right pb80'>Ceres - Goiás, {$dados['data_emissao']}</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td class='center'>Nome</td>";
        $html .= "        <td class='center'>Nome</td>";
        $html .= "        <td class='center'>Nome</td>";
        $html .= "    </tr>";
        $html .= "    <tr>";
        $html .= "        <td class='center pb30'>Cargo/Função</td>";
        $html .= "        <td class='center pb30'>Cargo/Função</td>";
        $html .= "        <td class='center pb30'>Cargo/Função</td>";
        $html .= "    </tr>";
        $html .= "</table>";
        $html .= "</body>";
        $html .= "</html>";

        $config = [
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => 0,
            'default_font' => 14,
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'L',
        ];

        $pdf = new Mpdf($config);

        $style = file_get_contents(ROOT . 'public_html/assets/css/certificado.css');

        $pdf->WriteHTML($style, 1);
        $pdf->WriteHTML($html);

        $pdf->Output('Certificado.pdf', 'D');

        return true;

    }

}