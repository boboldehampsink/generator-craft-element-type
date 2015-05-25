'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');
var yosay = require('yosay');
var path = require('path');
var renamer = require('renamer');
var _ = require('underscore.string');

module.exports = yeoman.generators.Base.extend({
  prompting: function () {
    var done = this.async();

    // Have Yeoman greet the user.
    this.log(yosay(
      'Welcome to the wonderful ' + chalk.red('Craft Element Type') + ' generator!'
    ));

    var handleDefault = function(answers) {
      return _.classify(answers.pluginName);
    };

    var prompts = [
      {
        type: 'input',
        name: 'pluginName',
        message: 'Plugin Name',
        default: 'My Plugin'
      },
      {
        type: 'input',
        name: 'pluginHandle',
        message: 'Plugin Handle (e.g. MyPlugin)',
        default: handleDefault.bind(this)
      },
      {
        type: 'input',
        name: 'pluginVersion',
        message: 'Plugin Version',
        default: '1.0.0'
      },
      {
        type: 'input',
        name: 'developerName',
        message: 'Plugin Developer Name',
        store: true,
      },
      {
        type: 'input',
        name: 'developerUrl',
        message: 'Plugin Developer URL',
        store: true,
      },
      {
        type: 'input',
        name: 'sectionName',
        message: 'Element Type Section Name (Singular)',
        default: 'Calendar',
      },
      {
        type: 'input',
        name: 'sectionsName',
        message: 'Element Type Section Name (Plural)',
        default: 'Calendars',
      },
      {
        type: 'input',
        name: 'modelName',
        message: 'Element Type Model Name (Singular)',
        default: 'Event',
      },
      {
        type: 'input',
        name: 'modelsName',
        message: 'Element Type Model Name (Plural)',
        default: 'Events',
      },
      {
        type: 'input',
        name: 'destination',
        message: 'Plugin Destination',
        default: 'craft/plugins',
      },
      {
        type: 'input',
        name: 'license',
        message: 'Plugin License',
        default: 'MIT',
      }
    ];

    this.prompt(prompts, function (props) {
      this.props = props;
      // To access props later use this.props.someOption;

      done();
    }.bind(this));
  },

  writing: {
    plugin: function() {
      var pluginDest = path.join(this.props.destination, this.props.pluginHandle.toLowerCase());

      this.fs.copyTpl(
        this.templatePath('pluginhandle/PluginHandlePlugin.php'),
        this.destinationPath(path.join(pluginDest, 'PluginHandlePlugin.php')),
        this.props
      );
    }
  },

  install: function () {
    var pluginDest = path.join(this.props.destination, this.props.pluginHandle.toLowerCase());
    var results = renamer.replace({
      regex: true,
      find: '^PluginHandle(.*)',
      replace: this.props.pluginHandle + '$1',
      files: renamer.expand(path.join(pluginDest, '**', '*')).files,
    });
    var generator = this;
    renamer.rename(results).list.forEach(function(file) {
      if (file.renamed) {
        generator.log(chalk.green('rename ') + file.before + ' => ' + file.after);
      }
    });
  }
});