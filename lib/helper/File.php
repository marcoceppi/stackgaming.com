<?php

define('FILE_JSON', 0);
define('FILE_PLAIN', 1);
define('FILE_SERIALIZED', 2);

class File
{
	public static function save($file, $contents, $encoding = FILE_PLAIN)
	{
		
	}
	
	public static function get($file)
	{
		
	}
	
	public static function decode($contents)
	{
		
	}
	
	public static function encode($contents)
	{
		switch($encoding)
		{
			case FILE_JSON:
				
			break;
			case FILE_SERIALIZED:
				
			break;
			case FILE_PLAIN:
			default:
				
			break;
	}
	
	protected static function is_json($raw)
	{
		json_decode($raw);
		return (json_last_error() == JSON_ERROR_NONE);
	}
	
	protected static function is_serialized($raw)
	{
		return is_array(@unserialize($raw));
	}
}
