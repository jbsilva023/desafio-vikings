<?php

namespace JbSilva\Rederer;

class PHPRenderer implements PHPRedererInterface
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        if (is_string($this->data)) {
            header('Content-type:text/html; charset="UTF-8"');
            echo  $this->data;
            exit;
        }

        if (is_array($this->data)) {
            header('Content-type: application/json; charset="UTF-8"');
            echo  json_encode($this->data);
            exit;
        }

        throw new \Exception("Os dados passados são inválidos.");
    }
}
