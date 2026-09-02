<?php declare(strict_types=1);
class YouTubeSync {
    private string $apiKey;
    private string $channelId;
    private string $cacheFile;

    public function __construct() {
        $this->apiKey = defined('YOUTUBE_API_KEY') ? YOUTUBE_API_KEY : '';
        $this->channelId = defined('YOUTUBE_CHANNEL_ID') ? YOUTUBE_CHANNEL_ID : 'UC1exM7D3yO8L1Qo5JyLjHIg';
        $this->cacheFile = ROOT_PATH.'/cache/youtube_cache.json';
        if(!is_dir(dirname($this->cacheFile))){@mkdir(dirname($this->cacheFile),0777,true);}
    }

    private function getCachedData(string $key): mixed {
        if(file_exists($this->cacheFile)){
            $data = json_decode(file_get_contents($this->cacheFile),true);
            if(isset($data[$key]['timestamp'])&&(time()-$data[$key]['timestamp']<600)){
                return $data[$key]['value'];
            }
        }
        return null;
    }

    private function setCachedData(string $key, mixed $value): void {
        $data=file_exists($this->cacheFile)?json_decode(file_get_contents($this->cacheFile),true):[];
        $data[$key]=['timestamp'=>time(),'value'=>$value];
        @file_put_contents($this->cacheFile,json_encode($data));
    }

    public function checkLive(): bool {
        if(empty($this->apiKey)) return false;
        return $this->getLiveVideoId() !== null;
    }

    public function getLiveVideoId(): ?string {
        if(empty($this->apiKey)) return null;
        $cached=$this->getCachedData('liveVideoId');
        if($cached!==null) return is_string($cached)&&!empty($cached)?$cached:null;
        $url="https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$this->channelId}&eventType=live&type=video&key={$this->apiKey}";
        $response=@file_get_contents($url);
        if($response){
            $data=json_decode($response,true);
            if(!empty($data['items'])){
                $vid=$data['items'][0]['id']['videoId'];
                $this->setCachedData('liveVideoId',$vid);
                return $vid;
            }
        }
        $this->setCachedData('liveVideoId',null);
        return null;
    }

    public function getLatestVideos(int $count=3): array {
        if(empty($this->apiKey)) return [];
        $cached=$this->getCachedData('latestVideos');
        if(is_array($cached)) return $cached;
        $url="https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$this->channelId}&order=date&maxResults={$count}&type=video&key={$this->apiKey}";
        $response=@file_get_contents($url);
        $videos=[];
        if($response){
            $data=json_decode($response,true);
            if(!empty($data['items'])){
                foreach($data['items'] as $item){
                    $videos[]=['id'=>$item['id']['videoId'],'title'=>$item['snippet']['title'],'thumbnailUrl'=>$item['snippet']['thumbnails']['high']['url']??'','publishedAt'=>$item['snippet']['publishedAt']];
                }
            }
        }
        $this->setCachedData('latestVideos',$videos);
        return $videos;
    }
}
