<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kmeans extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private $buildTable;

	public function __construct(){
        parent::__construct();
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
		$idC1=array();
		$idC2=array();
		$idC3=array();
		$allDataCluster = array();
		foreach($getAllData as $datas=>$values):
			array_push($arrData,
				$values->id
			);
		endforeach;
		
		$getDataRand = array_rand(array_flip($arrData),3);
		
		//if centroid random
		// $getCentroidC1 = Province::where('id',$getDataRand[0])->get();
		// $getCentroidC2 = Province::where('id',$getDataRand[1])->get();
		// $getCentroidC3 = Province::where('id',$getDataRand[2])->get();
		
		//if centroid fixed
		$getCentroidC1 = Province::where('id','109')->get();
		$getCentroidC2 = Province::where('id','120')->get();
		$getCentroidC3 = Province::where('id','126')->get();
		

		foreach($getAllData as $datas=>$values):
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
			
			$opt1 = pow(($d1-$c1d1),2);
			$opt1 = $opt1 + pow(($d2-$c1d2),2);
			$opt1 = $opt1 + pow(($d3-$c1d3),2);
			$opt1 = sqrt($opt1);

			$opt2 = pow(($d1-$c2d1),2);
			$opt2 = $opt2 + pow(($d2-$c2d2),2);
			$opt2 = $opt2 + pow(($d3-$c2d3),2);
			$opt2 = sqrt($opt2);

			$opt3 = pow(($d1-$c3d1),2);
			$opt3 = $opt3 + pow(($d2-$c3d2),2);
			$opt3 = $opt3 + pow(($d3-$c3d3),2);
			$opt3 = sqrt($opt3);

			$optData = array($opt1,$opt2,$opt3);
			
			if($opt1 == min($optData)){
				array_push($arrDataC1,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 1
					)			
				);
				array_push($allDataCluster,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 1
					)			
				);
				array_push($idC1,$values->id);
			}else if($opt2 == min($optData)){
				array_push($arrDataC2,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 2
					)			
				);
				array_push($allDataCluster,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 2
					)			
				);
				array_push($idC2,$values->id);
			}else if($opt3 == min($optData)){
				array_push($arrDataC3,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 3
					)			
				);
				array_push($allDataCluster,
					array(
						'id' 				=> $values->id,
						'dtoc1'				=> $opt1,
						'dtoc2'				=> $opt2,
						'dtoc3'				=> $opt3,
						'provinsi'			=> $values->wilayah,
						'jumlah_penderita'	=> $values->penderita,
						'jumlah_hidup'		=> $values->hidup,
						'jumlah_mati'		=> $values->mati,
						'cluster'			=> 3
					)			
				);
				array_push($idC3,$values->id);
			}

		endforeach;

		/* iterasi lanjut */

		$allDataClusterTemp = array();
		$arrDataC1Temp = array();
		$arrDataC2Temp = array();
		$arrDataC3Temp = array();

		$idC1tmp=array();
		$idC2tmp=array();
		$idC3tmp=array();
		

		// $arrDataC1Temp = $arrDataC1;
		// $arrDataC2Temp = $arrDataC2;
		// $arrDataC3Temp = $arrDataC3;

		

		$allDataClusterIterasi = $allDataCluster;
		$arrDataC1Iterasi = $arrDataC1;
		$arrDataC2Iterasi = $arrDataC2;
		$arrDataC3Iterasi = $arrDataC3;

		$jumlahIterasi = 1;

		$runIteration=TRUE;
		
		$loading = 0;

			// var_dump($c1d1x);
			// var_dump($c1d2x);
			// var_dump($c1d3x);
			// return false;
			$c1d1x=0;
			$c1d2x=0;
			$c1d3x=0;
			$c2d1x=0;
			$c2d2x=0;
			$c2d3x=0;
			$c3d1x=0;
			$c3d2x=0;
			$c3d3x=0;
		while($runIteration){
			$validationCluster = 0;
			$jumlahIterasi++;
			// var_dump($validationCluster);
			// return false;

			if($allDataClusterTemp != null){
				$allDataClusterIterasi = $allDataClusterTemp;
				$arrDataC1Iterasi = $arrDataC1Temp;
				$arrDataC2Iterasi = $arrDataC2Temp;
				$arrDataC3Iterasi = $arrDataC3Temp;
			}
			if($idC1tmp != null || $idC2tmp != null || $idC3tmp != null){
				$idC1 = $idC1tmp;
				$idC2 = $idC2tmp;
				$idC3 = $idC3tmp;
			}
			// var_dump($arrDataC1Temp);
			foreach($arrDataC1Iterasi as $valC1x){
					$c1d1x = $valC1x['jumlah_penderita'];
					$c1d2x = $valC1x['jumlah_hidup'];
					$c1d3x = $valC1x['jumlah_mati'];
				}
				// var_dump($arrDataC1Iterasi);
				if($arrDataC1Iterasi != null){
				$c1d1x = $c1d1x / count($arrDataC1Iterasi);
				$c1d2x = $c1d2x / count($arrDataC1Iterasi);
				$c1d3x = $c1d3x / count($arrDataC1Iterasi);
				}else{
					$c1d1x = 0;
					$c1d2x = 0;
					$c1d3x = 0;
				}
	
				foreach($arrDataC2Iterasi as $valC2x){
					$c2d1x = $valC2x['jumlah_penderita'];
					$c2d2x = $valC2x['jumlah_hidup'];
					$c2d3x = $valC2x['jumlah_mati'];
				}
				// var_dump($arrDataC2Iterasi);
				if($arrDataC2Iterasi != null){
				$c2d1x = $c2d1x / count($arrDataC2Iterasi);
				$c2d2x = $c2d2x / count($arrDataC2Iterasi);
				$c2d3x = $c2d3x / count($arrDataC2Iterasi);
				}else{
					$c2d1x = 0;
					$c2d2x = 0;
					$c2d3x = 0;
				}

				foreach($arrDataC3Iterasi as $valC3x){
					$c3d1x = $valC3x['jumlah_penderita'];
					$c3d2x = $valC3x['jumlah_hidup'];
					$c3d3x = $valC3x['jumlah_mati'];
				}
				// var_dump($arrDataC3Iterasi);
				if($arrDataC3Iterasi != null){
				$c3d1x = $c3d1x / count($arrDataC3Iterasi);
				$c3d2x = $c3d2x / count($arrDataC3Iterasi);
				$c3d3x = $c3d3x / count($arrDataC3Iterasi);
				}else{
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

					$idC1tmp=array();
					$idC2tmp=array();
					$idC3tmp=array();

					foreach($getAllData as $datas=>$values):
						$d1 = $values->penderita;
						$d2 = $values->hidup;
						$d3 = $values->mati;
						
						$opt1 = pow(($d1-$c1d1x),2);
						$opt1 = $opt1 + pow(($d2-$c1d2x),2);
						$opt1 = $opt1 + pow(($d3-$c1d3x),2);
						$opt1 = sqrt($opt1);

						$opt2 = pow(($d1-$c2d1x),2);
						$opt2 = $opt2 + pow(($d2-$c2d2x),2);
						$opt2 = $opt2 + pow(($d3-$c2d3x),2);
						$opt2 = sqrt($opt2);

						$opt3 = pow(($d1-$c3d1x),2);
						$opt3 = $opt3 + pow(($d2-$c3d2x),2);
						$opt3 = $opt3 + pow(($d3-$c3d3x),2);
						$opt3 = sqrt($opt3);

						$optData = array($opt1,$opt2,$opt3);
						
						if($opt1 == min($optData)){
							array_push($arrDataC1Temp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 1
								)			
							);
							array_push($allDataClusterTemp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 1
								)			
							);
							array_push($idC1tmp,$values->id);
						}else if($opt2 == min($optData)){
							array_push($arrDataC2Temp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 2
								)			
							);
							array_push($allDataClusterTemp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 2
								)			
							);
							array_push($idC2tmp,$values->id);
						}else if($opt3 == min($optData)){
							array_push($arrDataC3Temp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 3
								)			
							);
							array_push($allDataClusterTemp,
								array(
									'id' 				=> $values->id,
									'dtoc1'				=> $opt1,
									'dtoc2'				=> $opt2,
									'dtoc3'				=> $opt3,
									'provinsi'			=> $values->wilayah,
									'jumlah_penderita'	=> $values->penderita,
									'jumlah_hidup'		=> $values->hidup,
									'jumlah_mati'		=> $values->mati,
									'cluster'			=> 3
								)			
							);
							array_push($idC3tmp,$values->id);
						}
					endforeach;
					
					foreach($allDataClusterTemp as $val):
						$postCluster = Clustertmp::create(array(
							'dtoc1' 	=> $val['dtoc1'],
							'dtoc2' 	=> $val['dtoc2'],
							'dtoc3' 	=> $val['dtoc3'],
							'prov'		=> $val['provinsi'],
							'cluster'	=> $val['cluster'],
							'iterasi'	=> $jumlahIterasi
						));
					endforeach;
					
					// var_dump($postCluster);
					

		
		// return false;
			/* check cluster 1 */
			foreach($idC1tmp as $valItC1):
				if(in_array($valItC1,$idC1)){
					// $validationCluster = $validationCluster + 1;
				}else{
					$validationCluster = $validationCluster + 1;
				}
			endforeach;

			// foreach($idC1 as $valItC1):
			// 	if(in_array($valItC1,$idC1tmp)){
			// 		// $validationCluster = $validationCluster + 1;
			// 	}else{
			// 		$validationCluster = $validationCluster + 1;
			// 	}
			// endforeach;
			
		// var_dump('validation cluster 1: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);
		// var_dump($idC1);
		// var_dump($idC1tmp);
		// return false;
			/* end check cluster 1 */
			/* check cluster 2 */
			if($validationCluster != 0){
				foreach($idC2tmp as $valItC2):
					if(in_array($valItC2,$idC2)){
						// $validationCluster = $validationCluster + 1;
					}else{
						$validationCluster = $validationCluster + 1;
					}
				endforeach;
			}
			// var_dump('validation cluster 2: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);
			
			/* end check cluster 2 */
			/* check cluster 3 */
			if($validationCluster != 0){
				foreach($idC3tmp as $valItC3):
					if(in_array($valItC3,$idC3)){
						// $validationCluster = $validationCluster + 1;
					}else{
						$validationCluster = $validationCluster + 1;
					}
				endforeach;
			}
			// var_dump('validation cluster 3: '.$validationCluster.' untuk iterasi '.$jumlahIterasi);
			
			/* end check cluster 3 */

			if($validationCluster == 0){
				$runIteration=FALSE;
			}
			// var_dump($jumlahIterasi);
			// var_dump($jumlahIterasi);
		}

		/* end iterasi lanut */
		// var_dump('jumlah iterasi: '.$jumlahIterasi);
		// return false;


		// return false;
		$data['centroid1'] = $getCentroidC1;
		$data['centroid2'] = $getCentroidC2;
		$data['centroid3'] = $getCentroidC3;

		$data['identIterasi'] = Clustertmp::groupBy('iterasi')->get();
		
		$data['dataCluster'] = $allDataCluster;
		$data['dataClusterIterasi'] = $allDataClusterTemp;
		$this->load->view('index',$data);
	}

	// public function tableIteration($dataTables){
	// 	$table = '
	// 	<table id="iterasi" class="table table-hover" style="width:100%">
    //             <thead>
    //                 <tr>
    //                 <th scope="col" >Data to Centroid 1</th>
    //                 <th scope="col" >Data to Centroid 2</th>
    //                 <th scope="col" >Data to Centroid 3</th>
    //                 <th scope="col" >Provinsi</th>
    //                 <th scope="col" >Cluster 1</th>
    //                 <th scope="col" >Cluster 2</th>
    //                 <th scope="col" >Cluster 3</th>
    //                 </tr>
    //             </thead>
	// 			<tbody>
	// 			'.$dataTables.'
	// 			</tbody>
	// 	</table>
	// 	';
	// }
}
