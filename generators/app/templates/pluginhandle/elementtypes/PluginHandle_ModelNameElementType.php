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
class <%= pluginHandle %>_<%= modelName %>ElementType extends BaseElementType
{
    /**
     * Returns the element type name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('<% pluginName %>');
    }

    /**
     * Returns whether this element type has content.
     *
     * @return bool
     */
    public function hasContent()
    {
        return true;
    }

    /**
     * Returns whether this element type has titles.
     *
     * @return bool
     */
    public function hasTitles()
    {
        return true;
    }

    /**
     * Returns this element type's sources.
     *
     * @param string|null $context
     *
     * @return array|false
     */
    public function getSources($context = null)
    {
        $sources = array(
            '*' => array(
                'label'    => Craft::t('All <%= modelsName.toLowerCase() %>'),
            ),
        );

        foreach (craft()-><%= pluginHandle.toLowerCase() %>_<%= sectionsName.toLowerCase() %>->getAll<%= sectionsName %>() as $<%= sectionName.toLowerCase() %>) {
            $key = '<%= sectionName.toLowerCase() %>:'.$<%= sectionName.toLowerCase() %>->id;

            $sources[$key] = array(
                'label'    => $<%= sectionName.toLowerCase() %>->name,
                'criteria' => array('<%= sectionName.toLowerCase() %>Id' => $<%= sectionName.toLowerCase() %>->id),
            );
        }

        return $sources;
    }

    /**
     * Returns the attributes that can be shown/sorted by in table views.
     *
     * @param string|null $source
     *
     * @return array
     */
    public function defineTableAttributes($source = null)
    {
        return array(
            'title'     => Craft::t('Title'),
            'startDate' => Craft::t('Start Date'),
            'endDate'   => Craft::t('End Date'),
        );
    }

    /**
     * Returns the table view HTML for a given attribute.
     *
     * @param BaseElementModel $element
     * @param string           $attribute
     *
     * @return string
     */
    public function getTableAttributeHtml(BaseElementModel $element, $attribute)
    {
        switch ($attribute) {
            case 'startDate':
            case 'endDate':
            {
                $date = $element->$attribute;

                if ($date) {
                    return $date->localeDate();
                } else {
                    return '';
                }
            }

            default:
            {
                return parent::getTableAttributeHtml($element, $attribute);
            }
        }
    }

    /**
     * Defines any custom element criteria attributes for this element type.
     *
     * @return array
     */
    public function defineCriteriaAttributes()
    {
        return array(
            '<%= sectionName.toLowerCase() %>'   => AttributeType::Mixed,
            '<%= sectionName.toLowerCase() %>Id' => AttributeType::Mixed,
            'startDate'  => AttributeType::Mixed,
            'endDate'    => AttributeType::Mixed,
            'order'      => array(AttributeType::String, 'default' => '<%= pluginHandle.toLowerCase() %>.startDate asc'),
        );
    }

    /**
     * Modifies an element query targeting elements of this type.
     *
     * @param DbCommand            $query
     * @param ElementCriteriaModel $criteria
     *
     * @return mixed
     */
    public function modifyElementsQuery(DbCommand $query, ElementCriteriaModel $criteria)
    {
        $query
            ->addSelect('<%= pluginHandle.toLowerCase() %>.<%= sectionName.toLowerCase() %>Id, <%= pluginHandle.toLowerCase() %>.startDate, <%= pluginHandle.toLowerCase() %>.endDate')
            ->join('<%= pluginHandle.toLowerCase() %> <%= pluginHandle.toLowerCase() %>', '<%= pluginHandle.toLowerCase() %>.id = elements.id');

        if ($criteria-><%= sectionName.toLowerCase() %>Id) {
            $query->andWhere(DbHelper::parseParam('<%= pluginHandle.toLowerCase() %>.<%= sectionName.toLowerCase() %>Id', $criteria-><%= sectionName.toLowerCase() %>Id, $query->params));
        }

        if ($criteria-><%= sectionName.toLowerCase() %>) {
            $query->join('<%= pluginHandle.toLowerCase() %>_<%= sectionsName.toLowerCase() %> <%= pluginHandle.toLowerCase() %>_<%= sectionsName.toLowerCase() %>', '<%= pluginHandle.toLowerCase() %>_<%= sectionsName.toLowerCase() %>.id = <%= pluginHandle.toLowerCase() %>.<%= sectionName.toLowerCase() %>Id');
            $query->andWhere(DbHelper::parseParam('<%= pluginHandle.toLowerCase() %>_<%= sectionsName.toLowerCase() %>.handle', $criteria-><%= sectionName.toLowerCase() %>, $query->params));
        }

        if ($criteria->startDate) {
            $query->andWhere(DbHelper::parseDateParam('<%= pluginHandle.toLowerCase() %>.startDate', $criteria->startDate, $query->params));
        }

        if ($criteria->endDate) {
            $query->andWhere(DbHelper::parseDateParam('<%= pluginHandle.toLowerCase() %>.endDate', $criteria->endDate, $query->params));
        }
    }

    /**
     * Populates an element model based on a query result.
     *
     * @param array $row
     *
     * @return array
     */
    public function populateElementModel($row)
    {
        return Events_EventModel::populateModel($row);
    }

    /**
     * Returns the HTML for an editor HUD for the given element.
     *
     * @param BaseElementModel $element
     *
     * @return string
     */
    public function getEditorHtml(BaseElementModel $element)
    {
        // Start/End Dates
        $html = craft()->templates->render('events/_edit', array(
            'element' => $element,
        ));

        // Everything else
        $html .= parent::getEditorHtml($element);

        return $html;
    }
}
