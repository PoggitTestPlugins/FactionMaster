<?php

declare(strict_types=1);

namespace ShockedPlot7560\FactionMaster\libs\muqsit\simplepackethandler\interceptor;

use Closure;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;

interface IPacketInterceptor {
	/**
	 * @phpstan-template TServerboundPacket of ServerboundPacket
	 * @phpstan-param Closure(TServerboundPacket, NetworkSession) : bool $handler
	 */
	public function interceptIncoming(Closure $handler) : IPacketInterceptor;

	/**
	 * @phpstan-template TClientboundPacket of ClientboundPacket
	 * @phpstan-param Closure(TClientboundPacket, NetworkSession) : bool $handler
	 */
	public function interceptOutgoing(Closure $handler) : IPacketInterceptor;
}