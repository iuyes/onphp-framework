<?php
/***************************************************************************
 *   Copyright (C) 2005 by Konstantin V. Arkhipov                          *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	/**
	 * @ingroup Cache
	**/
	abstract class SelectivePeer extends CachePeer
	{
		const MARGINAL_VALUE = 'i_am_declassed_element'; // Yanka R.I.P.
		
		protected $className	= null;
		
		public function mark($className)
		{
			$this->className = $className;
			return $this;
		}
		
		protected function getClassName()
		{
			if (!$this->className)
				$class = self::MARGINAL_VALUE;
			else 
				$class = $this->className;
				
			$this->className = null; // eat it after use

			return $class;
		}
	}
?>