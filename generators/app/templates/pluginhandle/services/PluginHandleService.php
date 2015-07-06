<?php

namespace Craft;

/**
 * <%= pluginName %> Service.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>Service extends BaseApplicationComponent
{
    /**
     * Returns an <%= modelName.toLowerCase() %> by its ID.
     *
     * @param int $<%= modelName.toLowerCase() %>Id
     *
     * @return <%= pluginHandle %>_<%= modelName %>Model|null
     */
    public function get<%= modelName %>ById($<%= modelName.toLowerCase() %>Id)
    {
        return craft()->elements->getElementById($<%= modelName.toLowerCase() %>Id, '<%= pluginHandle %>_<% modelName %>');
    }

    /**
     * Saves an <%= modelName.toLowerCase() %>.
     *
     * @param <%= pluginHandle %>_<%= modelName %>Model $<%= modelName.toLowerCase() %>
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function save<%= modelName %>(<%= pluginHandle %>_<%= modelName %>Model $<%= modelName.toLowerCase() %>)
    {
        $isNew<%= modelName %> = !$<%= modelName.toLowerCase() %>->id;

        // <%= modelName%> data
        if (!$isNew<%= modelName %>) {
            $<%= modelName.toLowerCase() %>Record = <%= pluginHandle %>_<%= modelName %>Record::model()->findById($<%= modelName.toLowerCase() %>->id);

            if (!$<%= modelName.toLowerCase() %>Record) {
                throw new Exception(Craft::t('No <%= modelName.toLowerCase() %> exists with the ID “{id}”', array('id' => $<%= modelName.toLowerCase() %>->id)));
            }
        } else {
            $<%= modelName.toLowerCase() %>Record = new <%= pluginHandle %>_<%= modelName %>Record();
        }

        $<%= modelName.toLowerCase() %>Record-><%= sectionName.toLowerCase() %>Id = $<%= modelName.toLowerCase() %>-><%= sectionName.toLowerCase() %>Id;
        $<%= modelName.toLowerCase() %>Record->startDate  = $<%= modelName.toLowerCase() %>->startDate;
        $<%= modelName.toLowerCase() %>Record->endDate    = $<%= modelName.toLowerCase() %>->endDate;

        $<%= modelName.toLowerCase() %>Record->validate();
        $<%= modelName.toLowerCase() %>->addErrors($<%= modelName.toLowerCase() %>Record->getErrors());

        if (!$<%= modelName.toLowerCase() %>->hasErrors()) {
            $transaction = craft()->db->getCurrentTransaction() === null ? craft()->db->beginTransaction() : null;
            try {
                // Fire an 'onBeforeSave<%= modelName %>' event
                $this->onBeforeSave<%= modelName %>(new Event($this, array(
                    '<%= modelName.toLowerCase() %>'      => $<%= modelName.toLowerCase() %>,
                    'isNew<%= modelName %>' => $isNew<%= modelName %>,
                )));

                if (craft()->elements->saveElement($<%= modelName.toLowerCase() %>)) {
                    // Now that we have an element ID, save it on the other stuff
                    if ($isNew<%= modelName %>) {
                        $<%= modelName %>Record->id = $<%= modelName.toLowerCase() %>->id;
                    }

                    $<%= modelName.toLowerCase() %>Record->save(false);

                    // Fire an 'onSave<%= modelName %>' event
                    $this->onSave<%= modelName %>(new Event($this, array(
                        '<%= modelName.toLowerCase() %>'      => $<%= modelName.toLowerCase() %>,
                        'isNew<%= modelName %>' => $isNew<%= modelName %>,
                    )));

                    if ($transaction !== null) {
                        $transaction->commit();
                    }

                    return true;
                }
            } catch (\Exception $e) {
                if ($transaction !== null) {
                    $transaction->rollback();
                }

                throw $e;
            }
        }

        return false;
    }

    // Events

    /**
     * Fires an 'onBeforeSave<%= modelName %>' event.
     *
     * @param Event $<%= modelName.toLowerCase() %>
     */
    public function onBeforeSave<%= modelName %>(Event $<%= modelName.toLowerCase() %>)
    {
        $this->raiseEvent('onBeforeSave<%= modelName %>', $<%= modelName.toLowerCase() %>);
    }

    /**
     * Fires an 'onSave<%= modelName %>' event.
     *
     * @param Event $<%= modelName.toLowerCase() %>
     */
    public function onSave<%= modelName %>(Event $<%= modelName.toLowerCase() %>)
    {
        $this->raiseEvent('onSave<%= modelName %>', $<%= modelName.toLowerCase() %>);
    }
}
