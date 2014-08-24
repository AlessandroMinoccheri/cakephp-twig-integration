cakephp-twig-integration
========================

CakePHP installation with twig integration

#Introduction
CakePHP is a great framework to develop sites but I think that an interesting way to upgrade this MVC is to integrate TWIG engine to make the writing of view files easier, faster and better.
Twig integration allows to create a set of template for your site.


When you clone this repository cakephp core and twig engine are already integrated, you just need to create your twig files because all the dependencies and configurations are already written to use Twig engine.

To learn how to write Twig files, look at this link that allowed me to create this cakephp installation:

https://github.com/predominant/TwigView

## Using the View Class ##

To make CakePHP aware of TwigView edit your `APP/Controller/AppController.php` file and add the following:

	class AppController extends Controller  {
		public $viewClass = 'TwigView.Twig';
	}

Be sure to load the TwigView plugin in your bootstrap.php file with:

	CakePlugin::load('TwigView');

or:

	CakePlugin::loadAll();

Now start creating view files using the `.tpl` extension.

## Default Layouts ##

This plugin comes with all default layouts converted to Twig. Examples can be found in:

	APP/Plugin/TwigView/examples

## Themes ##

The plugin has support for themes and works just like the `Theme` view. Simply add the `$theme` property to your controller and you're set.

	class AppController extends Controller  {
		public $viewClass = 'TwigView.Twig';
		public $theme = 'Rockstar';
	}

This will cause the view to also look in the `Themed` folder for templates. In the above example templates in the following directory are favored over their non-themed version.

	APP/View/Themed/Rockstar/

If you, for example, want to overwrite the `Layouts/default.tpl` file in the `Rockstar` theme, then create this file:

	APP/View/Themed/Rockstar/Layouts/default.tpl

## Using Helpers inside Templates ##

All helper objects are available inside a view and can be used like any other variable inside Twig.

	{{ time.nice(user.created) }}

... where ...

	{{ time.nice(user.created) }}
	    ^    ^    ^    ^____key
	    |    |    |____array (from $this->set() or loop)
	    |    |_____ method
	    |______ helper

Which is the equivalent of writing:

	<?php echo $this->Time->nice($user['created']); ?>

A more complex example, FormHelper inputs:

	{{
	  form.input('message', {
	    'label': 'Your message',
	    'error': {
	      'notempty': 'Please enter a message'
	    }
	  })
	}}

## Referencing View Elements ##

Elements must be `.tpl` files and are parsed as Twig templates. Using `.ctp` is not possible.

In exchange for this limitation you can import elements as easy as this:

	{% element 'sidebar/about' %}

## Translating Strings ##

The `trans` filter can be used on any string and simply takes the preceding string and passes it through the `__()` function.

	{{
	  form.input('email', {
	    'label': 'Your E-Mail Address'| trans
	  })
	}}

This is the equivalent of writing:

	<?php echo $this->Form->input('email', array(
	   'label' => __("Your E-Mail Address")
	)); ?>

## Translating multiple lines ##

The trans-block element will help you with that. This is especially useful when writing email templates using Twig.

	{% trans %}
	Hello!

	This is my mail body and i can translate it in X languages now.
	We love it!
	{% endtrans %}

## TwigView Custom Filters ##

This plugin comes with a couple of handy filters, just like 'trans', piping some core CakePHP functions into Twig templates.

### `ago` ###

Shortcut to TimeHelper::timeAgoInWords

	{{ user.created|ago }}

### `low` ###

Convert a string to lower case

	{{ 'FOO'|low }}

### `up` ###

Convert a string to upper case

	{{ 'foo'|up }}

### `debug` ###

Display the debug (pre+print_r) output

	{{ user|debug }}

### `pr` ###

Display just the print_r output

	{{ user|pr }}

### `env` ###

Display the value from a environment variable

	{{ 'HTTP_HOST'|env }}

### `size` ###

Convert byte integer to a human readable size

	{{ '3535839525'|size }}    //=> 3.29 GB

### `p` ###

Formats a number with a level of precision.

	{{ '0.555'|p(2) }}    //=> 0.56

### `curr` ###

Display floating point value as currency value. USD, GBP and EUR only

	{{ '5999'|curr }}         // default, $5,999.00
	{{ '5999'|curr('GBP') }}  // £5,999.00
	{{ '5999'|curr('EUR') }}  // €5.999,00

### `pct` ###

Formats a number into a percentage string.

	{{ '2.3'|pct }}    //=> 2.30%

## Twig Built-In Filters ##

For a list of available filters please refer to the [Twig Manual](http://www.twig-project.org/doc/templates.html#list-of-built-in-filters)

## Accessing View Instance ##

In some cases it is useful to access `$this`, for example to build a DOM id from the current controller and action name.

The object is accessible through `_view`.

	<div class="default" id="{{ _view.name|lower ~ '_' ~ _view.action|lower }}">


License

The MIT License (MIT)

Copyright (c) 2014 Alessandro Minoccheri

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
