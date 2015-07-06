<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= sectionName %> Model.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= sectionName %>Model extends BaseElementModel
{
    /**
     * Use the translated <% sectionName.toLowerCase() %> name as the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return Craft::t($this->name);
    }

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array(
            'id'            => AttributeType::Number,
            'name'          => AttributeType::String,
            'handle'        => AttributeType::String,
            'fieldLayoutId' => AttributeType::Number,
        );
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array(
            'fieldLayout' => new FieldLayoutBehavior('<%= pluginHandle %>_<%= modelName %>'),
        );
    }
}
