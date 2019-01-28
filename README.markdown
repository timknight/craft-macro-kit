# Macro Kit for Craft CMS

Macro Kit provides several functions that can be imported into your front-end templates for use in Craft CMS.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install Macro Kit, follow these steps:

1. Install with Composer using `composer require timknight/craft-macro-kit`
2. Install the plugin in the Craft Control Panel under `Settings > Plugins`

Macro Kit is also available in the Craft Plugin Store available in the Control Panel.

## Usage

Macro Kit can be used within your templates simply by importing all of the macros into a template.

```
{% import "_macrokit/all" as mk %}
```

Or import individual macros into the current namespace.

```
{% from "_macrokit/all" import daterange, randomString %}
{{ daterange(event.start, event.end) }}
{{ randomString(10) }}
```

You can customize the path to the `all.twig` template (`_macrokit` by default) by editing the plugin’s “Template Path” setting, or creating a `config/macro-kit.php` file with this:

```php
<?php

return [
    'templatePath' => '_customTemplatePath',
];
```

### abbrStateName

Given a full US state name this returns the appreviated name of that state.

```
{{ mk.abbrStateName("Florida") }}
# => FL
```

### daterange

Given two dates within the same month, this returns a formatted date range.

```
{{ mk.daterange(event.start, event.end)}}
#=> January 14 — 16, 2019
#=> January 14 — February 2, 2019
```

Optionally, you can supply a separator to be used in place of the default `&ndash;`.

```
{{ mk.daterange(event.start, event.end, " to ")}}
#=> January 14 to 16, 2019
```

### fullStateName

Given an appreviated US state this returns the full state name.

```
{{ mk.fullStateName("FL") }}
# => Florida
```

### linkToIf

Given a condition this wraps a block within a link if the condition is met.

```
{{ mk.linkToIf(profile.body, profile.url, profile.title) }}
If profile.body has exists and has length #=> <a href="{{ profile.url }}">{{ profile.title }}</a>
else #=> {{ profile.title }}
```

Pass in a block variable if you'd like:

```
{% set image %}
  <img src="{{ featuredImage.url }}" alt="{{ featuredImage.title }}">
{% endset %}
{{ mk.linkToIf(profile.body, profile.url, image) }}
```

Optionally, you can set if the link is external which can open a new window and set `rel="noopener"`.

```
{{ mk.linkToIf(profile.body, profile.url, profile.title, true) }}
```

You can also assign CSS classes to the generated link:

```
{{ mk.linkToIf(profile.body, profile.url, profile.title, false, "nav-link") }}
```

### ordinalNum

Given a number this returns the number with its ordinal suffix: 1 => 1st

```
{{ mk.ordinalNum(1) }} #=> 1st
{{ mk.ordinalNum(2) }} #=> 2nd
{{ mk.ordinalNum(3) }} #=> 3rd
{{ mk.ordinalNum(4) }} #=> 4th
```

### randomString

Generates a random string of numbers and letters given a specific length.

```
{{ mk.randomString(25) }} #=> 1V4bnQVMeD0wdixqEz7Imxmbc
```
