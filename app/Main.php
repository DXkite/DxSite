<?php
import('Site.functions');

class Main
{
    public function __construct()
    {
        Common_Navigation::init();
    }
    public function main()
    {
        Site\page_common_set();
        Page::set('title',Site_Options::getOptions()['site_name']);
        Page::set('head_index_nav_select', 0 );
        $categorys=Blog_Category::getCategorysInfo();
        $cobj=[];
        foreach ($categorys as $category){
            $cobj[]=new Core\Value($category);
        }
        Page::set('article_categorys',$cobj);

        $tags=Blog_Tag::getTagsInfo();
        $tobj=[];
        foreach ($tags as $tag){
            $tobj[]=new Core\Value($tag);
        }
        Page::set('article_tags',$tobj);
    }
}
