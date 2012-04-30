<?php

class MinecraftException extends Exception
{
	// Exception thrown by Minecraft classes
}

class Minecraft
{
	public static function query( $host, $port = 25565, $timeout = 3 )
	{
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		
		socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => $timeout, 'usec' => 0));
		
		if( $socket === false || @socket_connect($socket, $host, (int)$port) === false )
		{
			return false;
		}
		
		socket_send($socket, "\xFE", 1, 0);
		$len = socket_recv($socket, $data, 256, 0);
		socket_close($socket);
		
		if( $len < 4 || $data[ 0 ] != "\xFF" )
		{
			return false;
		}
		
		$data = substr($data, 3);
		$data = iconv('UTF-16BE', 'UTF-8', $data);
		$data = explode("\xA7", $data);
		
		return array
		(
			'hostname'   => substr($data[0], 0, -1),
			'total_players'    => isset($data[1]) ? intval($data[1]) : 0,
			'max_players' => isset($data[2]) ? intval($data[2]) : 0
		);
	}
}
