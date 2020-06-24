<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\DataSources;

use App;

class DataSourceRepository{
    
    
    public function get($name){
        return $this->$name();
    }
    

    public function device(){
        return APP::make('App\Services\DataSources\DeviceDataSource');
    }


}
