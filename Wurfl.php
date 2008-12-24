<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Wurfl {
	
	var $wurflManager;
	var $device;
	var $id;
	var $fallBack;
	
	function Wurfl(){
		$providerPath = 'libraries/WURFL/WURFLManagerProvider.php';
		if (is_file(APPPATH . $providerPath)){
			require_once(APPPATH . $providerPath);
		} else if (is_file(BASEPATH . $providerPath)){
			require_once(BASEPATH . $providerPath);
		} else {
			return false;
		}
		
		$this->wurflManager = WURFL_WURFLManagerProvider::getWURFLManager(APPPATH . 'config/wurfl-config.xml');
	}
	
	function load($device = ""){
		if (is_array($device)){
			$this->device = $this->wurflManager->getDeviceForHttpRequest($device);
		} else {
			$this->device = $this->wurflManager->getDeviceForUserAgent($device);
		}
		
		if (!empty($this->device)){
			$this->id = $this->device->id;
			$this->fallBack = $this->device->fallBack;
		} else {
			return false;
		}
	}
	
	function getDevice(){
		return $this->device;
	}
	
	function getCapability($capabilityName = ""){
		return $this->device->getCapability($capabilityName);
	}
	
	function getAllCapabilities(){
		return $this->device->getAllCapabilities();
	}
	
	function getId(){
		return $this->id;
	}
	
	function getFallback(){
		return $this->fallback;
	}
	
}