# Tooltip plugin for Chartist.js (Updated)
[![Build Status](https://travis-ci.com/LukBukkit/chartist-plugin-tooltip.svg?branch=master)](https://travis-ci.com/LukBukkit/chartist-plugin-tooltip)
[![npm](https://img.shields.io/npm/v/chartist-plugin-tooltips-updated.svg)](https://www.npmjs.com/package/chartist-plugin-tooltips-updated)

[![NPM](https://nodei.co/npm/chartist-plugin-tooltips-updated.png)](https://nodei.co/npm/chartist-plugin-tooltips-updated/)


This plugin provides quick and easy tooltips for your chartist charts. Touch support is planned soon.

Please visit http://gionkunz.github.io/chartist-js/plugins.html for more information.

NPM package: https://www.npmjs.com/package/chartist-plugin-tooltips-updated

## Why this fork?
This repository is a fork of [tmmdata/chartist-plugin-tooltip](https://github.com/tmmdata/chartist-plugin-tooltip). 
(Thanks for the great work!)

It seems as this repository is no longer maintained, 
that's why I decieded to fork it and **include serval pull requests** and
**update the dependencies**.

#### Included Pull Requests

* [#87 Document new meta options](https://github.com/tmmdata/chartist-plugin-tooltip/pull/87) from meisanerd 
* [#131 (feature) add chartist-plugin-tooltip.scss to dist folder](https://github.com/tmmdata/chartist-plugin-tooltip/pull/131) from Zadvornyi
* [#136 Fix issue checking chart type when uglified](https://github.com/tmmdata/chartist-plugin-tooltip/pull/136) from jkowens
* [#128 Fixes width/height being incorrect](https://github.com/tmmdata/chartist-plugin-tooltip/pull/128) from jdoyle65 
* [#160 Fixed memory leak](https://github.com/tmmdata/chartist-plugin-tooltip/pull/160) from callanto
* [#173 Adding support for SOLID donut graphs](https://github.com/tmmdata/chartist-plugin-tooltip/pull/173) from AlexLaforge
* [#9 Add support to IE11](https://github.com/LukBukkit/chartist-plugin-tooltip/pull/9) from Borrajo

#### More new exciting stuff
* Upgrade to Yarn
* Up-to-date dependencies
* Latest version published on npm

## Available options and their defaults

```javascript
var defaultOptions = {
  currency: undefined, //accepts '£', '$', '€', etc.
  //e.g. 4000 => €4,000

  tooltipFnc: undefined, //accepts function
  //build custom tooltip

  transformTooltipTextFnc: undefined, // accepts function
  // transform tooltip text

  class: undefined, // accecpts 'class1', 'class1 class2', etc.
  //adds class(es) to tooltip wrapper

  anchorToPoint: false, //accepts true or false
  //tooltips do not follow mouse movement -- they are anchored to the point / bar.

  appendToBody: true, //accepts true or false
  //appends tooltips to body instead of chart container,

  metaIsHTML: false //accepts true or false
  //Whether to parse the meta value as HTML or plain text
};
```

## Sample usage in Chartist.js

#### First you have to install the plugin via Yarn:

`yarn add chartist-plugin-tooltips-updated`

#### Then you can include this plugin...
1. via `<script>` tag and the file `dist/chartist-plugin-tooltip.min.js`:
```js
var chart = new Chartist.Line('.ct-chart', data, {
  plugins: [
    Chartist.plugins.tooltip()
  ]
});
```
(WARNING: If you used the version 0.0.17 from NPM (latest) of the package `chartist-plugin-tooltips`. 
The `s` of tooltips 
[got removed](https://github.com/tmmdata/chartist-plugin-tooltip/commit/c476a2dd255134241e4238f562ac3cb8b617bc79) 
in the plugin function: ~~Chartist.plugins.tooltips~~())

2. or via a CommonJS import (like in NodeJS):
```js
import Chartist from 'chartist';
import ChartistTooltip from 'chartist-plugin-tooltips-updated';

let chart = new Chartist.Line('.ct-chart', data, {
  plugins: [
    ChartistTooltip()
  ]
});
```

#### And now you can use the different options for labels:

With descriptive text:
```js
var chart = new Chartist.Line('.ct-chart', {
  labels: [1, 2, 3],
  series: [
    [
      {meta: 'description', value: 1},
      {meta: 'description', value: 5},
      {meta: 'description', value: 3}
    ],
    [
      {meta: 'other description', value: 2},
      {meta: 'other description', value: 4},
      {meta: 'other description', value: 2}
    ]
  ]
}, {
  plugins: [
    Chartist.plugins.tooltip()
  ]
});
```

Without descriptive text:
```js
var chart = new Chartist.Line('.ct-chart', {
  labels: [1, 2, 3, 4, 5, 6, 7],
  series: [
    [1, 5, 3, 4, 6, 2, 3],
    [2, 4, 2, 5, 4, 3, 6]
  ]
}, {
  plugins: [
    Chartist.plugins.tooltip()
  ]
});
```

With options text:
```js
var chart = new Chartist.Line('.ct-chart', {
  labels: [1, 2, 3],
  series: [
    [
      {meta: 'description', value: 1},
      {meta: 'description', value: 5},
      {meta: 'description', value: 3}
    ],
    [
      {meta: 'other description', value: 2},
      {meta: 'other description', value: 4},
      {meta: 'other description', value: 2}
    ]
  ]
}, {
  plugins: [
    Chartist.plugins.tooltip({
      currency: '$',
      class: 'class1 class2',
      appendToBody: true
    })
  ]
});
```

If you change the css properties of the tooltip, you shouldn't change the `display` property, 
otherwise the position of the tooltip will be wrong!

## Custom point element.

In ChartistJS you can replace default element with smth different.
There is a pretty [demo](https://gionkunz.github.io/chartist-js/examples.html#example-line-modify-drawing) 
(*USING EVENTS TO REPLACE GRAPHICS*).
And if you want the tooltip to work fine with a new element, you need to include **two more properties**:

```javascript
'ct:value': data.value.y,
'ct:meta': data.meta,
```

AND you have to add the following **css rule** to the new element by using the `style` option 
or by adding this rule to your css class: 

```css
pointer-events: all!important;
```

(If you want to read more about, why you have to add this css rule take a look at [chartist-plugin-tooltip#72](https://github.com/tmmdata/chartist-plugin-tooltip/pull/72))

So the final code could look like this. Here is a [live demo](https://jsfiddle.net/9gzqnrd8/9/)
```javascript
chart.on('draw', function(data) {
  // If the draw event was triggered from drawing a point on the line chart
  if(data.type === 'point') {
    // We are creating a new path SVG element that draws a triangle around the point coordinates

    var circle = new Chartist.Svg('circle', {
      cx: [data.x],
      cy: [data.y],
      r: [5],
      'ct:value': data.value.y,
      'ct:meta': data.meta,
      style: 'pointer-events: all !important',
      class: 'my-cool-point',
    }, 'ct-area');

    // With data.element we get the Chartist SVG wrapper and we can replace the original point drawn by Chartist with our newly created triangle
    data.element.replace(circle);
  }
});
```

```javascript
plugins: [
  Chartist.plugins.tooltip({
    appendToBody: true,
    pointClass: 'my-cool-point'
  })
]
```
