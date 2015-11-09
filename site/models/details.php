<?php
/**
 * @package      UserIdeas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class UserIdeasModelDetails extends JModelItem
{
    protected $item = null;

    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param   string $type   The table type to instantiate
     * @param   string $prefix A prefix for the table class name. Optional.
     * @param   array  $config Configuration array for model. Optional.
     *
     * @return  JTable  A database object
     * @since   1.6
     */
    public function getTable($type = 'Item', $prefix = 'UserIdeasTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to auto-populate the model state.
     * Note. Calling getState in this method will result in recursion.
     * @since    1.6
     */
    protected function populateState()
    {
        parent::populateState();

        $app = JFactory::getApplication();
        /** @var $app JApplicationSite */

        // Get the pk of the record from the request.
        $value = $app->input->getInt('id');
        $this->setState($this->getName() . '.id', $value);

        // Load the parameters.
        $value = $app->getParams($this->option);
        $this->setState('params', $value);
    }

    /**
     * Method to get an object.
     *
     * @param    integer $id The id of the object to get.
     *
     * @return    mixed    Object on success, false on failure.
     */
    public function getItem($id = null)
    {
        if (!$id) {
            $id = $this->getState($this->getName() . '.id');
        }

        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select(
            'a.id, a.title, a.description, a.votes, a.record_date, a.catid, a.user_id, a.status_id, a.hits, a.params, ' .
            $query->concatenate(array('a.id', 'a.alias'), '-') . ' AS slug, ' .
            'b.name, b.username, ' . 'c.title AS category, ' .
            $query->concatenate(array('c.id', 'c.alias'), '-') . ' AS catslug, ' .
            'd.name AS status_name, d.params AS status_params, d.default AS status_default'
        );

        $query->from($db->quoteName('#__uideas_items', 'a'));
        $query->leftJoin($db->quoteName('#__users', 'b') . ' ON a.user_id = b.id');
        $query->leftJoin($db->quoteName('#__categories', 'c') . ' ON a.catid = c.id');
        $query->leftJoin($db->quoteName('#__uideas_statuses', 'd') . ' ON a.status_id = d.id');
        $query->where('a.id = ' . (int)$id);

        $db->setQuery($query);

        $this->item = $db->loadObject();

        // Prepare status object
        if ($this->item !== null and (int)$this->item->id > 0) {
            $this->prepareStatus($this->item);

            $tags = new JHelperTags;
            $this->item->tags = $tags->getItemTags('com_userideas.item', $this->item->id);

            $registry = new Joomla\Registry\Registry;
            $registry->loadString($this->item->params);
            $this->item->params = $registry;
        }

        return $this->item;
    }

    protected function prepareStatus(&$item)
    {
        if (JString::strlen($item->status_params) > 0) {
            $statusParams = json_decode($item->status_params, true);

            if (is_array($statusParams)) {
                $item->status_params = $statusParams;
            } else {
                $item->status_params = null;
            }
        }

        $statusData = array(
            'id'      => $item->status_id,
            'name'    => $item->status_name,
            'default' => $item->status_default,
            'params'  => $item->status_params
        );

        $item->status = new Userideas\Status\Status();
        $item->status->bind($statusData);
    }

    /**
     * Increase number of hits.
     *
     * @param integer $id
     */
    public function hit($id)
    {
        $db    = $this->getDbo();
        $query = $db->getQuery(true);

        $query
            ->update($db->quoteName('#__uideas_items'))
            ->set($db->quoteName('hits') . ' = hits + 1')
            ->where($db->quoteName('id') . '=' . (int)$id);

        $db->setQuery($query);
        $db->execute();
    }
}
