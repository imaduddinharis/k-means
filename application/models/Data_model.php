<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Data_model extends CI_Model {
    public $table = 'tb_prov';
    public $id = 'id';
    public $order = 'DESC';
    function __construct() {
        parent::__construct();
    }
    //ini untuk memasukkan kedalam tabel provinsi
    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'kode_wilayah' => $dataarray[$i]['kode_wilayah'],
                'wilayah' => $dataarray[$i]['wilayah'],
                'penderita' => $dataarray[$i]['penderita'],
                'hidup' => $dataarray[$i]['hidup'],
                'mati' => $dataarray[$i]['mati'],
                'luas_wilayah' => $dataarray[$i]['luas_wilayah'],
                'jumlah_penduduk' => $dataarray[$i]['jumlah_penduduk'],
                'jumlah_kelurahan' => $dataarray[$i]['jumlah_kelurahan'],
                'jumlah_layanan_kesehatan' => $dataarray[$i]['jumlah_layanan_kesehatan']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            // $this->db->where('nama', $this->input->post('nama'));
            // if ($cek) {
                $this->db->insert($this->table, $data);
            // }
        }
    }
}