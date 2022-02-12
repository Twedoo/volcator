# Chartist Plugin Tooltip Changelog

### master

### 0.1.3

* [ENCHANTMENT] Added supports for the IE11 - [#9](https://github.com/LukBukkit/chartist-plugin-tooltip/pull/9) 

### 0.1.2

* [ENHANCEMENT] Added support for the solid donut graph

### 0.1.1

* [BUGFIX] Fixed the wrong position of a tooltip when `appendToBody:true` is used
* [CHANGE] The default value of `appendToBody` is now `true` (was `false`), because it's more efficent
* [CHANGE] The css property `position` of tooltip now has be `absolute`

### 0.0.21
* [BUGFIX] Fixed the position of the tooltips when there are multiple charts

### 0.0.20
* [BUGFIX] Fixed issue checking chart type when uglified
* [BUGFIX] Fixed width/height being incorrect
* [BUGFIX] Fixed memory leak
* [ENHANCEMENT] Switched to Yarn
* [ENHANCEMENT] Added less file to the dist folder
* [CHANGE] The exported object is now called `Chartist.plugins.tooltip` instead of `Chartist.plugins.tooltips`. 
The `s` at the end of the tooptip is now missing.

### 0.0.11
* [BUGFIX] Tooltips now working properly on Firefox
* [ENHANCEMENT] Added custom tooltip using options.tooltipFnc

### 0.0.10
* [BUGFIX] Set currency default to `undefined`. Fixes issue in chartist.js 0.7.4.

### 0.0.9
* [BUGFIX] Fixed new pie chart label mechanism

### 0.0.8
* [BUGFIX] Removed Ember reference
* [ENHANCEMENT] For pie chart tooltips also take the labels into account if no meta is given
