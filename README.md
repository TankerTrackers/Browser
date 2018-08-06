# `TankerTrackers\Browser`

A quick and dirtly little package that does nothing but return a workable user agent string. No
configuration, no routes, nothing fancy. Just wanted to break it out of the application proper and
modularize it like this so that it could be handled separately.

## Usage

```
> $userAgent = TankerTrackers\Browser\Browser::get();

> print_r($userAgent);

<< TODO: RESULTS >>
```

Despite this being a static call, the user agent will be saved by means of the Singleton pattern. To
force a new user agent to be generated, simply call `TankerTrackers\Browser\Browser::regenerate();`
- it calls `get()` for you as well.
