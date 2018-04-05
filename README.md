# DEPRECATED - generator-craft-element-type [![Build Status](https://secure.travis-ci.org/boboldehampsink/generator-craft-element-type.png?branch=master)](https://travis-ci.org/boboldehampsink/generator-craft-element-type)

## Deprecated

With the release of Craft 3 on 4-4-2018, this tool has been deprecated. You can still use this with Craft 2 but you are encouraged to use (and develop) a Craft 3 version. At this moment, I have no plans to do so.

## Getting Started

This generator is written in Node.js and is ran by [Yeoman](http://yeoman.io). For this generator to run, you have to install Yeoman:

```bash
npm install -g yo
```

Once we have installed Yeoman, we can run this generator. To install generator-craft-element-type from npm, run:

```bash
npm install -g generator-craft-element-type
```

Finally, initiate the generator:

```bash
yo craft-element-type
```

## Changelog
##### 1.0.7
- Added CSRF support

##### 1.0.6
- Fixed casing of a variable

##### 1.0.5
- Fixed some variables not generating output

##### 1.0.4
- Fixed wrong twig variable names
- Fixed a wrong page title
- Fixed some comments

##### 1.0.3
- Fixed section relation typo
- Improved element index tab texts

##### 1.0.2
- Fixed record table names

##### 1.0.1
- Better handling of camelcase plugin names

##### 1.0.0
- Initial release

## License
[MIT](LICENSE)

## Credits
Inspired by Tim Kelty's [generator-craft-plugin](https://github.com/timkelty/generator-craft-plugin)
