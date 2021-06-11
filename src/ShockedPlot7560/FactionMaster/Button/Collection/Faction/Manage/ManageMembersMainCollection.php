<?php

/*
 *
 *      ______           __  _                __  ___           __
 *     / ____/___ ______/ /_(_)___  ____     /  |/  /___ ______/ /____  _____
 *    / /_  / __ `/ ___/ __/ / __ \/ __ \   / /|_/ / __ `/ ___/ __/ _ \/ ___/
 *   / __/ / /_/ / /__/ /_/ / /_/ / / / /  / /  / / /_/ (__  ) /_/  __/ /  
 *  /_/    \__,_/\___/\__/_/\____/_/ /_/  /_/  /_/\__,_/____/\__/\___/_/ 
 *
 * FactionMaster - A Faction plugin for PocketMine-MP
 * This file is part of FactionMaster
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @author ShockedPlot7560 
 * @link https://github.com/ShockedPlot7560
 * 
 *
*/

namespace ShockedPlot7560\FactionMaster\Button\Collection\Faction\Manage;

use pocketmine\Player;
use ShockedPlot7560\FactionMaster\Button\ButtonCollection;
use ShockedPlot7560\FactionMaster\Button\Buttons\Back;
use ShockedPlot7560\FactionMaster\Button\Buttons\Faction\ManageMembersMain;
use ShockedPlot7560\FactionMaster\Button\Buttons\InvitationPending;
use ShockedPlot7560\FactionMaster\Button\Buttons\RequestPending;
use ShockedPlot7560\FactionMaster\Button\Buttons\SendInvitation;
use ShockedPlot7560\FactionMaster\Database\Entity\UserEntity;
use ShockedPlot7560\FactionMaster\Permission\PermissionIds;
use ShockedPlot7560\FactionMaster\Route\Faction\Members\Invitations\MemberDemandList;
use ShockedPlot7560\FactionMaster\Route\Faction\Members\Invitations\MemberInvitationList;
use ShockedPlot7560\FactionMaster\Route\Faction\Members\Invitations\NewMemberInvitation;
use ShockedPlot7560\FactionMaster\Route\MainPanel;

class ManageMembersMainCollection extends ButtonCollection {

    const SLUG = "manageMembersMain";

    public function __construct()
    {
        parent::__construct(self::SLUG);
        $this->registerCallable(self::SLUG, function() {
            $this->register(new SendInvitation(NewMemberInvitation::SLUG, [PermissionIds::PERMISSION_SEND_MEMBER_INVITATION]));
            $this->register(new InvitationPending(MemberInvitationList::SLUG, [PermissionIds::PERMISSION_DELETE_PENDING_MEMBER_INVITATION]));
            $this->register(new RequestPending(MemberDemandList::SLUG, [PermissionIds::PERMISSION_ACCEPT_MEMBER_DEMAND, PermissionIds::PERMISSION_REFUSE_MEMBER_DEMAND]));
            $this->register(new ManageMembersMain());
            $this->register(new Back(MainPanel::SLUG));
        });
    }

    public function init(Player $Player, UserEntity $User) : self {
        $this->ButtonsList = [];
        foreach ($this->processFunction as $Callable) {
            call_user_func($Callable, $Player, $User);
        }
        return $this;
    }
}