<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2017-2018  Carlos Garcia Gomez  <carlos@facturascripts.com>
 *          
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Plugins\CoreuiTemplate\Lib;

/**
 * Structure for each of the items in the FacturaScripts menu.
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 * 
 */

 /**
  * Modification for this theme
  * @author Cristo M. Estévez Hernández <cristom.estevez@gmail.com>
  * @author Francesc Pineda Segarra <francesc.pineda.segarra@gmail.com>
  */
class MenuItem extends \FacturaScripts\Core\Lib\MenuItem
{
    /**
     * @Override
     * Returns the HTML for the icon of the item.
     *
     * @return string
     */
    protected function getHTMLIcon()
    {
        return empty($this->icon) ? '<i class="nav-icon fa fa-fw" aria-hidden="true"></i> ' : '<i class="nav-icon fa ' . $this->icon
            . ' fa-fw" aria-hidden="true"></i> ';
    }

    /**
     * Returns the html for the menu / submenu.
     *
     * @param string $parent
     *
     * @return string
     */
    public function getHTML($parent = '')
    {
        $active = $this->active ? ' active' : '';
        $liActive = $this->active ? ' active open' : '';
        $folder = $this->active ? 'fa-folder-open' : 'fa-folder';
        $menuId = $this->getMenuId($parent);
        
        $html = empty($parent) ? '<li class="nav-item nav-dropdown' . $liActive .'">'
            . '<a class="nav-link nav-dropdown-toggle" href="#" id="' . $menuId . '">'
            . '<i class="nav-icon fa ' . $folder . ' fa-fw" aria-hidden="true"></i> &nbsp; '
            . '' . \ucfirst($this->title) . '</a>'
            . '<ul class="nav-dropdown-items">' : '<li class="nav-item nav-dropdown' . $liActive .'">'
            . '<a class="nav-link nav-dropdown-toggle' . $active . '" href="#" id="' . $menuId . '">'
            . '<i class="nav-icon fa fa-folder-open fa-fw"'
            . ' aria-hidden="true"></i> &nbsp; ' . \ucfirst($this->title) . '</a>'
            . '<ul class="nav-dropdown-items" aria-labelledby="' . $menuId . '">';

        foreach ($this->menu as $menuItem) {
            $html .= empty($menuItem->menu) ? $this->writeHtml($menuItem) : $menuItem->getHTML($menuId);
        }

        $html .= '</ul>';
        return $html;
    }

    /**
     * Write the content of the object into html
     *
     * @param \FacturaScripts\Core\Lib\MenuItem $menuItem
     *
     * @return string
     */
    private function writeHtml($menuItem)
    {
        return '<li class="nav-item">'
            . '<a class="nav-link" href="' . $menuItem->url . '">'
            . $menuItem->getHTMLIcon() . \ucfirst($menuItem->title) . '</a>'
            . '</li>';
    }
}
