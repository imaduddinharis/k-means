<div class="tab-pane fade show active" id="home" style="padding-top:20px;" role="tabpanel" aria-labelledby="home-tab">
	<center>
		<h6>Data Pengidap HIV/AIDS</h6>
		<button type="button" id="btn-upload" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			Upload File
		</button>
	</center>
	<div class="row">
		<div class="col-md-6">
			<table id="tablehome" class="table table-hover">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Provinsi</th>
						<th scope="col">Jumlah Pengidap HIV/AIDS</th>
						<th scope="col">Jumlah Hidup</th>
						<th scope="col">Jumlah Mati</th>
					</tr>
				</thead>
				<tbody>
					<?php 
							$no = 1;
							foreach($getAll as $data=>$getAllData):?>
					<tr>
						<th scope="row"><?=$no?></th>
						<td><?=$getAllData->wilayah?></td>
						<td><?=$getAllData->penderita?></td>
						<td><?=$getAllData->hidup?></td>
						<td><?=$getAllData->mati?></td>
					</tr>
					<?php 
							$no++;
							endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<canvas id="grafikakhir"></canvas>
		</div>
	</div>
	
</div>
