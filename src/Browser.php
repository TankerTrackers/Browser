<?php namespace TankerTrackers\Browser {

    /**
     * Class Browser
     *
     * @package TankerTrackers\Browser
     */
    class Browser {

        public static $singleton = null;

        public $userAgentString = [
            'browser'         => 'Mozilla',
            'version'         => '5.0',
            'systeminfo'      => null,
            'platform'        => null,
            'platformdetails' => null,
            'extensions'      => null
        ];

        /**
         * These are the percentages of people using each of the below browsers, multiplied by
         * 100 to get an integer. These numbers are used as the basis of generating the
         * statistically most likely user agent.
         * */
        protected $browserStatistics = [
            'chrome'    => 5894,
            'edge'      => 189,
            'aosp'      => 156,
            'firefox'   => 517,
            'opera'     => 350,
            'samsung'   => 267,
            'iexplorer' => 771,
            'safari'    => 1370,
            'uc'        => 746,
        ];

        protected $chromePlatforms = [
            'Windows NT 10.0; Win64; x64'       => 1960,
            'Windows NT 6.1; Win64; x64'        => 590,
            'Macintosh; Intel Mac OS X 10_13_5' => 370,
            'Macintosh; Intel Mac OS X 10_13_6' => 360,
            'Macintosh; Intel Mac OS X 10_12_6' => 210,
            'Windows NT 6.3; Win64; x64'        => 140,
            'Macintosh; Intel Mac OS X 10_13_4' => 140,
            'Windows NT 10.0; Win64; x64'       => 120,
            'Windows NT 6.1'                    => 110,
            'Macintosh; Intel Mac OS X 10_11_6' => 80,
            'Windows NT 10.0; Win64; x64'       => 70,
        ];

        /**
         * This function starts us over from null.
         *
         * @throws \Exception
         */
        public static function regenerate (array $lang = ['en-US'])
        {
            if (self::$singleton) {
                self::$singleton = null;
            }

            return self::get($lang);
        }

        /**
         * This function generates a new user agent string if we don't have one, otherwise
         * returns what we have.
         *
         * @param array $lang
         *
         * @return mixed
         * @throws \Exception
         */
        public static function get (array $options = [])
        {
            if (self::$singleton === null) {
                self::$singleton = new self;
            } else {
                return self::$singleton->userAgentString;
            }

            self::parseOptions($options);

            self::$singleton->userAgentString['browser'] = self::$singleton->pickRandomBrowser();

            echo self::$singleton::generateString();

            return self::$singleton->userAgentString;
        }

        /**
         * @param $options
         */
        protected static function parseOptions ($options)
        {

        }

        /**
         * @return int|string
         * @throws \Exception
         */
        protected function pickRandomBrowser ()
        {
            return $this->roll($this->browserStatistics);
        }

        /**
         * @param array $array
         *
         * @return int|mixed
         */
        protected function sumWeights (array $array)
        {
            $sumOfWeights = 0;
            foreach ($array as $name => $weight) {
                $sumOfWeights += $weight;
            }

            return $sumOfWeights;
        }

        /**
         * @param int   $sum
         * @param array $array
         *
         * @return int|string
         * @throws \Exception
         */
        protected function roll (array $array)
        {
            arsort($array);
            $sum             = $this->sumWeights($array);
            $iteration       = 0;
            $randomSelection = random_int(0, $sum);

            reset($array); // Just in case.

            foreach ($array as $name => $weight) {
                $iteration += $weight;
                if ($randomSelection < $iteration) {
                    return $name;
                }
            }
        }

        public static function generateString ()
        {
            $string = self::$singleton->userAgentString;

            return "{$string['browser']}/{$string['version']}";
        }

        // === Browsers and their peculiarities === //

        /**
         * @return string
         */
        protected function chromeVersion () : string
        {
            return \random_int(60, 68) . '.0.' . \random_int(800, 899) . '.' . \random_int(1, 200);
        }
    }

}
