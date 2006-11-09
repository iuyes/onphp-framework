<?php
/***************************************************************************
 *   Copyright (C) 2004-2006 by Dmitry E. Demidov                          *
 *   Dmitry.Demidov@noussoft.com                                           *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 ***************************************************************************/

	/**
	 * @ingroup Turing
	**/
	class RandomLinesBackgroundDrawer extends BackgroundDrawer
	{
		private $count = null;
	
		public function __construct($count)
		{
			$this->count = $count;
		}
		
		/**
		 * @return RandomLinesBackgroundDrawer
		**/
		public function draw()
		{
			$imageId = $this->getTuringImage()->getImageId();
			
			$height = $this->getTuringImage()->getHeight();
			$width = $this->getTuringImage()->getWidth();
			
			for ($i = 0; $i < $this->count; $i++) {
				$color = $this->makeColor();	
				$colorId = $this->getTuringImage()->getColorIdentifier($color);
				
				$y = mt_rand(1, $height - 1);
				$x = mt_rand(1, $width - 1);
				
				$angle = mt_rand(0, 180);
				
				while ($angle == 90)
					$angle = mt_rand(0, 180);
				
				$angleRad = deg2rad($angle);
	
				$dy = ($width - $x) * tan($angleRad);
				
				if ($dy < $y) {
					$xEnd = $width;
					$yEnd = $y - $dy;
				} else {
					$yEnd = 0;
					$xEnd = $x + tan($angleRad) / $y;
				}
	
				$dy = $x * tan($angleRad);
				
				if ($dy <= ($height - $y)) {
					$xStart = 0;
					$yStart = $y + $dy;
				} else {
					$yStart = $height;
					$xStart = $x - tan($angleRad) / ($height - $y);
				}
				
				imageline(
					$imageId,
					$xStart,
					$yStart,
					$xEnd,
					$yEnd,
					$colorId
				);
			}
			
			return $this;
		}
	}
?>