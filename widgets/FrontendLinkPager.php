<?php

namespace app\widgets;

//前端分页小部件

class FrontendLinkPager extends \yii\widgets\LinkPager
{
    public function init()
    {
        if ($this->pagination === null) {
            return false;
        }
    }

    protected function renderPageButtons()
    {
        if ($this->pagination === null) {
            return null;
        }
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2) {
            return null;
        }
        //当前页
        $currentPage = $this->pagination->getPage() + 1;
        //前一页
        $prevPage = ($currentPage - 1) > 0 ? ($currentPage - 1) : 0;
        //后一页
        $nextPage = ($currentPage + 1) > $pageCount ? 0 : ($currentPage + 1);
        $content  = '<div class="pages"><ul>';
        if ($prevPage) {
            $content .= '<li><a href="' . $this->pagination->createUrl(1) . '">首页</a></li>';
            $content .= '<li><a href="' . $this->pagination->createUrl($prevPage - 1) . '">上一页</a></li>';
        }
        //页码链接
        $startNum = floor($currentPage / 5) * 5 + 1;
        $endNum   = $startNum + 9;
        if ($endNum > $pageCount) {
            $endNum = $pageCount;
        }
        for ($i = $startNum; $i <= $endNum; $i++) {

            $content .= '<li class="' . ($i == $currentPage ? 'current' : '') . '"><a href="' . $this->pagination->createUrl($i - 1) . '">' . $i . '</a></li>';
        }
        if ($nextPage) {
            $content .= '<li><a href="' . $this->pagination->createUrl($nextPage - 1) . '">下一页</a></li>';
            $content .= '<li><a href="' . $this->pagination->createUrl($pageCount - 1) . '">末页</a></li>';
        }
        return $content;

    }

}
