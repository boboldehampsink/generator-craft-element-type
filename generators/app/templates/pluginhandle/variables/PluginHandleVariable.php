<?php
namespace Craft;

/**
 * <%= pluginName %> Plugin.
 *
 * @author    <%= developerName %>
 * @copyright Copyright (c) <%= (new Date()).getFullYear() %>, <%= developerName %>
 * @license   <%= license %>
 *
 * @link      <%= developerUrl %>
 * @since     <%= pluginVersion %>
 */
class <%= pluginHandle %>Variable
{
    /**
     * <%= modelsName %>
     *
     * @return ElementCriteriaModel
     */
    public function <%= modelsName.toLowerCase() %>()
    {
        return craft()->elements->getCriteria('<%= pluginHandle %>_<%= modelName %>');
    }
}
