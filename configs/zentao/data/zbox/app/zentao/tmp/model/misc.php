<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module/misc/model.php');
helper::cd();
class extmiscModel extends miscModel 
{
public function hello2()
{
echo 'start from hello2.start.php<br>';
    echo $this->loadExtension('test')->hello();    // Load testMisc class from test.class.php in ext/model/class.
    return $this->testMisc->hello();               // After loading, can use $this->testMisc to call it.
}public function foo()
{
    return 'foo';
}public function getRemind()
{
    $remind = parent::getRemind();

    $this->app->loadLang('im');
    $account     = str_replace('.', '_', $this->app->user->account);
    $xxInstalled = $account . 'installed';
    $module      = $this->app->getModuleName();

    if(isset($this->config->xxserver->installed) and $this->config->xuanxuan->turnon and !isset($this->config->xxclient->$xxInstalled) and $this->config->global->flow == 'full')
    {
        $remind .= '<h4>' . $this->lang->im->zentaoClient . '</h4>';
        $remind .= '<p>' . $this->lang->im->xxClientConfirm . '</p>';
        $this->loadModel('setting')->setItem("system.common.xxclient.{$account}installed", 1);
    }
    elseif(!isset($this->config->xxserver->noticed) and $this->app->user->admin and $this->config->global->flow == 'full' and $this->config->$module->block->initVersion >= '2')
    {
        $remind .= '<h4>' . $this->lang->im->zentaoClient . '</h4>';
        $remind .= '<p>' . $this->lang->im->xxServerConfirm . '</p>';
        $this->loadModel('setting')->setItem("system.common.xxserver.noticed", 1);
    }

    return $remind;
}
    public function hello()
    {
echo "start from hello.test.php <br>";
echo 'start from hellp.test2.php<br>';
        return 'hello world from hello()<br />';
    }

//**//
}