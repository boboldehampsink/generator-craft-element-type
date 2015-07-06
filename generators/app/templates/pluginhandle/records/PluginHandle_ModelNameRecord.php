<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= modelName %> Record.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= modelName %>Record extends BaseRecord
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return '<%= modelsName.toLowerCase() %>';
    }

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array(
            'startDate' => array(AttributeType::DateTime, 'required' => true),
            'endDate'   => array(AttributeType::DateTime, 'required' => true),
        );
    }

    /**
     * @return array
     */
    public function defineRelations()
    {
        return array(
            'element'  => array(static::BELONGS_TO, 'ElementRecord', 'id', 'required' => true, 'onDelete' => static::CASCADE),
            '<%= sectionsName.toLowerCase() %>' => array(static::BELONGS_TO, '<%= pluginHandle %>_<%= sectionName %>Record', 'required' => true, 'onDelete' => static::CASCADE),
        );
    }
}
