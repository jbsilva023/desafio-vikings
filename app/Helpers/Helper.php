<?php


namespace App\Helpers;


class Helper
{
    static function mask($type, $value)
    {
        if ($value) {
            switch ($type) {
                case 'CNPJ':
                    return substr($value, 0, 2) . '.' . substr($value, 2, 3) .
                        '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4)
                        . '-' . substr($value, 12);
                    break;
                case 'CPF':
                    return substr($value, 0, 3) . '.' . substr($value, 3, 3) .
                        '.' . substr($value, 6, 2) . '-' . substr($value, 8);
                    break;
                case 'TELEFONE':
                    break;
                case 'CEP':
                    return substr($value, 0, 5) . '-' . substr($value, 5);
                    break;
                default:
                    return $value;
                    break;
            }
        }

        return $value;
    }

    static function unmask($value)
    {
        if (!empty($value)){
            $value =  preg_replace('/\D+/', '', $value);
        }

        return $value;
    }

    static function remove_characters($text)
    {
        $utf8 = [
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   '', // Literally a single quote
            '/[“”«»„]/u'    =>   '', // Double quote
            '/ /'           =>   '_', // nonbreaking space (equiv. to 0x160)
        ];
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }

    static function replaceUrl($value)
    {
        $url = explode('?', $value);
        return $url[0];
    }
}