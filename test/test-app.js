'use strict';

var path = require('path');
var assert = require('yeoman-generator').assert;
var helpers = require('yeoman-generator').test;
var os = require('os');

describe('Craft Element Type:app', function () {
  before(function (done) {
    helpers.run(path.join(__dirname, '../generators/app'))
      .withOptions({ skipInstall: false })
      .withPrompts({
        pluginName: 'Events',
        pluginHandle: 'Events',
        developerName: 'Bob Olde Hampsink',
        developerUrl: 'http://www.itmundi.nl',
       })
      .on('end', done);
  });

  it('creates plugin file', function () {
    assert.file([
      'craft/plugins/events/EventsPlugin.php'
    ]);
  });

  it('creates plugin controllers', function() {
    assert.file([
      'craft/plugins/events/controllers/EventsController.php',
      'craft/plugins/events/controllers/Events_CalendarsController.php'
    ]);
  });

  it('creates plugin elementtypes', function() {
    assert.file([
      'craft/plugins/events/elementtypes/Events_EventElementType.php'
    ]);
  });

  it('creates plugin fieldtypes', function() {
    assert.file([
      'craft/plugins/events/fieldtypes/EventsFieldType.php'
    ]);
  });

  it('creates plugin models', function() {
    assert.file([
      'craft/plugins/events/models/Events_CalendarModel.php',
      'craft/plugins/events/models/Events_EventModel.php'
    ]);
  });

  it('creates plugin records', function() {
    assert.file([
      'craft/plugins/events/records/Events_CalendarRecord.php',
      'craft/plugins/events/records/Events_EventRecord.php'
    ]);
  });

  it('creates plugin services', function() {
    assert.file([
      'craft/plugins/events/services/EventsService.php',
      'craft/plugins/events/services/Events_CalendarsService.php'
    ]);
  });

  it('creates plugin templates', function() {
    assert.file([
      'craft/plugins/events/templates/_edit.html',
      'craft/plugins/events/templates/_editor.html',
      'craft/plugins/events/templates/_index.html',
      'craft/plugins/events/templates/calendars/_edit.html',
      'craft/plugins/events/templates/calendars/index.html'
    ]);
  });

  it('creates plugin variables', function() {
    assert.file([
      'craft/plugins/events/variables/EventsVariable.php'
    ]);
  });
});
