<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2018  
 * Francesc Pineda Segarra <francesc.pineda.segarra@gmail.com>
 * Cristo Manuel Estévez Hernández <cristom.estevez@gmail.com>
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
namespace FacturaScripts\Plugins\CoreUI_template\Lib;

/**
 * Structure for each of the items in the FacturaScripts menu.
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 */
class MenuItem extends \FacturaScripts\Core\Lib\MenuItem
{

    /**
     * Returns the HTML for the icon of the item.
     *
     * @return string
     */
    private function getHTMLIcon()
    {
        return empty($this->icon) ? '<i class="fa fa-fw" aria-hidden="true"></i> ' : '<i class="fa ' . $this->icon
            . ' fa-fw" aria-hidden="true"></i> ';
    }

    /**
     * Returns the indintifier of the menu.
     *
     * @param string $parent
     *
     * @return string
     */
    private function getMenuId($parent)
    {
        return empty($parent) ? 'menu-' . $this->title : $parent . $this->name;
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
        $menuId = $this->getMenuId($parent);

        $html = empty($parent) ? '<li class="nav-item nav-dropdown">'
            . '<a class="nav-link nav-dropdown-toggle" href="#" id="' . $menuId . '">'
            . $this->getHTMLIcon() . \ucfirst($this->title) . '</a>'
            . '<ul class="nav-dropdown-items">' : '<li class="dropdown-submenu">'
            . '<a class="dropdown-item' . $active . '" href="#" id="' . $menuId . '">'
            . '<i class="fa fa-folder-open fa-fw"'
            . ' aria-hidden="true"></i> &nbsp; ' . \ucfirst($this->title) . '</a>'
            . '<ul class="dropdown-menu" aria-labelledby="' . $menuId . '">';

        foreach ($this->menu as $menuItem) {

            if ($menuItem->name === "control-panel") {
                $html .= $this->writeHtml($menuItem->menu["AdminPlugins"]);
                $html .= $this->writeHtml( $menuItem->menu["Updater"]);
            } else {
                $html .= empty($menuItem->menu) ? $this->writeHtml( $menuItem) : $menuItem->getHTML($menuId);
            }
        }

        $html .= '</ul>';
        return $html;
    }

    /**
     * Write the content of the object into html
     * 
     * @param String $destination
     * @param MenuItem $menuItem
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
