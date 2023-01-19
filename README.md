# To do

* Create header to filter for certain tags - bass tabs, projects, data stuff
  * Cant do ATM
* Create more articles for github projects
  * Travel alerts
  * NBA score tracker - done
  * TFL cycles - done
* https://www.richard-stanton.com/2015/02/the-new-amazon-price-checker/ - convert to post
* Redirect domain to github
* Archive old posts?
* Move across all bass tabs - done
* http://www.richard-stanton.com/sports-trackers/premier-league-tracker/premier-league-tracker-201415/ - done
* Move posts:
  * done - https://www.richard-stanton.com/2015/05/itab-review-on-softpedia-com/
  * done - https://www.richard-stanton.com/2015/09/karaoke-mode-techtudo-review/
* Move across disqus thread - done
  * Old IP address 77.111.240.118

Build:  
``bundle exec jekyll serve``

Via docker:
```
docker run --rm -it \
  --volume="$PWD:/srv/jekyll" \
  --volume="$PWD/_vendor/bundle:/usr/local/bundle" \
  -p 4000:4000 jekyll/minimal:3.8 \
  jekyll serve
```
```
--rm = remove container on exit
-i = interactive
--volume = map local:container folder
-p = port
jekyll/minimal:3.8 = image name
jekyll serve = command to run
```

Convert notebook to markdown:  
VScode - export notebook  
``jupyter nbconvert notebook.ipynb --to markdown``

## Testing locally
Via docker:
```
docker run --rm -it \
  --volume="$PWD:/srv/jekyll" \
  --volume="$PWD/_vendor/bundle:/usr/local/bundle" \
  -p 4000:4000 jekyll/minimal:3.8 \
  jekyll serve
```
```
--rm = remove container on exit
-i = interactive
--volume = map local:container folder
-p = port
jekyll/minimal:3.8 = image name
jekyll serve = command to run
```

Convert notebook to markdown:  
VScode - export notebook  
``jupyter nbconvert notebook.ipynb --to markdown``

### Dev container
```
# install ruby
sudo apt-get update
sudo apt-get install ruby-full
# install bundle
sudo bundle install
```

```
sudo bundle exec jekyll serve
```

With custom config:
```
sudo bundle exec jekyll serve --config _config_type.yml 
```

## Testing locally
```
local_test.sh
```

Via docker:
```
docker run --rm -it \
  --volume="$PWD:/srv/jekyll" \
  --volume="$PWD/_vendor/bundle:/usr/local/bundle" \
  -p 4000:4000 sylhare/type-on-strap \
  jekyll serve
```
Bug in image 4.2.2, so use earlier one:
```
docker run --rm -it \
  --volume="$PWD:/srv/jekyll" \
  --volume="$PWD/_vendor/bundle:/usr/local/bundle" \
  -p 4000:4000 jekyll/minimal:4.2.0 \
  jekyll serve
```

```
docker run --rm -it \
  --volume="$PWD:/srv/jekyll" \
  -p 3000:4000 jekyll/builder:latest \              
  /bin/bash -c "bundle add webrick && chmod -R 777 /srv/jekyll && jekyll serve"
```

docker run --rm  -it --name jekyllsite \
  -v "$PWD:/srv/jekyll" \
  -e BUNDLE_PATH="/srv/jekyll/.bundles_cache" \
  -p 4000:4000 \
  jekyll/builder:3.8 \
  bash -c "gem install bundler && bundle install && bundle exec jekyll serve --host 0.0.0.0 --verbose --config _config.yml,_config_dev.yml"


### Merging upstream
```
git checkout -b sylhare-master master
git pull https://github.com/sylhare/Type-on-Strap.git master --no-ff
```

## Remote theme
### Testing locally
https://dev.to/derlin/testing-github-pages-with-remote-theme-locally-3nid
https://github.com/derlin/docker-compose-viz-mermaid/tree/7789bb762df6d8534e2e56e409993373334fd83a/docs

```
./local_test.sh
```

## Custom layouts
* Chrome plugins - makes a template that is filled by meta data from each page.
* Redirected - forwards urls from a previous domain to avoid broken links.
