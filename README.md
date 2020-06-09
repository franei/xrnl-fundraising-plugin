# XRNL Fundraising plugin

#### This plugin does 3 things:
- Adds a per-day counter of requests for the `/donate` page in `post_meta` data
- Provides a shortcode which outputs table rows with the per-day counts
- Redirects to the URL specified in the `get_redirect_url` function

#### To use:
1. Install and activate the plugin
2. Turn off the current `.htaccess` redirect
3. Create a page, e.g. extinctionrebellion.nl/fundraising, and paste something like this into it:

```html
<table class="table">
<caption>Visits to the Donate page</caption>
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody>
    [xrnl-fundraising]
  </tbody>
</table>
```
