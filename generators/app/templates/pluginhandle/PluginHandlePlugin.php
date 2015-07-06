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
            '<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>' => array('action' => '<%= pluginHandleLower %>/<%= sectionsName.toLowerCase() %>/<%= sectionName.toLowerCase() %>Index'),
            '<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/new' => array('action' => '<%= pluginHandleLower %>/<%= sectionsName.toLowerCase() %>/edit<%= sectionName %>'),
            '<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Id>\d+)' => array('action' => '<%= pluginHandleLower %>/<%= sectionsName.toLowerCase() %>/edit<%= sectionName %>'),
            '<%= pluginHandle.toLowerCase() %>' => array('action' => '<%= pluginHandleLower %>/<%= modelName.toLowerCase() %>Index'),
            '<%= pluginHandle.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Handle>{handle})/new' => array('action' => '<%= pluginHandleLower %>/edit<%= modelName %>'),
            '<%= pluginHandle.toLowerCase() %>/(?P<<%= sectionName.toLowerCase() %>Handle>{handle})/(?P<<%= modelName.toLowerCase() %>Id>\d+)' => array('action' => '<%= pluginHandleLower %>/edit<%= modelName %>'),
        );
    }
}
