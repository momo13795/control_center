<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module/common/model.php');
helper::cd();
class extcommonModel extends commonModel 
{

    public function isOpenMethod($module, $method)
    {
if($module == 'entry'  and $method == 'visit') return true;
        if($module == 'user' and strpos('login|logout|deny|reset', $method) !== false) return true;
        if($module == 'api'  and $method == 'getsessionid') return true;
        if($module == 'misc' and $method == 'checktable') return true;
        if($module == 'misc' and $method == 'qrcode') return true;
        if($module == 'misc' and $method == 'about') return true;
        if($module == 'misc' and $method == 'checkupdate') return true;
        if($module == 'misc' and $method == 'ping')  return true;
        if($module == 'sso' and $method == 'login')  return true;
        if($module == 'sso' and $method == 'logout') return true;
        if($module == 'sso' and $method == 'bind') return true;
        if($module == 'sso' and $method == 'gettodolist') return true;
        if($module == 'block' and $method == 'main' and isset($_GET['hash'])) return true;
        if($module == 'file' and $method == 'read') return true;

        if($this->loadModel('user')->isLogon() or ($this->app->company->guest and $this->app->user->account == 'guest'))
        {
            if(stripos($method, 'ajax') !== false) return true;
            if($module == 'misc' and $method == 'downloadclient') return true;
            if($module == 'block' and $method == 'main') return true;
            if($module == 'misc' and $method == 'changelog') return true;
            if($module == 'tutorial') return true;
            if($module == 'block') return true;
            if($module == 'product' and $method == 'showerrornone') return true;
            if($module == 'report' and $method == 'annualdata') return true;
        }
        return false;
    }

    public function loadConfigFromDB()
    {
$this->loadModel('setting');
$xxItems  = $this->setting->getItems('owner=system&module=common&section=xuanxuan');
$xxConfig = array();
foreach($xxItems as $xxItem) $xxConfig[$xxItem->key] = $xxItem->value;
if(empty($xxConfig['key']))
{
    $this->setting->setItem('system.common.xuanxuan.turnon', 1);
    $this->setting->setItem('system.common.xuanxuan.key', $this->setting->computeSN());
}
if(!isset($xxConfig['chatPort']))       $this->setting->setItem('system.common.xuanxuan.chatPort', 11444);
if(!isset($xxConfig['commonPort']))     $this->setting->setItem('system.common.xuanxuan.commonPort', 11443);
if(!isset($xxConfig['ip']))             $this->setting->setItem('system.common.xuanxuan.ip', '0.0.0.0');
if(!isset($xxConfig['uploadFileSize'])) $this->setting->setItem('system.common.xuanxuan.uploadFileSize', 20);
if(!isset($xxConfig['https']) and !isset($xxConfig['isHttps'])) $this->setting->setItem('system.common.xuanxuan.https', 'off');
        /* Get configs of system and current user. */
        $account = isset($this->app->user->account) ? $this->app->user->account : '';
        if($this->config->db->name) $config  = $this->loadModel('setting')->getSysAndPersonalConfig($account);
        $this->config->system   = isset($config['system']) ? $config['system'] : array();
        $this->config->personal = isset($config[$account]) ? $config[$account] : array();

        /* Overide the items defined in config/config.php and config/my.php. */
        if(isset($this->config->system->common)) $this->app->mergeConfig($this->config->system->common, 'common');
        if(isset($this->config->personal->common)) $this->app->mergeConfig($this->config->personal->common, 'common');
    }

//**//
}