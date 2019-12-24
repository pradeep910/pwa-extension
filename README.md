<p align="center">
<a href="https://rtcamp.com/" target="_blank"><img width="200"src="https://rtcamp.com/wp-content/uploads/2018/04/rtcamp-logo-1.svg"></a>
</p>

# PWA Extension
An extension to [PWA](https://wordpress.org/plugins/pwa/) to enable `add to homescreen` and `offline reading` features of PWA.

**Contributors:** [rtCamp](https://github.com/rtCamp/)

**Tags:** [pwa](https://wordpress.org/plugins/tags/pwa)
**Requires at least:** 4.9  
**Tested up to:** 5.1  
**License:** [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)  
**Requires PHP:** 5.4+


## Requirements
- The Official [PWA](https://wordpress.org/plugins/pwa/) Plugin

## Features
- `Add to Home Screen` popup for mobiles with custom icon setup in WP theme `(your-theme//assets/img/icon-{width x height}.png'`.
- Offline reading by caching assets and pages.

## Integration with izooto plugin.
- Registers izooto service worker using `wp_front_service_worker` hook to main service worker file
- Removes Service worker code of izooto from `?izooto=sw` to prevent conflicting it with main service worker.

## Change Log

### v1.0.1 (24-12-2019)
* izooto push notifications plugin integration.

### v1.0.0 (12-09-2019)
* `Add to Home Screen` popup for mobiles with custom icon setup in WP theme `(your-theme//assets/img/icon-{width x height}.png'`.
* Offline reading by caching assets and pages.



# Does this interest you?

<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>
