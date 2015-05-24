'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');
var yosay = require('yosay');
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
        message: 'Element Type Model Name',
        default: 'Event',
      },
      {
        type: 'input',
        name: 'destination',
        message: 'Plugin Destination',
        default: 'craft/plugins',
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
      this.log('Writing plugin files');
    }
  },

  install: function () {

  }
});
