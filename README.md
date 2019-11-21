# GK ACF Subscriber WP Plugin

Wtyczka pierwotnie dodająca klasę `subscriber` do tagu `body`, ale później rozbudowana do:
* `subscriber` class when user is a subscriber,
* `not-subscriber` class when user is not a subscriber,
* custom CSS,
* custom JS.

Wtyczka działa w parze z wtyczką Advanced Custom Fields.

## Get ACF values

Example:

```sql
SELECT * FROM wp_usermeta AS u WHERE u.meta_key LIKE "preferencje_%"
UNION ALL
SELECT * FROM wp_usermeta AS u WHERE u.meta_key = "zwiedzanie_obiektu"
```

## Clearing old ACF values

```sql
UPDATE wp_usermeta SET meta_value = '' WHERE meta_key LIKE "preferencje_%";
UPDATE wp_usermeta SET meta_value = '0' WHERE meta_key LIKE "zwiedzanie_obiektu";
```
