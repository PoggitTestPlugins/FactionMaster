<?php

declare(strict_types=1);

namespace ShockedPlot7560\FactionMaster\libs\muqsit\simplepackethandler\monitor;

use Closure;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;

interface IPacketMonitor {
	/**
	 * @phpstan-template TServerboundPacket of ServerboundPacket
	 * @phpstan-param Closure(TServerboundPacket, NetworkSession) : void $handler
	 */
	public function monitorIncoming(Closure $handler) : IPacketMonitor;

	/**
	 * @phpstan-template TClientboundPacket of ClientboundPacket
	 * @phpstan-param Closure(TClientboundPacket, NetworkSession) : void $handler
	 */
	public function monitorOutgoing(Closure $handler) : IPacketMonitor;
}