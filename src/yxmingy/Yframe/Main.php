<?php
/*
  Date: 2018.12.12
  Author: xMing
  Editor: Quoda
  Poem:
    手持两把锟斤拷，口中疾呼烫烫烫。
    脚踏千朵屯屯屯，笑看万物锘锘锘。
  Mantra: 高内聚，低耦合。
*/
namespace yxmingy\Yframe;
class Main extends starter\Starter
{
  public function onLoad()
  {
    self::assignInstance();
    self::dispenseExecutors();
    self::info("[Yframe] is Loading...");
  }
  public function onEnable()
  {
    self::registerListeners();
    self::notice("[Yframe] is Enabled by xMing!");
  }
  public function onDisable()
  {
    self::warning("[Yframe] is Turned Off.");
  }
}