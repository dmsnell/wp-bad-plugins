# SqlPosts

This plugin turns your posts into SQL a custom database console.
To use, write a post whose first line is nothing but `SQL`.
The remaining lines will be joined and passed into `$wpdb` as a database query.
If the query is successful the output will be printed into the rendered post.
Otherwise, the error from the database will print out instead.

## How to use

Create a post titled `wut` and use the following content for the post content.

```
SQL

UPDATE wp_posts
SET post_title = CONCAT( post_title, ' ', post_title )
WHERE LEFT( post_title, 3 ) = 'wut'
```

## Why is this bad?

Never ever allow arbitrary and unsanitized input to slip into a database query.
Some plugins assume that data coming in through shortcodes or through other fields in WordPress are safe to use directly in a query.
This plugin takes this to the extreme to illustrate the point.
