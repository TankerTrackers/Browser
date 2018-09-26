# `TankerTrackers\Browser`

A quick and dirtly little package that does nothing but return a workable user agent string. No
configuration, no routes, nothing fancy. Just wanted to break it out of the application proper and
modularize it like this so that it could be handled separately.

> Last updated using [StatCounter values from June 2018](https://en.wikipedia
.org/wiki/Usage_share_of_web_browsers).

## Usage

```
> $userAgent = TankerTrackers\Browser\Browser::get();

> print_r($userAgent);

<< TODO: RESULTS >>
```

Despite this being a static call, the user agent will be saved by means of the Singleton pattern. To
force a new user agent to be generated, simply call `TankerTrackers\Browser\Browser::regenerate();`,
it calls `get()` for you as well.

## Options

`get()` takes a number of options, all of which have reasonable defaults. In 99% of the cases, you
should not have to worry about the options. If, however, you do, construct a key-value array that
you pass as an argument to `get()`, containing one or more of the following keys:

* `mobile` (default: _true_). Set to **false** if you do not wish to receive the user agent strings
of mobile devices. Set to **only** if

> Note: Passing locale strings is not fully implemented yet. At the moment, it does next to no
> difference what you pass as an argument to `get()`.
