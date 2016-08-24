<?php

namespace app\widgets;

//后端分页小部件

class BackendLinkPager extends \yii\widgets\LinkPager
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
        //总条数
        $totalCount = $this->pagination->totalCount;
        //当前页
        $currentPage = $this->pagination->getPage() + 1;
        //前一页
        $prevPage = ($currentPage - 1) > 0 ? ($currentPage - 1) : 0;
        //后一页
        $nextPage = ($currentPage + 1) > $pageCount ? 0 : ($currentPage + 1);
        $content  = '<div class="pagin"><div class="message">共<i class="blue">' . $totalCount . '</i>条记录，当前显示第&nbsp;<i class="blue">' . $currentPage . '&nbsp;</i>页</div>';
        $content .= '<ul class="paginList">';
        if ($prevPage) {
            $content .= '<li class="paginItem"><a href="' . $this->pagination->createUrl($prevPage - 1) . '"><span class="pagepre"></span></a></li>';
        }
        //页码链接
        $startNum = floor($currentPage / 10) * 10 + 1;
        $endNum   = $startNum + 9;
        if ($endNum > $pageCount) {
            $endNum = $pageCount;
        }
        for ($i = $startNum; $i <= $endNum; $i++) {
            $content .= '<li class="paginItem ' . ($i == $currentPage ? 'current' : '') . '"><a href="' . $this->pagination->createUrl($i - 1) . '">' . $i . '</a></li>';
        }
        if ($nextPage) {
            $content .= '<li class="paginItem"><a href="' . $this->pagination->createUrl($nextPage - 1) . '"><span class="pagenxt"></span></a></li>';
        }
        return $content;

    }

}
