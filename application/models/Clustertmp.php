<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Clustertmp extends Eloquent {

    protected $table = "tb_cluster"; // table name
    protected $fillable = ['dtoc1', 
                            'dtoc2', 
                            'dtoc3',
                            'prov',
                            'cluster',
                            'c1',
                            'c2',
                            'c3',
                            'iterasi'];
    public $timestamps = false;
}