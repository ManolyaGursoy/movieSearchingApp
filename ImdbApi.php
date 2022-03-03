<?php
  class MoviesandSeries {
    public $searchtext;

    function __construct(string $text)
    {
      $this->searchtext=$text;
    }

    public function search() {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        /* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! BURASI  KONTROL EDİLECEK */
        CURLOPT_URL => 'http://www.omdbapi.com/?apikey='  /*  !!!!!!!THIS IS YOUR API KEY!!!!!!!  */     '&s='. $this->searchtext,
                /* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! BURASI  KONTROL EDİLECEK */
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      return $response;
    }
  }
