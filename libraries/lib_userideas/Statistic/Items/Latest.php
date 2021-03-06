<?php
/**
 * @package      Userideas
 * @subpackage   Statistic\Items
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Userideas\Statistic\Items;

use Userideas\Statistic\Items;
use Prism\Constants;

defined('JPATH_PLATFORM') or die;

/**
 * This class loads latest items.
 *
 * @package         Userideas\Statistic
 * @subpackage      Items
 */
class Latest extends Items
{
    protected $data = array();

    protected $position = 0;

    /**
     * Load latest items ordering by creation date.
     *
     * <code>
     * $options = array(
     *     "limit" => 5,
     *     "state" => Prism\Constants::PUBLISHED
     * );
     *
     * $latest = new Userideas\Statistics\Items\Latest(\JFactory::getDbo());
     * $latest->load($options);
     * </code>
     *
     * @param array $options
     */
    public function load(array $options = array())
    {
        $query = $this->getQuery();

        // Filter by state.
        $state  = $this->getOptionState($options);
        if ($state !== null) {
            $query->where('a.published = ' . (int)$state);
        }

        // Filter by access level.
        $groups  = $this->getOptionAccessGroups($options);
        if (is_array($groups) and count($groups) > 0) {
            $groups = implode(',', $groups);
            $query
                ->where('a.access IN (' . $groups . ')')
                ->where('c.access IN (' . $groups . ')');
        }

        $query->order('a.record_date DESC');

        $limit = $this->getOptionLimit($options);
        $this->db->setQuery($query, 0, (int)$limit);

        $this->items = (array)$this->db->loadObjectList();
    }
}
