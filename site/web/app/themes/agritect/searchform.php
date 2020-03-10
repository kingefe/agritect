<form role="search" method="get" class="search-form" action="/">
  <label>
    <span class="screen-reader-text">Search for:</span>
    <input type="search" class="search-field <?=is_blog() || is_search() ? 'light' : '' ?>" placeholder="Find programs, sector, etc.…" value="" name="s" id="search_keyword" autocomplete="off">
  </label>
  <input type="submit" class="search-submit" value="Search">
  <ul id="search_results"></ul>
</form>
