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
        public static $singleton;
        protected $browserStatistics = [
            'chrome'    => 6472,
            'edge'      => 418,
            'firefox'   => 1221,
            'iexplorer' => 771,
            'safari'    => 629
        ];

        public $userAgent;

        /**
         * @param array $lang
         *
         * @throws \Exception
         */
        public static function generate (array $lang = ['en-US'])
        {
            if (!self::$singleton) {
                self::$singleton = new self();
            } else {
                return self::$singleton->userAgent;
            }

            self::$singleton->userAgent['browser'] = self::$singleton->pickRandomBrowser();

        }

        protected function pickRandomBrowser ()
        {
            $sumOfWeights = self::sumWeights(self::$singleton->browserStatistics);
            $result       = self::roll($sumOfWeights, self::$singleton->browserStatistics);

            return $result;
        }

        protected function sumWeights(array $array)
        {
            $sumOfWeights = 0;
            foreach ($array as $name => $weight) {
                $sumOfWeights += $weight;
            }
            return $sumOfWeights;
        }

        protected function roll(int $sum, array $array)
        {
            $iteration    = 0;
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
