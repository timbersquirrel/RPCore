<?php

namespace Narwhal;

use pocketmine\scheduler\PluginTask;
use Narwhal\Main;

class Task extends PluginTask{

public $playername;

	public function __construct(Main $main, string $playername){
		parent::__construct($main);
		$this->playername = $playername;
	}
	
	public function onRun(int $tick){
	$player = $this->getOwner()->getServer()->getPlayer($this->playername());
		if($player instanceof Player){
			$player->addTitle("§cN6a§er§aw§bh§da§5l§fPE", "§7Welcome!", -1, 5*20, 30);
		}
	}
}