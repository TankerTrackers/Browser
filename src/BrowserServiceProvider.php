<?php namespace TankerTrackers\Browser {

    use Illuminate\Foundation\AliasLoader;
    use Illuminate\Support\ServiceProvider;
    use TankerTrackers\Browser\Browser;

    /**
     * Class BrowserServiceProvider
     *
     * @package TankerTrackers\Browser
     */
    class BrowserServiceProvider extends ServiceProvider {

        protected $browserProviders = [
            'Browser' => Browser::class
        ];

        protected $browserAliases = [
            'Browser' => BrowserFacade::class
        ];

        public function register () : void
        {
            /**
             * Nothing here right now.
             */
        }

        public function boot () : void
        {
            $this->registerServiceProviders();
            $this->registerFacadeAliases();
        }

        protected function registerServiceProviders ()
        {
            foreach ($this->browserProviders as $providerKey => $providerClass) {
                $this->app->bind($providerKey, $providerClass);
            }
        }

        public function registerFacadeAliases ()
        {
            $loader = AliasLoader::getInstance();

            foreach ($this->browserAliases as $alias => $facade) {
                $loader->alias($alias, $facade);
            }
        }

        public function provides ()
        {
            return [];
        }
    }
}
