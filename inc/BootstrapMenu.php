<?php
require_once 'QuickMenu.php';

class BootstrapMenu extends QuickMenu
{
    public function __construct($options = array())
    {
        parent::__construct($options);
        $this->setDropdownIcon('<i class="caret"></i>');
        $this->set('ul-root', array('class'=>'navbar-nav', 'id'=>'#myMenu'));
        $this->set('ul', array('class'=>'dropdown-menu'));
        $this->set('li-parent', array('class'=>'nav-item dropdown'));        
        $this->set('li', array('class'=>'nav-item'));
        $this->set('a-parent', array('class'=>"nav-link dropdown-toggle", 'data-toggle'=>"dropdown", 'role'=>"button", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"));
        $this->set('a', array('class'=>'nav-link'));
        $this->set('a-child', array('class'=>'dropdown-item'));
    }

    /**
     * Build the menu
     * @param array $array
     * @param int $depth (Optional)
     * @return string The Html code
     */
    protected function build($array, $depth = 0)
    {
        $str = ($depth === 0) ? '<ul' . $this->getAttr('ul-root') . '>' : '<' . $this->getAttr('ul') . '>';
        foreach ($array as $item)
        {
            $isParent = isset($item['children']);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
            $str .= '<li' . $this->getAttr($li) . " {$active} >";
            $str .= '<a href="' . $item['href'] . '" title="' . $item['title'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
            if ($isParent)
            {
                //$str .= $this->build($item['children'], 1);
                $str .= '<div class="dropdown-menu">';
                foreach ($item['children'] as $item) {
                    $str .= '<a href="' . $item['href'] . '" title="' . $item['title'] . '" class="dropdown-item"'."{$active}".'>' . $this->getTextItem($item, $isParent) . '</a>';
                }
                $str .= "</div>";
            }
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
