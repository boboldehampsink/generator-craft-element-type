<?php

namespace Craft;

/**
 * <%= pluginName %> - <%= sectionName %> Service.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= sectionsName %>Service extends BaseApplicationComponent
{
    private $_all<%= sectionName %>Ids;
    private $_<%= sectionsName.toLowerCase() %>ById;
    private $_fetchedAll<%= sectionsName %> = false;

    /**
     * Returns all of the <%= sectionName.toLowerCase() %> IDs.
     *
     * @return array
     */
    public function getAll<%= sectionName %>Ids()
    {
        if (!isset($this->_all<%= sectionName %>Ids)) {
            if ($this->_fetchedAll<%= sectionsName %>) {
                $this->_all<%= sectionName %>Ids = array_keys($this->_<%= sectionsName.toLowerCase() %>ById);
            } else {
                $this->_all<%= sectionName %>Ids = craft()->db->createCommand()
                    ->select('id')
                    ->from('<% modelsName.toLowerCase() %>_<%= sectionsName.toLowerCase() %>')
                    ->queryColumn();
            }
        }

        return $this->_all<%= sectionName %>Ids;
    }

    /**
     * Returns all <%= sectionsName.toLowerCase() %>.
     *
     * @param string|null $indexBy
     *
     * @return array
     */
    public function getAll<%= sectionsName %>($indexBy = null)
    {
        if (!$this->_fetchedAll<%= sectionsName %>) {
            $<%= sectionName.toLowerCase() %>Records = <%= pluginHandle %>_<%= sectionName %>Record::model()->ordered()->findAll();
            $this->_<%= sectionsName.toLowerCase() %>ById = <%= pluginHandle %>_<%= sectionName %>Model::populateModels($<%= sectionName.toLowerCase() %>Records, 'id');
            $this->_fetchedAll<%= sectionsName %> = true;
        }

        if ($indexBy == 'id') {
            return $this->_<%= sectionsName.toLowerCase() %>ById;
        } elseif (!$indexBy) {
            return array_values($this->_<%= sectionsName.toLowerCase() %>ById);
        } else {
            $<%= sectionsName.toLowerCase() %> = array();

            foreach ($this->_<%= sectionsName.toLowerCase() %>ById as $<%= sectionName.toLowerCase() %>) {
                $<%= sectionsName.toLowerCase() %>[$<%= sectionName.toLowerCase() %>->$indexBy] = $<%= sectionName.toLowerCase() %>;
            }

            return $<%= sectionsName.toLowerCase() %>;
        }
    }

    /**
     * Gets the total number of <%= sectionsName.toLowerCase() %>.
     *
     * @return int
     */
    public function getTotal<%= sectionsName %>()
    {
        return count($this->getAll<%= sectionsName %>Ids());
    }

    /**
     * Returns a <%= sectionName.toLowerCase() %> by its ID.
     *
     * @param $<%= sectionName.toLowerCase() %>Id
     *
     * @return <%= pluginHandle %>_<%= sectionName %>Model|null
     */
    public function get<%= sectionName %>ById($<%= sectionName.toLowerCase() %>Id)
    {
        if (!isset($this->_<%= sectionsName.toLowerCase() %>ById) || !array_key_exists($<%= sectionName.toLowerCase() %>Id, $this->_<%= sectionsName.toLowerCase() %>ById)) {
            $<%= sectionName.toLowerCase() %>Record = <%= pluginHandle %>_<%= sectionName %>Record::model()->findById($<%= sectionName.toLowerCase() %>Id);

            if ($<%= sectionName.toLowerCase() %>Record) {
                $this->_<%= sectionsName.toLowerCase() %>ById[$<%= sectionName.toLowerCase() %>Id] = <%= pluginHandle %>_<%= sectionName %>Model::populateModel($<%= sectionName.toLowerCase() %>Record);
            } else {
                $this->_<%= sectionsName.toLowerCase() %>ById[$<%= sectionName.toLowerCase() %>Id] = null;
            }
        }

        return $this->_<%= sectionsName.toLowerCase() %>ById[$<%= sectionName.toLowerCase() %>Id];
    }

    /**
     * Gets a <%= sectionName.toLowerCase() %> by its handle.
     *
     * @param string $<%= sectionName.toLowerCase() %>Handle
     *
     * @return <%= pluginHandle %>_<%= sectionName %>Model|null
     */
    public function get<%= sectionName %>ByHandle($<%= sectionName.toLowerCase() %>Handle)
    {
        $<%= sectionName.toLowerCase() %>Record = <%= pluginHandle %>_<%= sectionName %>Record::model()->findByAttributes(array(
            'handle' => $<%= sectionName.toLowerCase() %>Handle,
        ));

        if ($<%= sectionName.toLowerCase() %>Record) {
            return <%= pluginHandle %>_<%= sectionName %>Model::populateModel($<%= sectionName.toLowerCase() %>Record);
        }
    }

    /**
     * Saves a <%= sectionName.toLowerCase() %>.
     *
     * @param <%= pluginHandle %>_<%= sectionName %>Model $<%= sectionName.toLowerCase() %>
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function save<%= sectionName %>(<%= pluginHandle %>_<%= sectionName %>Model $<%= sectionName.toLowerCase() %>)
    {
        if ($<%= sectionName.toLowerCase() %>->id) {
            $<%= sectionName.toLowerCase() %>Record = <%= pluginHandle %>_<%= sectionName %>Record::model()->findById($<%= sectionName.toLowerCase() %>->id);

            if (!$<%= sectionName.toLowerCase() %>Record) {
                throw new Exception(Craft::t('No <%= sectionName.toLowerCase() %> exists with the ID “{id}”', array('id' => $<%= sectionName.toLowerCase() %>->id)));
            }

            $old<%= sectionName %> = <%= pluginHandle %>_<%= sectionName %>Model::populateModel($<%= sectionName.toLowerCase() %>Record);
            $isNew<%= sectionName %> = false;
        } else {
            $<%= sectionName.toLowerCase() %>Record = new <%= pluginHandle %>_<%= sectionName %>Record();
            $isNew<%= sectionName %> = true;
        }

        $<%= sectionName.toLowerCase() %>Record->name       = $<%= sectionName.toLowerCase() %>->name;
        $<%= sectionName.toLowerCase() %>Record->handle     = $<%= sectionName.toLowerCase() %>->handle;

        $<%= sectionName.toLowerCase() %>Record->validate();
        $<%= sectionName.toLowerCase() %>->addErrors($<%= sectionName.toLowerCase() %>Record->getErrors());

        if (!$<%= sectionName.toLowerCase() %>->hasErrors()) {
            $transaction = craft()->db->getCurrentTransaction() === null ? craft()->db->beginTransaction() : null;
            try {
                if (!$isNew<%= sectionName %> && $old<%= sectionName %>->fieldLayoutId) {
                    // Drop the old field layout
                    craft()->fields->deleteLayoutById($old<%= sectionName %>->fieldLayoutId);
                }

                // Save the new one
                $fieldLayout = $<%= sectionName.toLowerCase() %>->getFieldLayout();
                craft()->fields->saveLayout($fieldLayout);

                // Update the <%= sectionName.toLowerCase() %> record/model with the new layout ID
                $<%= sectionName.toLowerCase() %>->fieldLayoutId = $fieldLayout->id;
                $<%= sectionName.toLowerCase() %>Record->fieldLayoutId = $fieldLayout->id;

                // Save it!
                $<%= sectionName.toLowerCase() %>Record->save(false);

                // Now that we have a <%= sectionName.toLowerCase() %> ID, save it on the model
                if (!$<%= sectionName.toLowerCase() %>->id) {
                    $<%= sectionName.toLowerCase() %>->id = $<%= sectionName.toLowerCase() %>Record->id;
                }

                // Might as well update our cache of the <%= sectionName.toLowerCase() %> while we have it.
                $this->_<%= sectionsName.toLowerCase() %>ById[$<%= sectionName.toLowerCase() %>->id] = $<%= sectionName.toLowerCase() %>;

                if ($transaction !== null) {
                    $transaction->commit();
                }
            } catch (\Exception $e) {
                if ($transaction !== null) {
                    $transaction->rollback();
                }

                throw $e;
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes a <%= sectionName.toLowerCase() %> by its ID.
     *
     * @param int $<%= sectionName.toLowerCase() %>Id
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function delete<%= sectionName %>ById($<%= sectionName.toLowerCase() %>Id)
    {
        if (!$<%= sectionName.toLowerCase() %>Id) {
            return false;
        }

        $transaction = craft()->db->getCurrentTransaction() === null ? craft()->db->beginTransaction() : null;
        try {
            // Delete the field layout
            $fieldLayoutId = craft()->db->createCommand()
                ->select('fieldLayoutId')
                ->from('<% modelsName.toLowerCase() %>_<%= sectionsName.toLowerCase() %>')
                ->where(array('id' => $<%= sectionName.toLowerCase() %>Id))
                ->queryScalar();

            if ($fieldLayoutId) {
                craft()->fields->deleteLayoutById($fieldLayoutId);
            }

            // Grab the <%= modelName.toLowerCase() %> ids so we can clean the elements table.
            $<%= modelName.toLowerCase() %>Ids = craft()->db->createCommand()
                ->select('id')
                ->from('<%= modelsName.toLowerCase() %>')
                ->where(array('<%= sectionName.toLowerCase() %>Id' => $<%= sectionName.toLowerCase() %>Id))
                ->queryColumn();

            craft()->elements->deleteElementById($<%= modelName.toLowerCase() %>Ids);

            $affectedRows = craft()->db->createCommand()->delete('<%= modelsName.toLowerCase() %>_<%= sectionsName.toLowerCase() %>', array('id' => $<%= sectionName.toLowerCase() %>Id));

            if ($transaction !== null) {
                $transaction->commit();
            }

            return (bool) $affectedRows;
        } catch (\Exception $e) {
            if ($transaction !== null) {
                $transaction->rollback();
            }

            throw $e;
        }
    }
}
