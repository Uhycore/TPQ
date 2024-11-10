<?php
require_once 'detailNilaiNode.php';

class NilaiNode
{
    public $nilaiId;
    public $santri;
    public $detailNilai;

    public function __construct($nilaiId, $santri, $detailNilai)
    {
        $this->nilaiId = $nilaiId;
        $this->santri = $santri;
        $this->detailNilai = [];
    }
}
