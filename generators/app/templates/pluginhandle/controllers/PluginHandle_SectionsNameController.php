<?php

namespace Craft;

/**
 * <%= pluginName %> <%= sectionsName %> Controller.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>_<%= sectionsName %>Controller extends BaseController
{
    /**
     * <%= sectionsName %> index.
     */
    public function action<%= sectionName %>Index()
    {
        $variables['<%= sectionsName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->getAll<%= sectionsName %>();

        $this->renderTemplate('<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>', $variables);
    }

    /**
     * Edit a <%= sectionName.toLowerCase() %>.
     *
     * @param array $variables
     *
     * @throws HttpException
     * @throws Exception
     */
    public function actionEdit<%= sectionName %>(array $variables = array())
    {
        $variables['brandNew<%= sectionName %>'] = false;

        if (!empty($variables['<%= sectionName.toLowerCase() %>Id'])) {
            if (empty($variables['<%= sectionName.toLowerCase() %>'])) {
                $variables['<%= sectionName.toLowerCase() %>'] = craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->get<%= sectionName %>ById($variables['<%= sectionName.toLowerCase() %>Id']);

                if (!$variables['<%= sectionName.toLowerCase() %>']) {
                    throw new HttpException(404);
                }
            }

            $variables['title'] = $variables['<%= sectionName.toLowerCase() %>']->name;
        } else {
            if (empty($variables['<%= sectionName.toLowerCase() %>'])) {
                $variables['<%= sectionName.toLowerCase() %>'] = new <%= pluginHandle %>_<%= sectionName %>Model();
                $variables['brandNew<%= sectionName %>'] = true;
            }

            $variables['title'] = Craft::t('Create a new <%= sectionName.toLowerCase() %>');
        }

        $variables['crumbs'] = array(
            array('label' => Craft::t('<%= pluginName %>'), 'url' => UrlHelper::getUrl('<%= pluginHandle.toLowerCase() %>')),
            array('label' => Craft::t('<%= sectionsName %>'), 'url' => UrlHelper::getUrl('<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>')),
        );

        $this->renderTemplate('<%= pluginHandle.toLowerCase() %>/<%= sectionsName.toLowerCase() %>/_edit', $variables);
    }

    /**
     * Saves a <%= sectionName.toLowerCase() %>.
     */
    public function actionSave<%= sectionName %>()
    {
        $this->requirePostRequest();

        $<%= sectionName.toLowerCase() %> = new <%= pluginHandle %>_<%= sectionName %>Model();

        // Shared attributes
        $<%= sectionName.toLowerCase() %>->id         = craft()->request->getPost('<%= sectionName.toLowerCase() %>Id');
        $<%= sectionName.toLowerCase() %>->name       = craft()->request->getPost('name');
        $<%= sectionName.toLowerCase() %>->handle     = craft()->request->getPost('handle');

        // Set the field layout
        $fieldLayout = craft()->fields->assembleLayoutFromPost();
        $fieldLayout->type = '<%= pluginHandle %>_<%= modelName %>';
        $<%= sectionName.toLowerCase() %>->setFieldLayout($fieldLayout);

        // Save it
        if (craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->save<%= sectionName %>($<%= sectionName.toLowerCase() %>)) {
            craft()->userSession->setNotice(Craft::t('<%= sectionName %> saved.'));
            $this->redirectToPostedUrl($<%= sectionName.toLowerCase() %>);
        } else {
            craft()->userSession->setError(Craft::t('Couldn’t save <%= sectionName.toLowerCase() %>.'));
        }

        // Send the <%= sectionName.toLowerCase() %> back to the template
        craft()->urlManager->setRouteVariables(array(
            '<%= sectionName.toLowerCase() %>' => $<%= sectionName.toLowerCase() %>,
        ));
    }

    /**
     * Deletes a <%= sectionName.toLowerCase() %>.
     */
    public function actionDelete<%= sectionName %>()
    {
        $this->requirePostRequest();
        $this->requireAjaxRequest();

        $<%= sectionName.toLowerCase() %>Id = craft()->request->getRequiredPost('id');

        craft()-><%= pluginHandleLower %>_<%= sectionsName.toLowerCase() %>->delete<%= sectionName %>ById($<%= sectionName.toLowerCase() %>Id);
        $this->returnJson(array('success' => true));
    }
}
