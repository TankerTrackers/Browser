<?php namespace TankerTrackers\Browser {

    /**
     * Class Browser
     *
     * @package TankerTrackers\Browser
     */
    class Browser {

        // These are the percentages of people using each of the below browsers, multiplied by
        // 100 to get an integer. These numbers are used as the basis of generating the
        // statistically most likely user agent.
        public static $singleton = null;
        public $userAgent;
        protected $browserStatistics = [
            'chrome'    => 6472,
            'edge'      => 418,
            'firefox'   => 1221,
            'iexplorer' => 771,
            'safari'    => 629
        ];

        /**
         * This function starts us over from null.
         */
        public static function regenerate ()
        {
            if (self::$singleton) {
                self::$singleton = null;
            }

            return self::generate();
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
        public static function get (array $lang = ['en-US'])
        {
            if (self::$singleton === null) {
                self::$singleton = new self;
            } else {
                return self::$singleton->userAgent;
            }

            self::$singleton->userAgent['browser'] = self::$singleton->pickRandomBrowser();

            return self::$singleton->userAgent;
        }

        /**
         * @return int|string
         * @throws \Exception
         */
        protected function pickRandomBrowser ()
        {
            $sumOfWeights = self::sumWeights(self::$singleton->browserStatistics);
            $result       = self::roll($sumOfWeights, self::$singleton->browserStatistics);

            return $result;
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
        protected function roll (int $sum, array $array)
        {
            $iteration       = 0;
            $randomSelection = random_int(0, $sum);

            foreach ($array as $name => $weight) {
                $iteration += $weight;
                if ($randomSelection < $iteration) {
                    return $name;
                }

            }
        }
    }

}
