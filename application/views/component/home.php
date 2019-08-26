<div class="tab-pane fade show active" id="home" style="padding-top:20px;" role="tabpanel" aria-labelledby="home-tab">
	<center>
		<h6>Data Pengidap HIV/AIDS</h6>
		<button type="button" id="btn-upload" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			Upload File
		</button>
	</center><br><br>
	<div class="row">
		<div class="col-md-12">
			<table id="tablehome" class="table table-responsive">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Wilayah</th>
						<th scope="col">Luas Wilayah</th>
						<th scope="col">Penduduk</th>
						<th scope="col">Kelurahan</th>
						<th scope="col">Pengidap HIV/AIDS</th>
						<th scope="col">Hidup</th>
						<th scope="col">Mati</th>
						<th scope="col">Layanan Kesehatan</th>
						<th scope="col">Penyebaran</th>
						<th scope="col">Hidup</th>
						<th scope="col">Mati</th>
					</tr>
				</thead>
				<tbody>
					<?php 
							$no = 1;
							foreach($getAll as $data=>$getAllData):
							$penyebaran = 0;
							$hidup = 0;
							$mati = 0;
							if($getAllData->penderita != 0){
							$penyebaran = ((($getAllData->penderita / $getAllData->jumlah_penduduk)+($getAllData->jumlah_layanan_kesehatan / $getAllData->jumlah_kelurahan)) / $getAllData->luas_wilayah)*100;
							$hidup = ((($getAllData->hidup / $getAllData->penderita)+($getAllData->jumlah_layanan_kesehatan / $getAllData->jumlah_kelurahan)) / $getAllData->luas_wilayah)*100;
							$mati = ((($getAllData->mati / $getAllData->penderita)+($getAllData->jumlah_layanan_kesehatan / $getAllData->jumlah_kelurahan)) / $getAllData->luas_wilayah)*100;
							}
							?>
					<tr>
						<th scope="row"><?=$no?></th>
						<td><?=$getAllData->wilayah?></td>
						<td><?=number_format($getAllData->luas_wilayah,0)?> km2</td>
						<td><?=number_format($getAllData->jumlah_penduduk,0)?> orang</td>
						<td><?=$getAllData->jumlah_kelurahan?></td>
						<td><?=$getAllData->penderita?></td>
						<td><?=$getAllData->hidup?></td>
						<td><?=$getAllData->mati?></td>
						<td><?=$getAllData->jumlah_layanan_kesehatan?></td>
						<td><?=number_format($penyebaran,3)?>%</td>
						<td><?=number_format($hidup,3)?>%</td>
						<td><?=number_format($mati,3)?>%</td>
						
					</tr>
					<?php 
							$no++;
							endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
