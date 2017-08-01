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

use pocketmine\command\CommandSender;
use pocketmine\level\Position;

class ClaimAll extends ClaimX
{

    public function perform(CommandSender $sender, string $label, array $args) :bool
    {
        $this->sender = $sender;

        // Args
        $newFaction = $this->getArgument($this->getFactionArgIndex());
        Plots::claimAll($newFaction, $sender->getLevel());
        return ["", [
            "world" => $sender->getLevel(),
            ""
        ]];
    }

    public function getPlots(Position $position) : array
    {

    }
}
