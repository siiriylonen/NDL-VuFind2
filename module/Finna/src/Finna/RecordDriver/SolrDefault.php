<?php

/**
 * Default model for Solr records -- used when a more specific model based on
 * the record_format field cannot be found.
 *
 * PHP version 8
 *
 * Copyright (C) The National Library of Finland 2013-2015.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  RecordDrivers
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:record_drivers Wiki
 */

namespace Finna\RecordDriver;

/**
 * Default model for Solr records -- used when a more specific model based on
 * the record_format field cannot be found.
 *
 * @category VuFind
 * @package  RecordDrivers
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:record_drivers Wiki
 */
class SolrDefault extends \VuFind\RecordDriver\SolrDefault
{
    use Feature\SolrFinnaTrait;

    /**
     * Constructor
     *
     * @param \Laminas\Config\Config $mainConfig     VuFind main configuration (omit
     * for built-in defaults)
     * @param \Laminas\Config\Config $recordConfig   Record-specific configuration
     * file (omit to use $mainConfig as $recordConfig)
     * @param \Laminas\Config\Config $searchSettings Search-specific configuration
     * file
     */
    public function __construct(
        $mainConfig = null,
        $recordConfig = null,
        $searchSettings = null
    ) {
        parent::__construct($mainConfig, $recordConfig, $searchSettings);
        $this->searchSettings = $searchSettings;
    }

    /**
     * Return the collection search ID for this record.
     *
     * @return string
     */
    public function getCollectionSearchId(): string
    {
        if ($this->mainConfig->Hierarchy->showFullHierarchyTree) {
            $id = $this->getUniqueID();
            foreach ($this->getHierarchyTopID() ?? [] as $topId) {
                if ($topId && $topId !== $id) {
                    return $topId;
                }
            }
        }
        return $this->getUniqueID();
    }
}
