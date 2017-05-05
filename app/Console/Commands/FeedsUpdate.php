<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Feed;

class FeedsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeds:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all feeds from feed database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feeds = Feed::all();

        \App\RssFeeds::truncate();

        foreach ($feeds as $feed) {
            if (! $this->checkFeedUrl($feed->feed_url)) {
                $this->error("RSS Feed Provider link is broken: " . $feed->feed_url);

                continue;
            }

            $this->createFeed($feed);
        }

        $this->info("Done");
    }

    private function checkFeedUrl($feedUrl)
    {
        libxml_use_internal_errors(true);

        if (filter_var($feedUrl, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $feedUrlHeader = get_headers($feedUrl, '1');

        if (! $feedUrlHeader || $feedUrlHeader[0] != 'HTTP/1.1 200 OK') {
            return false;
        }

        if (! simplexml_load_file($feedUrl, 'SimpleXMLElement', LIBXML_NOCDATA)) {
            return false;
        }

        
        return true;
    }


    private function validateXmlString($itemDescription)
    {
        libxml_use_internal_errors(true);

        $itemDescription = simplexml_load_string('<document>' . $itemDescription . '</document>');

        $xmlString = explode("\n", $itemDescription);

        if (!$xmlString) {
            $xmlString = null;
        }

        return $itemDescription;
    }
    
    public function feedEntryValidate(array $data)
    {
        return Validator::make($data, [
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',
            'img' => 'required',
            'pubDate' => 'required'
        ]);
    }

    private function restructure($description)
    {
        $description = html_entity_decode($description);

        $description = str_replace(array("\r", "\n", "\t"), "", $description);

        $description = $this->validateXmlString($description);

        return $description;
    }

    protected function printErrors(array $errors)
    {
        foreach ($errors as $error) {
            $this->error($error);
        }
    }

    private function createFeed(Feed $feed)
    {
        $xml = simplexml_load_file($feed->feed_url, 'SimpleXMLElement', LIBXML_NOCDATA);


        foreach ($xml->channel->item as $item) {
            if (is_null($description = $this->restructure($item->description))) {
                continue;
            }

            $data = array(
                'title' => (string) $item->title,
                'link'  => (string) $item->link,
                'description'  => (string) $description[0],
                'img' => (string) $description->a[0]->img['src'],
                'pubDate'  => (string) $item->pubDate,
            );
    

            $validate = $this->feedEntryValidate($data);

            if ($validate->fails()) {
                $this->printErrors($validate->errors()->all());

                continue;
            }

            $feed->rssFeeds()->create($data);
        }
    }
}
