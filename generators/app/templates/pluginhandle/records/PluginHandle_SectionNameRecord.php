<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= sectionName %> Record.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= sectionName %>Record extends BaseRecord
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return '<%= modelsName.toLowerCase() %>_<%= sectionsName.toLowerCase() %>';
    }

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array(
            'name'          => array(AttributeType::Name, 'required' => true),
            'handle'        => array(AttributeType::Handle, 'required' => true),
            'fieldLayoutId' => AttributeType::Number,
        );
    }

    /**
     * @return array
     */
    public function defineRelations()
    {
        return array(
            'fieldLayout' => array(static::BELONGS_TO, 'FieldLayoutRecord', 'onDelete' => static::SET_NULL),
            '<%= modelsName.toLowerCase() %>'      => array(static::HAS_MANY, '<%= pluginHandle %>_<%= modelName %>Record', '<%= modelName.toLowerCase() %>Id'),
        );
    }

    /**
     * @return array
     */
    public function defineIndexes()
    {
        return array(
            array('columns' => array('name'), 'unique' => true),
            array('columns' => array('handle'), 'unique' => true),
        );
    }

    /**
     * @return array
     */
    public function scopes()
    {
        return array(
            'ordered' => array('order' => 'name'),
        );
    }
}
