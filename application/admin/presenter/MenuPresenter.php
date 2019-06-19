<?php

namespace app\admin\presenter;


use app\admin\model\Menu;

class MenuPresenter
{
    /**
     * @param int $parentId
     * @param int $defaultId
     * @param string $name
     * @return string
     */
    public  function select($parentId = 0, $defaultId = 0, $name = 'parent_id')
    {
        $select ="<select name={$name} class='form-control'>%s</select>";

        $options = "<option value=''>请选择菜单</option>";

        return sprintf($select, $options . $this->optionToString($parentId, $defaultId));
    }

    /**
     * option to string
     *
     * @param $parentId
     * @param $defaultId
     * @param int $path
     * @return string
     */
    private function optionToString($parentId, $defaultId, $path = 1)
    {
        $options = '';
        $items = Menu::where('parent_id', $parentId)->select();
        $items->map(function($item) use (&$options, $defaultId, $path) {
            $prefix = $this->prefix($path);
            $selected =  $item['id'] == $defaultId ? 'selected' : '';
            $options .= sprintf("<option value='%s' %s>%s</option>", $item['id'], $selected, $prefix . $item['name']);
            $options .= $this->optionToString($item['id'], $defaultId, $path + 1);
        });

        return $options;
    }

    /**
     * 前缀生成
     *
     * @param $path
     * @return string
     */
    private function prefix($path)
    {
        $prefix = '';
        for ($i = 1; $i < $path; $i++) {
            $prefix .='--';
        }
        return $prefix;
    }
}