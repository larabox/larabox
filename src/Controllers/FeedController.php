<?php namespace Suroviy\LaraBox\Controllers;

use App\Post;
use Feed;
use URL;

use Illuminate\Routing\Controller as BaseController;

class FeedController extends BaseController
{
    protected function getModel(){
        return new Post();
    }

    public function getFeed(){
        $feed = Feed::make();

        $feed->title = config('suroviy.lara_box.feed.title');
        $feed->description =config('suroviy.lara_box.feed.title');
        $feed->logo = asset('img/logo.png');
        $feed->link = URL::to('feed');
        $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
        $feed->lang = 'ru';
        $feed->setShortening(true); // true or false
        $feed->setTextLimit(100); // maximum length of description text

        $feed = $this->addItem($feed);

        return $feed->render('atom');;
    }

    Protected function addItem($feed){
        $pages = $this->getModel()->orderBy('created_at', 'desc')->sort()->get();

        if ($pages) {
            foreach ($pages as $key=>$page)
            {
                if ($key == 0) {
                    $feed->pubdate = $page->created_at->toDateTimeString();
                }
                // set item's title, author, url, pubdate, description and content

                //$author =  ;
                $feed->add(
                    $page->title,
                    ($page->user) ? $page->user->name : $this->default_author,
                    URL::to($page->url),
                    $page->publish,
                    $page->description,
                    $page->description
                );
            }
        }
        return $feed;
    }
}