<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= modelName %> Model.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= modelName %>Model extends BaseElementModel
{
    protected $elementType = '<%= pluginHandle %>_<%= modelName %>';

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            '<%= sectionName.toLowerCase() %>Id' => AttributeType::Number,
            'startDate'  => AttributeType::DateTime,
            'endDate'    => AttributeType::DateTime,
        ));
    }

    /**
     * Returns whether the current user can edit the element.
     *
     * @return bool
     */
    public function isEditable()
    {
        return true;
    }

    /**
     * Returns the element's CP edit URL.
     *
     * @return string|false
     */
    public function getCpEditUrl()
    {
        $<%= sectionName.toLowerCase() %> = $this->get<%= sectionName %>();

        if ($<%= sectionName.toLowerCase() %>) {
            return UrlHelper::getCpUrl('<%= pluginHandle.toLowerCase() %>/'.$<%= sectionName.toLowerCase() %>->handle.'/'.$this->id);
        }
    }

    /**
     * Returns the field layout used by this element.
     *
     * @return FieldLayoutModel|null
     */
    public function getFieldLayout()
    {
        $<%= sectionName.toLowerCase() %> = $this->get<%= sectionName %>();

        if ($<%= sectionName.toLowerCase() %>) {
            return $<%= sectionName.toLowerCase() %>->getFieldLayout();
        }
    }

    /**
     * Returns the <%= modelName.toLowerCase() %>'s <%= sectionName.toLowerCase() %>.
     *
     * @return <%= pluginHandle %>_<%= sectionName %>Model|null
     */
    public function get<%= sectionName %>()
    {
        if ($this-><%= sectionName.toLowerCase() %>Id) {
            return craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->get<%= sectionName %>ById($this-><%= sectionName.toLowerCase() %>Id);
        }
    }
}
