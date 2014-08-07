WordPress-Custom-Post-Type
==========================

PHP Class that helps to create unlimited custom post-types for wordpress.



Use of Post Type Class
======================

This class require two parameters: `$post_type` (Post Type Key) and `$name` (Display Name) 

```php
// Include the class first
include 'YOUR_FILE_LOCATION/class.post_type.php';

$oject = new Post_Type("wpu_estore", "EStore");
```
