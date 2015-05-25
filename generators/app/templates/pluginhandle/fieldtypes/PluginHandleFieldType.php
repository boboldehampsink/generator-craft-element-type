<?php

namespace Craft;

/**
 * Entries field type.
 */
class EventsFieldType extends BaseElementFieldType
{
    /**
     * @var string The element type this field deals with.
     */
    protected $elementType = 'Events_Event';

    /**
     * Returns the label for the "Add" button.
     *
     * @return string
     */
    protected function getAddButtonLabel()
    {
        return Craft::t('Add an event');
    }
}
