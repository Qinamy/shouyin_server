<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\DataSources;

interface DataSourceInterface{
    
    /**
     * 搜索
     * @param array $filter
     */
    public function index($filter,$pageSize);
    
    /**
     * 创建
     * @param type $params
     */
    public function create($params);
    
    /**
     * 保存
     * @param Model $model
     */
    public function store($model);
    
    /**
     * 查询
     * @param Integer $id
     */
    public function show($id);
    
    /**
     * 编辑
     * @param Integer $id
     * @param array $params
     */
    public function edit($id,$params);
    
    /**
     * 更新
     * @param Integer $id
     * @param array $params
     */
    public function update($model);
    
    /**
     * 删除缓存
     * @param Model $model
     */
    public function destroy($model);
    
}