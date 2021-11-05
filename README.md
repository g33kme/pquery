# PQuery
PQuery is a simple PHP Wrapper for HTML/jQuery AJAX forms and links. Easy to use in your HTML views or templates.

You can also use PQuery for HTML Forms and Links to update content on your loaded page via AJAX.


## 1. Installation: PQuery

This library is installable via [Composer](https://getcomposer.org/):

```bash
composer require g33kme/pquery
```

You can also simply manually include `source/pquery.php` from this repository to your project and use the PQuery PHP Class.

```php
include('path/to/my/pquery.php');
```

## Requirements

This library requires PHP 7.1 or later and if you use Composer you need Version 2+.

You also need to add the [jQuery Framework](https://code.jquery.com/) to your HTML template

```html
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
```

## 3. How to use PQuery

Here we create a simple HTML Form where we can setup form elements that will be sent via PQuery to your ajax.php file.

### Create an AJAX HTML Form

```html
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"></head>
<body>

    <?php
        
        // You can attach parameters directly to your ajax.php 
        // You can also create a mix with via this parameters and HTML form elements
        
        $params = '?task=geekme&param1=value1&param2=value2';
        $url = 'path/to/your/ajax.php'.$params;
        
        $update = '#myid';
        $jloader = '#jloaderid';
        
        echo PQUERY::form(array(
            'url' => $url,
            'update' => $update,
            'type' => 'POST',
            'name' => 'myform_name',
            'id' => 'myform_id',
            'class' => 'myform_class'
        ));
    ?>
    
    <!-- 
        You can setup any html form elements you want
        They will be passed to your ajax.php
    -->

    <label for="geek">Are your a Geek?</label>
    <select name="geek" id="geek">
      <option value="1337">Yes</option>
      <option value="0">No</option>
      <option value="workingon">Working on ...</option>
    </select>
    
    <label>What is your name?</label>
    <input type="text" name="name">
    
    <input type="hidden" name="id" value="1337">
    <input type="hidden" name="jloader" value="<?=$jloader;?>">
    <input onclick="$('<?=$jloader;?>').show();" class="button" type="submit" value="Please Ajax me!">

</form>

<!-- Grab some free amazing loader indicator maybe from https://loading.io -->
<div id="<?=$jloader;?>" style="display:none;"><img src="path/to/loader-indicator.svg" alt="Loading ..."></div>

<!-- Here the output from your ajax.php will be injected to your page -->
<div id="<?=$update;?>"></div> 

<!-- Do not forget to load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
```

**Attention!** You can **not** create second PQUERY::form(); in an already create form. However, there is a trick, simply create a
PQUERY::link(); in that form. To create an AJAX Link instead of a Form read below.


### Create an AJAX Link

You can also create PQuery AJAX Links which you can also add in a form. Keep in mind that you can not add a form in a form, you 
can only add links in an AJAX Form.

```html
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"></head>
<body>

<?php

    $update = '#myid';
    $jloader = '#jloaderid';
    
    $params = '?task=link-me&param1=value1&key=value&jloader='.$jloader;
    $url = 'path/to/your/ajax.php'.$params;
    
    echo PQUERY::link(array(
        'url' => $url,
        'update' => $update,
        'jloader' => $jloader,
        'name' => 'Ajax Me!',
        'id' => 'setsomeid',
        'class' => 'setsomeclass'
    ));
?>

<!-- Here the output from your ajax.php will be injected to your page -->
<div id="<?=$jloader;?>" style="display:none;"><img src="path/to/loader-indicator.svg" alt="Loading ..."></div>
<div id="<?=$update;?>"></div> 

<!-- Do not forget to load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
```


## Crating an ajax.php for our AJAX Form's and Link's

```php
/*
 * This is some basic example on your ajax.php
 * Of course you can do whatever your want
 */

//Highly recommend to clean your sent parameter requests, PQuery will help
include('path/to/my/pquery.php');
$request = PQUERY::cleanRequest();

//Now you should be save to use the parameters from your request
print_r($request);

//In this example we use one ajax.php for all our ajax request
//Depending on our task we can do whatever we want todo

switch($request[task]) {

	case 'geekme':
	    
	    //Attached parameters on ajax url
        $task = $request['task'];
        $param1 = $request['param1'];
        $param2 = $request['param2'];
                
	    //Form element parameters
        $name = $request['name'];
        $geek = $request['geek'];
        
        //Form element hidden inputs
        $id = $request['id'];
        $jloader = $request['jloader'];
        
        //All echo will be ajaxed to your content
        echo 'My password is the last 8 Digits of π';
        
        //We also passed here our jloader for the loader indicator and if we finish our task we may want to hide
        //Because your content gets loaded via AJAX you can use jQuery without loading again
        ?><script>$("<?=$jloader;?>").hide();</script><?php
        
	    
	break;
	
	case 'link-me':
	
	    //We use the our ajax file for links also
	
	    $param1 = $request['param1'];
        $key = $request['key'];
        $jloader = $request['jloader'];
	    
	    echo 'Come to the Geek Side of Life'; 
	    ?><script>$("<?=$jloader;?>").hide();</script><?php
	    
	    
	break;
	
	case 'other-task':
	    
	    //We may do things here from another task from a PQuery Ajax Form or Link
	    
	break;
	
}
```

## 🙏 Supporters

You own some Cardano ADA? Stake your ADA to our pool with ticker: GEEK  
[GeekMe Stake Pool](https://adapools.org/pool/c13debc5c24d045cf5e2d69c33ff981602ae55d8bded995a6d930836)  