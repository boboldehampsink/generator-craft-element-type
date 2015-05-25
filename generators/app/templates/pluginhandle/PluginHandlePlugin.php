<?php

namespace Craft;

/**
 * <%= pluginName %> Plugin.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>Plugin extends BasePlugin
{
    /**
     * Get plugin name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('<%= pluginName %>');
    }

    /**
     * Get plugin version.
     *
     * @return string
     */
    public function getVersion()
    {
        return '<%= pluginVersion %>';
    }

    /**
     * Get plugin developer.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return '<%= developerName %>';
    }

    /**
     * Get plugin developer url.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return '<%= developerUrl %>';
    }

    /**
     * Plugin has CP section?
     *
     * @return bool
     */
    public function hasCpSection()
    {
        return true;
    }

    /**
     * Register CP routes.
     *
     * @return array
     */
    public function registerCpRoutes()
    {
        return array(
            '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>' => array('action' => '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/<%= sectionName.toLowerCase() %>Index'),
            '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/new' => array('action' => '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/edit<%= sectionName %>'),
            '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Id>\d+)' => array('action' => '<%= modelsName.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/edit<%= sectionName %>'),
            '<%= modelsName.toLowerCase() %>' => array('action' => '<%= modelsName.toLowerCase() %>/<%= modelName.toLowerCase() %>Index'),
            '<%= modelsName.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Handle>{handle})/new' => array('action' => '<%= modelsName.toLowerCase() %>/edit<%= modelName %>'),
            '<%= modelsName.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Handle>{handle})/(?P<<%= modelName.toLowerCase() %>Id>\d+)' => array('action' => '<%= modelsName.toLowerCase() %>/edit<%= modelName %>'),
        );
    }
}
