<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= modelName %> Element Type.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>FieldType extends BaseElementFieldType
{
    /**
     * @var string The element type this field deals with.
     */
    protected $elementType = '<%= pluginHandle %>_<%= modelName %>';

    /**
     * Returns the label for the "Add" button.
     *
     * @return string
     */
    protected function getAddButtonLabel()
    {
        return Craft::t('Add an <%= modelName.toLowerCase() %>');
    }
}
