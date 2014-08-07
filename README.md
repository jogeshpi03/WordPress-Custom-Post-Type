WordPress-Custom-Post-Type
==========================

PHP Class that helps to create unlimited custom post-types for wordpress.



##Use of Post Type Class

This class require two parameters: `$post_type` (Post Type Key) and `$name` (Display Name) 

```php
// Include the class first
include 'YOUR_FILE_LOCATION/class.post_type.php';

$oject = new Post_Type("wpu_estore", "EStore");
```

##Taxonomy for Custom Post Type

By Default taxonomy is `false` in this class, this is the third parameter of the class `new Post_Type($post_type, $name, FALSE);`. To enable the taxonomy just make the third parameter set `TRUE`. 

```php
// Custom Post Type with Taxonomy
// ==============================

$oject = new Post_Type("wpu_estore", "EStore", TRUE);

```

