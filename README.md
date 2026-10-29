# August Ash WP Child Theme

This child theme is based off of the [August Ash WP Base Theme](https://github.com/augustash/aai-wp/tree/2.0)

## Building

Run from the site root, inside DDEV:

```bash
ddev exec -d /var/www/html/wp-content/themes/ash-child npm ci
ddev exec -d /var/www/html/wp-content/themes/ash-child npx gulp         # or: npx gulp watch
```

Compiled css and js are committed, since Pantheon doesn't run a build. Each `components/*/*.scss`
compiles on its own, so it imports Ash's breakpoint utility and this theme's base partials itself.
