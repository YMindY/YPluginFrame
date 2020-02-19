<?php
namespace yxmingy\serverinforobot;
class Sagiri
{
    private $Sagurl;
    
    public function __construct($url){
        $this->Sagurl = $url;
    }
    
    private function requestSagiri(string $request,array $params = []){
        $param = empty($params) ? "" : http_build_query($params);
        return trim(file_get_contents($this->Sagurl.$request.'?'.$param));
    }
    
    public function sendPrivateMessage($qq_num,$message)
    {
        $this->requestSagiri('send_private_msg',array('user_id'=>$qq_num,'message'=>$message));
    }
    
    public function sendGroupMessage($qq_group_num,$message)
    {
        $this->requestSagiri('send_group_msg',array('group_id'=>$qq_group_num,'message'=>$message));
    }
    
    /* return:
     * array(
     * ['group_id'=>int/(string),'group_name'=>string],
     * ['group_id'=> ...],
     * ...)
    */
    public function getGroupList():array{
        return json_decode($this->requestSagiri('get_group_list'),true)["data"];
    }
    
    //Warning: This function just can just be used rarely!!!Otherwise your QQ will be banned!!!
    public function batchGroupMessage($message){
        foreach($this->getGroupList() as $group_list){
        $this->sendGroupMessage($group_list['group_id'],$message);
        }
    }
}