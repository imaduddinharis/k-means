<!DOCTYPE html>
<html>
    <head>
        <title>K-Meas Program</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css">

        <style>
            .nav-item a{
                color:#dedede !important;
            }
            .nav-item a.active{
                color:#333 !important;
            }
            .nav-item{
                margin-bottom:0 !important;
            }
        </style>
    </head>
    <body>
        <div class="container">

        <?php require_once('component/nav.php');?>
            <div class="tab-content" id="myTabContent">
            <?php require_once('component/home.php');?>
            <div class="tab-pane fade" id="iterasi1" style="padding-top:20px;" role="tabpanel" aria-labelledby="profile-tab">

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                    <div class="card-header">
                        Centroid
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cluster 1 : <?=$centroid1[0]['penderita']?> , <?=$centroid1[0]['hidup']?> , <?=$centroid1[0]['mati']?></li>
                        <li class="list-group-item">Cluster 2 : <?=$centroid2[0]['penderita']?> , <?=$centroid2[0]['hidup']?> , <?=$centroid2[0]['mati']?></li>
                        <li class="list-group-item">Cluster 3 : <?=$centroid3[0]['penderita']?> , <?=$centroid3[0]['hidup']?> , <?=$centroid3[0]['mati']?></li>
                    </ul>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                    <div class="card-header">
                        Data Cluster
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cluster 1 : <?php foreach($dataCluster as $datas){if($datas['cluster']==1)echo $datas['provinsi'].', ';}?>.</li>
                        <li class="list-group-item">Cluster 2 : <?php foreach($dataCluster as $datas){if($datas['cluster']==2)echo $datas['provinsi'].', ';}?>.</li>
                        <li class="list-group-item">Cluster 3 : <?php foreach($dataCluster as $datas){if($datas['cluster']==3)echo $datas['provinsi'].', ';}?>.</li>
                    </ul>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col" >Data to Centroid 1</th>
                    <th scope="col" >Data to Centroid 2</th>
                    <th scope="col" >Data to Centroid 3</th>
                    <th scope="col" >Provinsi</th>
                    <th scope="col" >Penderita</th>
                    <th scope="col" >Hidup</th>
                    <th scope="col" >Mati</th>
                    <th scope="col" >Cluster 1</th>
                    <th scope="col" >Cluster 2</th>
                    <th scope="col" >Cluster 3</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach($dataCluster as $data): ?>

                    <tr>
                    <td><?=$data['dtoc1']?></td>
                    <td><?=$data['dtoc2']?></td>
                    <td><?=$data['dtoc3']?></td>
                    <td><?=$data['provinsi']?></td>
                    <td><?=$data['jumlah_penderita']?></td>
                    <td><?=$data['jumlah_hidup']?></td>
                    <td><?=$data['jumlah_mati']?></td>
                    
                    <?php
                        if($data['cluster']==1){
                    ?>
                            <td class="bg-danger"></td>
                            <td></td>
                            <td></td>
                    <?php
                        }else if($data['cluster']==2){
                    ?>
                            <td></td>
                            <td class="bg-danger"></td>
                            <td></td>
                    <?php
                        }else if($data['cluster']==3){
                    ?>
                            <td></td>
                            <td></td>
                            <td class="bg-danger"></td>                            
                    <?php
                        }
                    ?>
                    
                    </tr>

                    <?php endforeach;?>
                
                </tbody>
                </table>
            </div>

            <?php foreach($identIterasi as $valIdentIt=>$val1): 
                $iterasiLanjut = Clustertmp::where('iterasi',$val1->iterasi)->get();
                foreach($iterasiLanjut as $keys=>$datas){}?>
            <div class="tab-pane fade" id="iterasi<?=$val1->iterasi?>" style="padding-top:20px;" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                    <div class="card-header">
                        Centroid
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cluster 1 : <?=$datas->c1;?></li>
                        <li class="list-group-item">Cluster 2 : <?=$datas->c2?></li>
                        <li class="list-group-item">Cluster 3 : <?=$datas->c3?></li>
                    </ul>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                    <div class="card-header">
                        Data Cluster
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cluster 1 : <?php foreach($iterasiLanjut as $keysIt=>$datasIt){if($datasIt->cluster==1)echo $datasIt->prov.', ';}?>.</li>
                        <li class="list-group-item">Cluster 2 : <?php foreach($iterasiLanjut as $keysIt=>$datasIt){if($datasIt->cluster==2)echo $datasIt->prov.', ';}?>.</li>
                        <li class="list-group-item">Cluster 3 : <?php foreach($iterasiLanjut as $keysIt=>$datasIt){if($datasIt->cluster==3)echo $datasIt->prov.', ';}?>.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <br>
            <table id="iterasi<?=$val1->iterasi?>" style="min-width:100%;"class="table table-responsive display center" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col" >Data to Centroid 1</th>
                    <th scope="col" >Data to Centroid 2</th>
                    <th scope="col" >Data to Centroid 3</th>
                    <th scope="col" >Provinsi</th>
                    <th scope="col" >Cluster 1</th>
                    <th scope="col" >Cluster 2</th>
                    <th scope="col" >Cluster 3</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                    foreach($iterasiLanjut as $valIt=>$val2):
                    ?>

                    <tr>
                    <td><?=$val2->dtoc1?></td>
                    <td><?=$val2->dtoc2?></td>
                    <td><?=$val2->dtoc3?></td>
                    <td><?=$val2->prov?></td>
                    
                    <?php
                        if($val2->cluster==1){
                    ?>
                            <td class="bg-danger"></td>
                            <td></td>
                            <td></td>
                    <?php
                        }else if($val2->cluster==2){
                    ?>
                            <td></td>
                            <td class="bg-danger"></td>
                            <td></td>
                    <?php
                        }else if($val2->cluster==3){
                    ?>
                            <td></td>
                            <td></td>
                            <td class="bg-danger"></td>                            
                    <?php
                        }
                    ?>
                    
                    </tr>

                    <?php 
                    endforeach;
                    ?>
                
                </tbody>
                </table>
            </div>
            <?php endforeach; ?>
            </div>
            </div>


<?php require_once('component/modal.php');?>
            
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/Chart.bundle.js"></script>
        <script src="<?=base_url()?>assets/Chart.bundle.min.js"></script>
        <script src="<?=base_url()?>assets/Chart.js"></script>
        <script src="<?=base_url()?>assets/Chart.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('#iterasi').DataTable();
                $('#tablehome').DataTable();
                $('table.display').DataTable();

            } );
            $(document).ready (function () {
                jQuery.each ($("[onload]"), function (index, item) {
                    $(item).prop ("onload").call (item);
                    return false;
                });
            });
        </script>
        <script>
            //cart
            var ctx = document.getElementById('grafikakhir').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?=$label?>],
                    datasets: [{
                        label: 'Jumlah Pengidap HIV',
                        data: [<?=$dataset?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0)',
                            'rgba(255, 99, 132, 0)',
                            'rgba(255, 99, 132, 0)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </body>
</html>