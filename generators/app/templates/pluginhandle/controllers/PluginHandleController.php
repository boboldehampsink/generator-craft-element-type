<?php

namespace Craft;

/**
 * <%= pluginName %> Controller.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>Controller extends BaseController
{
    /**
     * <%= modelName %> index.
     */
    public function action<%= modelName %>Index()
    {
        $variables['<%= sectionsName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->getAll<%= sectionsName %>();

        $this->renderTemplate('<%= pluginHandle.toLowerCase() %>/_index', $variables);
    }

    /**
     * Edit an <%= modelName.toLowerCase() %>.
     *
     * @param array $variables
     *
     * @throws HttpException
     */
    public function actionEdit<%= modelName %>(array $variables = array())
    {
        if (!empty($variables['<%= sectionName.toLowerCase() %>Handle'])) {
            $variables['<%= sectionName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->get<%= sectionName %>ByHandle($variables['<%= sectionName.toLowerCase() %>Handle']);
        } elseif (!empty($variables['<%= sectionName.toLowerCase() %>Id'])) {
            $variables['<%= sectionName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->get<%= sectionName %>ById($variables['<%= sectionName.toLowerCase() %>Id']);
        }

        if (empty($variables['<%= sectionName.toLowerCase() %>'])) {
            throw new HttpException(404);
        }

        // Now let's set up the actual <%= modelName.toLowerCase() %>
        if (empty($variables['<%= modelName.toLowerCase() %>'])) {
            if (!empty($variables['<%= modelName.toLowerCase() %>Id'])) {
                $variables['<%= modelName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>->get<%= modelName %>ById($variables['<%= modelName.toLowerCase() %>Id']);

                if (!$variables['<%= modelName.toLowerCase() %>']) {
                    throw new HttpException(404);
                }
            } else {
                $variables['<%= modelName.toLowerCase() %>'] = new <%= pluginHandle %>_<%= modelName %>Model();
                $variables['<%= modelName.toLowerCase() %>']-><%= sectionName.toLowerCase() %>Id = $variables['<%= sectionName.toLowerCase() %>']->id;
            }
        }

        // Tabs
        $variables['tabs'] = array();

        foreach ($variables['<%= sectionName.toLowerCase() %>']->getFieldLayout()->getTabs() as $index => $tab) {
            // Do any of the fields on this tab have errors?
            $hasErrors = false;

            if ($variables['<%= modelName.toLowerCase() %>']->hasErrors()) {
                foreach ($tab->getFields() as $field) {
                    if ($variables['<%= modelName.toLowerCase() %>']->getErrors($field->getField()->handle)) {
                        $hasErrors = true;
                        break;
                    }
                }
            }

            $variables['tabs'][] = array(
                'label' => $tab->name,
                'url'   => '#tab'.($index + 1),
                'class' => ($hasErrors ? 'error' : null),
            );
        }

        if (!$variables['<%= modelName.toLowerCase() %>']->id) {
            $variables['title'] = Craft::t('Create a new <%= modelName.toLowerCase() %>');
        } else {
            $variables['title'] = $variables['<%= modelName.toLowerCase() %>']->title;
        }

        // Breadcrumbs
        $variables['crumbs'] = array(
            array('label' => Craft::t('<%= pluginName %>'), 'url' => UrlHelper::getUrl('<%= pluginHandle.toLowerCase() %>')),
            array('label' => $variables['<%= sectionName.toLowerCase() %>']->name, 'url' => UrlHelper::getUrl('<%= pluginHandle.toLowerCase() %>')),
        );

        // Set the "Continue Editing" URL
        $variables['continueEditingUrl'] = '<%= pluginHandle.toLowerCase() %>/'.$variables['<%= sectionName.toLowerCase() %>']->handle.'/{id}';

        // Render the template!
        $this->renderTemplate('<%= pluginHandle.toLowerCase() %>/_edit', $variables);
    }

    /**
     * Saves an <%= modelName.toLowerCase() %>.
     */
    public function actionSave<%= modelName %>()
    {
        $this->requirePostRequest();

        $<%= modelName.toLowerCase() %>Id = craft()->request->getPost('<%= modelName.toLowerCase() %>Id');

        if ($<%= modelName.toLowerCase() %>Id) {
            $<%= modelName.toLowerCase() %> = craft()-><%= pluginHandleLower %>->get<%= modelName %>ById($<%= modelName.toLowerCase() %>Id);

            if (!$<%= modelName.toLowerCase() %>) {
                throw new Exception(Craft::t('No <%= modelName.toLowerCase() %> exists with the ID “{id}”', array('id' => $<%= modelName.toLowerCase() %>Id)));
            }
        } else {
            $<%= modelName.toLowerCase() %> = new <%= pluginHandle %>_<%= modelName %>Model();
        }

        // Set the <%= modelName.toLowerCase() %> attributes, defaulting to the existing values for whatever is missing from the post data
        $<%= modelName.toLowerCase() %>-><%= sectionName.toLowerCase() %>Id = craft()->request->getPost('<%= sectionName.toLowerCase() %>Id', $<%= modelName.toLowerCase() %>-><%= sectionName.toLowerCase() %>Id);
        $<%= modelName.toLowerCase() %>->startDate  = (($startDate = craft()->request->getPost('startDate')) ? DateTime::createFromString($startDate, craft()->timezone) : null);
        $<%= modelName.toLowerCase() %>->endDate    = (($endDate   = craft()->request->getPost('endDate'))   ? DateTime::createFromString($endDate,   craft()->timezone) : null);

        $<%= modelName.toLowerCase() %>->getContent()->title = craft()->request->getPost('title', $<%= modelName.toLowerCase() %>->title);
        $<%= modelName.toLowerCase() %>->setContentFromPost('fields');

        if (craft()-><%= pluginHandleLower %>->save<%= modelName %>($<%= modelName.toLowerCase() %>)) {
            craft()->userSession->setNotice(Craft::t('<%= modelName %> saved.'));
            $this->redirectToPostedUrl($<%= modelName.toLowerCase() %>);
        } else {
            craft()->userSession->setError(Craft::t('Couldn’t save <%= modelName.toLowerCase() %>.'));

            // Send the <%= modelName.toLowerCase() %> back to the template
            craft()->urlManager->setRouteVariables(array(
                '<%= modelName.toLowerCase() %>' => $<%= modelName.toLowerCase() %>,
            ));
        }
    }

    /**
     * Deletes an <%= modelName.toLowerCase() %>.
     */
    public function actionDelete<%= modelName %>()
    {
        $this->requirePostRequest();

        $<%= modelName.toLowerCase() %>Id = craft()->request->getRequiredPost('<%= modelName.toLowerCase() %>Id');

        if (craft()->elements->deleteElementById($<%= modelName.toLowerCase() %>Id)) {
            craft()->userSession->setNotice(Craft::t('<%= modelName %> deleted.'));
            $this->redirectToPostedUrl();
        } else {
            craft()->userSession->setError(Craft::t('Couldn’t delete <%= modelName.toLowerCase() %>.'));
        }
    }
}
