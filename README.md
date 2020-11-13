# WUHU
Lightweight party management system- significantly modified for running jams.
http://wuhu.function.hu

## Requirements

### Server side:
* Docker and `docker-compose`
### Beamer side: 
* HTML5 compatible browser (Chrome/Firefox preferred)
* Machine to handle it (any OS)

## Deploy Instructions
1. Run `./init_dirs.sh` to set up entry directories and permissions
2. Configure variables in `.env`
3. Run `docker-compose up`

## Using the beam system
1. Click the "Slideviewer" link in the admin
2. Enter the original slide resolution in which the design was done
3. Press "Open viewer" - most browsers allow you to switch to fullscreen with F11.
  
Both beam systems rely on simple keypresses for operation.
  
* ALT-F4 - quit
* LEFT ARROW - previous slide / minus one minute in countdown mode
* RIGHT ARROW - next slide / plus one minute in countdown mode
* HOME - first slide
* END - last slide
* S - partyslide rotation mode
* T - reload stylesheet (without changing the slide contents) 
* SPACE - re-read result.xml (and quit partyslide mode)
    
This last key essentially means that once you've used the "BEAMER" menu on the admin interface, you must press SPACE to refresh the data inside (and/or switch to another mode).
  
## Credits
Wuhu was created and is maintained by Gargaj / Conspiracy.

Additional effort by:
* Zoom / Conspiracy with the original admin design and QA
* Quarryman / Ogdoad for minor fixes
* lug00ber / Kvasigen for additional QA
* The TG Creativia crew for their immense QA effort

Acknowledgments for external stuff are available in the license file.
