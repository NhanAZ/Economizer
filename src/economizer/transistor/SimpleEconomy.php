<?php

namespace economizer\transistor;

use NhanAZ\SimpleEconomy\Main as SimpleEconomyPlugin;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use economizer\Transistor;

class SimpleEconomy extends Transistor {

	public function __construct(Plugin $api) {
		parent::__construct($api);
	}

	/**
	 * Get player money
	 * @param Player|string $player
	 * @return int|float
	 */
	public function balance($player) {
		$name = $player instanceof Player ? $player->getName() : $player;
		$plugin = SimpleEconomyPlugin::getInstance();
		if ($plugin === null) return 0;
		return $plugin->getMoney($name) ?? 0;
	}

	/**
	 * Set player money.
	 * @param Player|string $player
	 * @param int|float $money
	 * @param array $params = []
	 */
	public function setMoney($player, $money, array $params = []) {
		$name = $player instanceof Player ? $player->getName() : $player;
		$plugin = SimpleEconomyPlugin::getInstance();
		if ($plugin === null) return false;
		return $plugin->setMoney($name, (int) $money);
	}

	/**
	 * Add money to player current balance.
	 * @param Player|string $player
	 * @param int|float $money
	 * @param array $params = []
	 */
	public function addMoney($player, $money, array $params = []) {
		$name = $player instanceof Player ? $player->getName() : $player;
		$plugin = SimpleEconomyPlugin::getInstance();
		if ($plugin === null) return false;
		return $plugin->addMoney($name, (int) $money);
	}

	/**
	 * Take player money.
	 * @param Player|string $player
	 * @param int|float $money
	 * @param array $params = []
	 */
	public function takeMoney($player, $money, array $params = []) {
		$name = $player instanceof Player ? $player->getName() : $player;
		$plugin = SimpleEconomyPlugin::getInstance();
		if ($plugin === null) return false;
		return $plugin->reduceMoney($name, (int) $money);
	}

	public function ready() : bool {
		$plugin = SimpleEconomyPlugin::getInstance();
		return $plugin !== null && $this->getAPI()->isEnabled();
	}

	public function getMoneyUnit() {
		$plugin = SimpleEconomyPlugin::getInstance();
		if ($plugin === null) return "$";
		return $plugin->getFormatter()->getSymbol();
	}
}
