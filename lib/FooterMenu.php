<?php
require_once 'QuickMenu.php';

class FooterMenu extends QuickMenu
{
    public function __construct($options = array())
    {
        parent::__construct($options);
    }


    /**
     * Build the menu
     * @param array $array
     * @param int $depth (Optional)
     * @return string The Html code
     */
    protected function build($array, $depth = 0)
    {
        $str = '<ul>';
        foreach ($array as $item)
        {
            $isParent = isset($item['children']);
            $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
            $str .= '<li>';
            $str .= '<a href="' . $item['href'] . '" title="' . $item['title'] . '"' .'>' . $this->getTextItem($item, $isParent) . '</a>';
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }

}
