<?php

namespace Bundle\GoogleBundle\Maps;

interface MapInterface {

	public function setId($id);
	public function getId();
	public function hasMarkers();
	public function hasMarker(Marker $marker);
	public function setMarkers($markers);
	public function getMarkers();
	public function addMarker(Marker $marker);
	public function removeMaker(Marker $marker);
	public function hasMeta();
	public function setMeta($meta);
	public function getMeta();

}
