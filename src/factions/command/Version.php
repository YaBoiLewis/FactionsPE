<?php
/*
 *   FactionsPE: PocketMine-MP Plugin
 *   Copyright (C) 2016  Chris Prime
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace factions\command;

use dominate\Command;
use pocketmine\command\CommandSender;
use localizer\Localizer;
use factions\utils\Text;

class Version extends Command {

	public function perform(CommandSender $sender, string $label, array $args) :bool {
		$sender->sendMessage(Text::titleize(Localizer::translatable("version-info-header")));
		$sender->sendMessage(Localizer::translatable("version", [
			"version" => $this->getPlugin()->getDescription()->getVersion(),
			]));
		$sender->sendMessage(Localizer::translatable("author", [
			"author" => "Chris-Prime (@PrimusLV), Sandertv {@Sandertv}"
			]));
		$sender->sendMessage(Localizer::translatable("organization", [
			"organization" => "BlockHorizons (https://github.com/BlockHorizons/FactionsPE)"
			]));
		return true;
	}

}
