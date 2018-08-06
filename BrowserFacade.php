<?php namespace TankerTrackers\Browser {

    use Illuminate\Support\Facades\Facade;

    /**
     * Class BrowserFacade
     *
     * @package TankerTrackers\Browser
     */
    class BrowserFacade extends Facade {

        /**
         * @return string
         */
        protected static function getFacadeAccessor ()
        {
            return 'Browser';
        }

    }

}
