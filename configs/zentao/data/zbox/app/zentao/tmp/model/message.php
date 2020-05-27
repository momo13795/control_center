<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module/message/model.php');
helper::cd();
class extmessageModel extends messageModel 
{

    public function send($objectType, $objectID, $actionType, $actionID, $actor = '')
    {
$this->loadExtension('xuanxuan')->send($objectType, $objectID, $actionType, $actionID, $actor);
        $messageSetting = $this->config->message->setting;
        if(is_string($messageSetting)) $messageSetting = json_decode($messageSetting, true);

        if(isset($messageSetting['mail']))
        {
            $actions = $messageSetting['mail']['setting'];
            if(isset($actions[$objectType]) and in_array($actionType, $actions[$objectType]))
            {
                $moduleName = $objectType == 'case' ? 'testcase' : $objectType;
                $this->loadModel($moduleName);
                if(method_exists($this->$moduleName, 'sendmail')) $this->$moduleName->sendmail($objectID, $actionID);
            }
        }

        if(isset($messageSetting['webhook']))
        {
            $actions = $messageSetting['webhook']['setting'];
            if(isset($actions[$objectType]) and in_array($actionType, $actions[$objectType]))
            {
                $this->loadModel('webhook')->send($objectType, $objectID, $actionType, $actionID, $actor);
            }
        }

        if(isset($messageSetting['message']))
        {
            $actions = $messageSetting['message']['setting'];
            if(isset($actions[$objectType]) and in_array($actionType, $actions[$objectType]))
            {
                $this->saveNotice($objectType, $objectID, $actionType, $actionID, $actor);
            }
        }
    }

//**//
}