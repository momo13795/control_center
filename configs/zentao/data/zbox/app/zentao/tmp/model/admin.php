<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module/admin/model.php');
helper::cd();
class extadminModel extends adminModel 
{
public function blockStatus($block = null)
{   
    return $this->loadExtension('xuanxuan')->blockStatus($block);
}   

public function blockStatistics($block = null)
{
    return $this->loadExtension('xuanxuan')->blockStatistics($block);
}
//**//
}