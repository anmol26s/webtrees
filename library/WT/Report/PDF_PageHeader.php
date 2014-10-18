<?php
// PDF Report Generator
//
// used by the SAX parser to generate PDF reports from the XML report file.
//
// webtrees: Web based Family History software
// Copyright (C) 2014 webtrees development team.
//
// Derived from PhpGedView
// Copyright (C) 2002 to 2009 PGV Development Team.  All rights reserved.
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA

/**
 * PageHeader element
 */
class WT_Report_PDF_PageHeader extends WT_Report_Base_PageHeader {
	/**
	 * PageHeader element renderer
	 *
	 * @param PDF $pdf
	 *
	 * @return void
	 */
	function render($pdf) {
		$pdf->clearPageHeader();
		foreach ($this->elements as $element) {
			$pdf->addPageHeader($element);
		}
	}
}
