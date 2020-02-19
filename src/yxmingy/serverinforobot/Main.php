<?php

namespace yxmingy\serverinforobot;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener
{
  use starter\Starter;
  private $conf;
  private $bot;
  const PLUGIN_NAME = "YServerInfoRobot";
  public function onLoad()
  {
    self::info("[".self::PLUGIN_NAME."] is Loading...");
  }
  public function onEnable()
  {
    $this->conf = new Config($this->getDataFolder()."/Config.yml",Config::YAML,array(
      "群号"=>"187984713",
      "服务器名"=>"[FtCraft]",
      "玩家进服消息"=>"[服务器名]：玩家[玩家名]进入了服务器！当前在线人数:[在线人数]",
      "机器人服务器"=>"203.195.163.33"
    ));
    $this->bot = new Sagiri("http://".$this->conf->get("机器人服务器").":5700/");
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
    self::notice("[".self::PLUGIN_NAME."] is Enabled by xMing!");
  }
  public function onPlayerJoin(PlayerJoinEvent $event) {
    $count = count($this->getServer()->getOnlinePlayers());
    $msgString = $this->conf->get("玩家进服消息");
    $msgString = str_replace(
      ["[服务器名]","[玩家名]","[在线人数]"],
      [$this->conf->get("服务器名"),$event->getPlayer()->getName(),$count],
      $msgString);
    $this->bot->sendGroupMessage($this->conf->get("群号"),$msgString);
  }
  public function onDisable()
  {
    self::warning("[".self::PLUGIN_NAME."] is Turned Off.");
  }
}