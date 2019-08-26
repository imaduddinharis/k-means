<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dummy extends CI_Controller
{

    private $buildTable;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('url');
        $this->load->model('Province');
        $this->load->model('Clustertmp');
    }

    public function index()
    {
        $getAllData = Province::all();
        Clustertmp::truncate();
        $arrData = array();
        $arrDataC1 = array();
        $arrDataC2 = array();
        $arrDataC3 = array();
        $idC1 = array();
        $idC2 = array();
        $idC3 = array();
        $allDataCluster = array();
        foreach ($getAllData as $datas => $values):
            array_push($arrData,
                $values->id
            );
        endforeach;

        $getDataRand = array_rand(array_flip($arrData), 3);

        // if centroid random
        $getCentroidC1 = Province::where('id',$getDataRand[0])->get();
        $getCentroidC2 = Province::where('id',$getDataRand[1])->get();
        $getCentroidC3 = Province::where('id',$getDataRand[2])->get();

        //if centroid fixed
        // $getCentroidC1 = Province::where('id', '3')->get();
        // $getCentroidC2 = Province::where('id', '10')->get();
        // $getCentroidC3 = Province::where('id', '15')->get();

        foreach ($getAllData as $datas => $values):
            $d1 = $values->penderita;
            $d2 = $values->hidup;
            $d3 = $values->mati;
            $c1d1 = $getCentroidC1[0]['penderita'];
            $c1d2 = $getCentroidC1[0]['hidup'];
            $c1d3 = $getCentroidC1[0]['mati'];
            $c2d1 = $getCentroidC2[0]['penderita'];
            $c2d2 = $getCentroidC2[0]['hidup'];
            $c2d3 = $getCentroidC2[0]['mati'];
            $c3d1 = $getCentroidC3[0]['penderita'];
            $c3d2 = $getCentroidC3[0]['hidup'];
            $c3d3 = $getCentroidC3[0]['mati'];

            $opt1 = pow(($d1 - $c1d1), 2);
            $opt1 = $opt1 + pow(($d2 - $c1d2), 2);
            $opt1 = $opt1 + pow(($d3 - $c1d3), 2);
            $opt1 = sqrt($opt1);

            $opt2 = pow(($d1 - $c2d1), 2);
            $opt2 = $opt2 + pow(($d2 - $c2d2), 2);
            $opt2 = $opt2 + pow(($d3 - $c2d3), 2);
            $opt2 = sqrt($opt2);

            $opt3 = pow(($d1 - $c3d1), 2);
            $opt3 = $opt3 + pow(($d2 - $c3d2), 2);
            $opt3 = $opt3 + pow(($d3 - $c3d3), 2);
            $opt3 = sqrt($opt3);

            $optData = array($opt1, $opt2, $opt3);

            if ($opt1 == min($optData)) {
                array_push($arrDataC1,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 1,
                    )
                );
                array_push($allDataCluster,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 1,
                    )
                );
                array_push($idC1, $values->id);
            } else if ($opt2 == min($optData)) {
            array_push($arrDataC2,
                array(
                    'id' => $values->id,
                    'dtoc1' => $opt1,
                    'dtoc2' => $opt2,
                    'dtoc3' => $opt3,
                    'provinsi' => $values->wilayah,
                    'jumlah_penderita' => $values->penderita,
                    'jumlah_hidup' => $values->hidup,
                    'jumlah_mati' => $values->mati,
                    'cluster' => 2,
                )
            );
            array_push($allDataCluster,
                array(
                    'id' => $values->id,
                    'dtoc1' => $opt1,
                    'dtoc2' => $opt2,
                    'dtoc3' => $opt3,
                    'provinsi' => $values->wilayah,
                    'jumlah_penderita' => $values->penderita,
                    'jumlah_hidup' => $values->hidup,
                    'jumlah_mati' => $values->mati,
                    'cluster' => 2,
                )
            );
            array_push($idC2, $values->id);
        } else if ($opt3 == min($optData)) {
            array_push($arrDataC3,
                array(
                    'id' => $values->id,
                    'dtoc1' => $opt1,
                    'dtoc2' => $opt2,
                    'dtoc3' => $opt3,
                    'provinsi' => $values->wilayah,
                    'jumlah_penderita' => $values->penderita,
                    'jumlah_hidup' => $values->hidup,
                    'jumlah_mati' => $values->mati,
                    'cluster' => 3,
                )
            );
            array_push($allDataCluster,
                array(
                    'id' => $values->id,
                    'dtoc1' => $opt1,
                    'dtoc2' => $opt2,
                    'dtoc3' => $opt3,
                    'provinsi' => $values->wilayah,
                    'jumlah_penderita' => $values->penderita,
                    'jumlah_hidup' => $values->hidup,
                    'jumlah_mati' => $values->mati,
                    'cluster' => 3,
                )
            );
            array_push($idC3, $values->id);
        }

        endforeach;

        /* iterasi lanjut */

        $allDataClusterTemp = array();
        $arrDataC1Temp = array();
        $arrDataC2Temp = array();
        $arrDataC3Temp = array();

        $idC1tmp = array();
        $idC2tmp = array();
        $idC3tmp = array();

        // $arrDataC1Temp = $arrDataC1;
        // $arrDataC2Temp = $arrDataC2;
        // $arrDataC3Temp = $arrDataC3;

        $allDataClusterIterasi = $allDataCluster;
        $arrDataC1Iterasi = $arrDataC1;
        $arrDataC2Iterasi = $arrDataC2;
        $arrDataC3Iterasi = $arrDataC3;

        $jumlahIterasi = 1;

        $runIteration = true;

        $loading = 0;

        // var_dump($c1d1x);
        // var_dump($c1d2x);
        // var_dump($c1d3x);
        // return false;
        $c1d1x = 0;
        $c1d2x = 0;
        $c1d3x = 0;
        $c2d1x = 0;
        $c2d2x = 0;
        $c2d3x = 0;
        $c3d1x = 0;
        $c3d2x = 0;
        $c3d3x = 0;
        while ($runIteration) {
            $validationCluster = 0;
            $jumlahIterasi++;
            // var_dump($validationCluster);
            // return false;

            if ($allDataClusterTemp != null) {
                $allDataClusterIterasi = $allDataClusterTemp;
                $arrDataC1Iterasi = $arrDataC1Temp;
                $arrDataC2Iterasi = $arrDataC2Temp;
                $arrDataC3Iterasi = $arrDataC3Temp;
            }
            if ($idC1tmp != null || $idC2tmp != null || $idC3tmp != null) {
                $idC1 = $idC1tmp;
                $idC2 = $idC2tmp;
                $idC3 = $idC3tmp;
            }
            // var_dump($arrDataC1Temp);
            foreach ($arrDataC1Iterasi as $valC1x) {
                $c1d1x += $valC1x['jumlah_penderita'];
                $c1d2x += $valC1x['jumlah_hidup'];
                $c1d3x += $valC1x['jumlah_mati'];
            }
            // var_dump($arrDataC1Iterasi);
            if ($arrDataC1Iterasi != null) {
                $c1d1x = $c1d1x / count($arrDataC1Iterasi);
                $c1d2x = $c1d2x / count($arrDataC1Iterasi);
                $c1d3x = $c1d3x / count($arrDataC1Iterasi);
            } else {
                $c1d1x = 0;
                $c1d2x = 0;
                $c1d3x = 0;
            }

            foreach ($arrDataC2Iterasi as $valC2x) {
                $c2d1x += $valC2x['jumlah_penderita'];
                $c2d2x += $valC2x['jumlah_hidup'];
                $c2d3x += $valC2x['jumlah_mati'];
            }
            // var_dump($arrDataC2Iterasi);
            if ($arrDataC2Iterasi != null) {
                $c2d1x = $c2d1x / count($arrDataC2Iterasi);
                $c2d2x = $c2d2x / count($arrDataC2Iterasi);
                $c2d3x = $c2d3x / count($arrDataC2Iterasi);
            } else {
                $c2d1x = 0;
                $c2d2x = 0;
                $c2d3x = 0;
            }

            foreach ($arrDataC3Iterasi as $valC3x) {
                $c3d1x += $valC3x['jumlah_penderita'];
                $c3d2x += $valC3x['jumlah_hidup'];
                $c3d3x += $valC3x['jumlah_mati'];
            }
            // var_dump($arrDataC3Iterasi);
            if ($arrDataC3Iterasi != null) {
                $c3d1x = $c3d1x / count($arrDataC3Iterasi);
                $c3d2x = $c3d2x / count($arrDataC3Iterasi);
                $c3d3x = $c3d3x / count($arrDataC3Iterasi);
            } else {
                $c3d1x = 0;
                $c3d2x = 0;
                $c3d3x = 0;
            }

            // unset($allDataClusterTemp);
            // unset($arrDataC1Temp);
            // unset($arrDataC2Temp);
            // unset($arrDataC3Temp);

            $allDataClusterTemp = array();
            $arrDataC1Temp = array();
            $arrDataC2Temp = array();
            $arrDataC3Temp = array();

            $idC1tmp = array();
            $idC2tmp = array();
            $idC3tmp = array();

            foreach ($getAllData as $datas => $values):
                $d1 = $values->penderita;
                $d2 = $values->hidup;
                $d3 = $values->mati;

                $opt1 = pow(($d1 - $c1d1x), 2);
                $opt1 = $opt1 + pow(($d2 - $c1d2x), 2);
                $opt1 = $opt1 + pow(($d3 - $c1d3x), 2);
                $opt1 = sqrt($opt1);

                $opt2 = pow(($d1 - $c2d1x), 2);
                $opt2 = $opt2 + pow(($d2 - $c2d2x), 2);
                $opt2 = $opt2 + pow(($d3 - $c2d3x), 2);
                $opt2 = sqrt($opt2);

                $opt3 = pow(($d1 - $c3d1x), 2);
                $opt3 = $opt3 + pow(($d2 - $c3d2x), 2);
                $opt3 = $opt3 + pow(($d3 - $c3d3x), 2);
                $opt3 = sqrt($opt3);

                $optData = array($opt1, $opt2, $opt3);

                if ($opt1 == min($optData)) {
                    array_push($arrDataC1Temp,
                        array(
                            'id' => $values->id,
                            'dtoc1' => $opt1,
                            'dtoc2' => $opt2,
                            'dtoc3' => $opt3,
                            'provinsi' => $values->wilayah,
                            'jumlah_penderita' => $values->penderita,
                            'jumlah_hidup' => $values->hidup,
                            'jumlah_mati' => $values->mati,
                            'cluster' => 1,
                        )
                    );
                    array_push($allDataClusterTemp,
                        array(
                            'id' => $values->id,
                            'dtoc1' => $opt1,
                            'dtoc2' => $opt2,
                            'dtoc3' => $opt3,
                            'provinsi' => $values->wilayah,
                            'jumlah_penderita' => $values->penderita,
                            'jumlah_hidup' => $values->hidup,
                            'jumlah_mati' => $values->mati,
                            'cluster' => 1,
                        )
                    );
                    array_push($idC1tmp, $values->id);
                } else if ($opt2 == min($optData)) {
                array_push($arrDataC2Temp,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 2,
                    )
                );
                array_push($allDataClusterTemp,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 2,
                    )
                );
                array_push($idC2tmp, $values->id);
            } else if ($opt3 == min($optData)) {
                array_push($arrDataC3Temp,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 3,
                    )
                );
                array_push($allDataClusterTemp,
                    array(
                        'id' => $values->id,
                        'dtoc1' => $opt1,
                        'dtoc2' => $opt2,
                        'dtoc3' => $opt3,
                        'provinsi' => $values->wilayah,
                        'jumlah_penderita' => $values->penderita,
                        'jumlah_hidup' => $values->hidup,
                        'jumlah_mati' => $values->mati,
                        'cluster' => 3,
                    )
                );
                array_push($idC3tmp, $values->id);
            }
            endforeach;

            // var_dump($c1d1x.' , '.$c1d2x.' , '.$c1d3x);
            // return false;
            foreach ($allDataClusterTemp as $val):
                $postCluster = Clustertmp::create(array(
                    'dtoc1'     => $val['dtoc1'],
                    'dtoc2'     => $val['dtoc2'],
                    'dtoc3'     => $val['dtoc3'],
                    'c1'        => number_format($c1d1x,2).' , '.number_format($c1d2x,2).' , '.number_format($c1d3x,2),
                    'c2'        => number_format($c2d1x,2).' , '.number_format($c2d2x,2).' , '.number_format($c2d3x,2),
                    'c3'        => number_format($c3d1x,2).' , '.number_format($c3d2x,2).' , '.number_format($c3d3x,2),
                    'prov'      => $val['id'],
                    'jumlah_penderita'    => $val['jumlah_penderita'],
                    'cluster'   => $val['cluster'],
                    'iterasi'   => $jumlahIterasi
                ));
            endforeach;

            // var_dump($postCluster);

            // return false;
            /* check cluster 1 */
            foreach ($idC1tmp as $valItC1):
                if (in_array($valItC1, $idC1)) {
                    // $validationCluster = $validationCluster + 1;
                } else {
                    $validationCluster = $validationCluster + 1;
                }
            endforeach;

            foreach($idC1 as $valItC1):
                if(in_array($valItC1,$idC1tmp)){
                    // $validationCluster = $validationCluster + 1;
                }else{
                    $validationCluster = $validationCluster + 1;
                }
            endforeach;
            foreach($idC1tmp as $valItC1):
                if(in_array($valItC1,$idC1)){
                    // $validationCluster = $validationCluster + 1;
                }else{
                    $validationCluster = $validationCluster + 1;
                }
            endforeach;

            // var_dump('validation cluster 1: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);
            // var_dump($idC1);
            // var_dump($idC1tmp);
            // return false;
            /* end check cluster 1 */
            /* check cluster 2 */
            if ($validationCluster != 0) {
                foreach ($idC2tmp as $valItC2):
                    if (in_array($valItC2, $idC2)) {
                        // $validationCluster = $validationCluster + 1;
                    } else {
                        $validationCluster = $validationCluster + 1;
                    }
                endforeach;
                foreach ($idC2 as $valItC2):
                    if (in_array($valItC2, $idC2tmp)) {
                        // $validationCluster = $validationCluster + 1;
                    } else {
                        $validationCluster = $validationCluster + 1;
                    }
                endforeach;
            }
            // var_dump('validation cluster 2: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);

            /* end check cluster 2 */
            /* check cluster 3 */
            if ($validationCluster != 0) {
                foreach ($idC3tmp as $valItC3):
                    if (in_array($valItC3, $idC3)) {
                        // $validationCluster = $validationCluster + 1;
                    } else {
                        $validationCluster = $validationCluster + 1;
                    }
                endforeach;
                foreach ($idC3 as $valItC3):
                    if (in_array($valItC3, $idC3tmp)) {
                        // $validationCluster = $validationCluster + 1;
                    } else {
                        $validationCluster = $validationCluster + 1;
                    }
                endforeach;
                
            }
            // var_dump('validation cluster 3: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);

            /* end check cluster 3 */

            if ($validationCluster == 0) {
                $runIteration = false;
            }
            // var_dump($jumlahIterasi);
            // var_dump($jumlahIterasi);
            $c1d1x = 0;
            $c1d2x = 0;
            $c1d3x = 0;
            $c2d1x = 0;
            $c2d2x = 0;
            $c2d3x = 0;
            $c3d1x = 0;
            $c3d2x = 0;
            $c3d3x = 0;
        }

        /* end iterasi lanut */
        // var_dump('jumlah iterasi: '.$jumlahIterasi);
        // return false;
        if($jumlahIterasi < 3){
            redirect(base_url());
        }

        // return false;
        $data['centroid1'] = $getCentroidC1;
        $data['centroid2'] = $getCentroidC2;
        $data['centroid3'] = $getCentroidC3;

        $data['getAll'] = $getAllData;

        $data['identIterasi'] = Clustertmp::orderBy('iterasi','ASC')->groupBy('iterasi')->get();
        $getDataGrafikC1 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','1')->sum('jumlah_penderita');        
        $countC1 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','1')->count();
        $getDataGrafikC2 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','2')->sum('jumlah_penderita');        
        $countC2 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','2')->count();
        $getDataGrafikC3 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','3')->sum('jumlah_penderita');        
        $countC3 = Clustertmp::where('iterasi',$jumlahIterasi)->where('cluster','3')->count();
        $getDataGrafikC1 = intVal($getDataGrafikC1/$countC1);
        $getDataGrafikC2 = intVal($getDataGrafikC2/$countC2);
        $getDataGrafikC3 = intVal($getDataGrafikC3/$countC3);
        $dataset = $getDataGrafikC1.','.$getDataGrafikC2.','.$getDataGrafikC3;
        
        $label1 = 'Cluster 1: ';$label2 = 'Cluster 2: ';$label3 = 'Cluster 3: ';
        /*-------------------------------*/
        if($getDataGrafikC1 < $getDataGrafikC2 && $getDataGrafikC1 < $getDataGrafikC3 && $getDataGrafikC2 < $getDataGrafikC3){
            $label1.='rendah';
            $label2.='sedang';
            $label3.='tinggi';
        }
        if($getDataGrafikC1 < $getDataGrafikC2 && $getDataGrafikC1 < $getDataGrafikC3 && $getDataGrafikC2 > $getDataGrafikC3){
            $label1.='rendah';
            $label3.='sedang';
            $label2.='tinggi';
        }
        /*-------------------------------*/
        if($getDataGrafikC2 < $getDataGrafikC1 && $getDataGrafikC2 < $getDataGrafikC3 && $getDataGrafikC1 < $getDataGrafikC3){
            $label2.='rendah';
            $label1.='sedang';
            $label3.='tinggi';
        }
        if($getDataGrafikC2 < $getDataGrafikC1 && $getDataGrafikC2 < $getDataGrafikC3 && $getDataGrafikC1 > $getDataGrafikC3){
            $label2.='rendah';
            $label3.='sedang';
            $label1.='tinggi';
        }
        /*-------------------------------*/
        if($getDataGrafikC3 < $getDataGrafikC1 && $getDataGrafikC3 < $getDataGrafikC2 && $getDataGrafikC1 < $getDataGrafikC2){
            $label3.='rendah';
            $label1.='sedang';
            $label2.='tinggi';
        }
        if($getDataGrafikC3 < $getDataGrafikC1 && $getDataGrafikC3 < $getDataGrafikC2 && $getDataGrafikC1 > $getDataGrafikC2){
            $label3.='rendah';
            $label2.='sedang';
            $label1.='tinggi';
        }
        


        $data['label'] = "'".$label1."','".$label2."','".$label3."'";
        
        
        $data['dataset'] = $dataset;
        $data['dataCluster'] = $allDataCluster;
        $data['dataClusterIterasi'] = $allDataClusterTemp;
        $this->load->view('index', $data);
    }

    public function upload()
    {
        Province::truncate();
        $config['upload_path'] = './temp_upload/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if ( !$this->upload->do_upload('datahiv')) {
            // jika validasi file gagal, kirim parameter error ke index
            $error = array('error' => $this->upload->display_errors());
            $this->index($error);
        } else {
          // jika berhasil upload ambil data dan masukkan ke database
          $upload_data = $this->upload->data();
          // load library Excell_Reader
          $this->load->library('Excel_reader');
          //tentukan file
          $this->excel_reader->setOutputEncoding('230787');
          $file = $upload_data['full_path'];
          $this->excel_reader->read($file);
          error_reporting(E_ALL ^ E_NOTICE);
          // array data
          $data = $this->excel_reader->sheets[0];
          $dataexcel = Array();
          for ($i = 1; $i <= $data['numRows']; $i++) {
               if ($data['cells'][$i+1][1] == NULL)
                   break;
               $dataexcel[$i - 1]['kode_wilayah'] = $data['cells'][$i+1][2];
               $dataexcel[$i - 1]['wilayah'] = $data['cells'][$i+1][3];
               $dataexcel[$i - 1]['penderita'] = $data['cells'][$i+1][4];
               $dataexcel[$i - 1]['hidup'] = $data['cells'][$i+1][5];
               $dataexcel[$i - 1]['mati'] = $data['cells'][$i+1][6];
               $dataexcel[$i - 1]['luas_wilayah'] = $data['cells'][$i+1][7];
               $dataexcel[$i - 1]['jumlah_penduduk'] = $data['cells'][$i+1][8];
               $dataexcel[$i - 1]['jumlah_kelurahan'] = $data['cells'][$i+1][9];
               $dataexcel[$i - 1]['jumlah_layanan_kesehatan'] = $data['cells'][$i+1][10];
          }
          //load model
          $this->load->model('Data_model');
          $this->Data_model->loaddata($dataexcel);
          //delete file
          $file = $upload_data['file_name'];
          $path = './temp_upload/' . $file;
          unlink($path);
          
        redirect(base_url());
        }
    }

}
