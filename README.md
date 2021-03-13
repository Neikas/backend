# Created by Neikas ( Edvinas )

# Task

Frontend:
 - [X] It should be able to submit list of websites but at this moment it's only available to post one website url
- [x] It's bad practice to hardcode url in the code (http://backend.test/api/....). If the hostname of api and frontend is
   the same then url should start with path ("/api/...") and only if the hostname is different use full url.
3. Crawler results should be grouped by crawl start time

Backend:

- [x]  Crawler works only when website url is storing. Job storing API should be responsible only for handling job
   submission but not crawling.
- [x]  It would be nice that crawler would be able to crawl websites in background without frontend iteractions
- [x]  Crawler saves only one article. Websites may have one or more than one article so all of them should be saved.
- [x]  Why ScraperController has all the logic of scraping and is called from event? Maybe logic can be stored in the
   service?
- [x]  Controllers/Api/ArticleController@index (line 19) - you don't need to select all articles twice.
