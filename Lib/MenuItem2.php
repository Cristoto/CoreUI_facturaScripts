<?php

namespace FacturaScripts\Plugins\CoreUI_template\Lib;

/**
 * Structure for each of the items in the FacturaScripts menu.
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 * @author Cristo Manuel Estévez Hernández <cristom.estevez@gmail.com>
 */
class MenuItem extends \FacturaScripts\Core\Lib\MenuItem
{
    /**
     * Returns the html for the menu / submenu.
     *
     * @param string $parent
     *
     * @return string
     */
    public function getHTML($parent = ''){
        $active = $this->active ? ' active open' : '';
        $liActive = $this->active ? 'class="active open"' : '';
        $folder = $this->active ? 'fa-folder-open' : 'fa-folder';
        $classToggled = $this->active ? 'toggled' : '';
        $menuId = $this->getMenuId($parent);

        $html = empty($parent) ? '<li class="nav-item">'
        . '<a href="javascript:void(0);" class="nav-link">'
        . '<i class="fa ' . $folder . ' fa-fw" aria-hidden="true"></i> &nbsp; '
        . '<span>' . \ucfirst($this->title) . '</span></a>'
        . '<ul class="nav-dropdown-items">' : '<li ' . $liActive . ' class="nav-item">'
        . '<a href="javascript:void(0);" class="nav-link" ' . $active . '">'
        . '<i class="fa ' . $folder . ' fa-fw" aria-hidden="true"></i> &nbsp; '
        . '<span>' . \ucfirst($this->title) . '</span></a>'
        . '<ul class="nav-dropdown-items">';

        foreach ($this->menu as $menuItem) {
            $extraClass = $menuItem->active ? ' active' : '';
            $html .= empty($menuItem->menu) ? '<li><a class="dropdown-item' . $extraClass . '" href="' . $menuItem->url
                . '">' . $menuItem->getHTMLIcon() . '&nbsp; ' . \ucfirst($menuItem->title)
                . '</a></li>' : $menuItem->getHTML($menuId);
        }

        $html .= '</ul>';

        return $html;
    }
}