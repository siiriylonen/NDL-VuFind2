<?php

/**
 * Archive Request Controller
 *
 * PHP version 7
 *
 * Copyright (C) The National Library of Finland 2015-2023.
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
 * PHP version 7
 *
 * @category VuFind
 * @package  Controller
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @author   Ere Maijala <ere.maijala@helsinki.fi>
 * @author   Siiri Ylönen <siiri.ylonen@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org   Main Site
 */

namespace Finna\Controller;

use Finna\Form\Form;

/**
 * Archive Request Controller
 *
 * @category VuFind
 * @package  Controller
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @author   Ere Maijala <ere.maijala@helsinki.fi>
 * @author   Siiri Ylönen <siiri.ylonen@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org   Main Site
 */
class ArchiveRequestController extends FeedbackController implements \Laminas\Log\LoggerAwareInterface
{
    use \VuFind\Log\LoggerAwareTrait;

    /**
     * Type of record to display
     *
     * @var string
     */
    protected $sourceId = 'Solr';

    /**
     * Create archive request form and send to correct recipient.
     *
     * @return \Laminas\View\Model\ViewModel
     * @throws \Exception
     */
    public function archiveRequestAction()
    {
        $requestForm = $this->getRecordForm(Form::ARCHIVE_MATERIAL_REQUEST);

        return $requestForm;
    }

    /**
     * Helper for building a route to a record form.
     *
     * @param string $id Form id
     *
     * @return \Laminas\View\Model\ViewModel
     */
    protected function getRecordForm($id)
    {
        $recordIdPart = $this->params()->fromRoute(
            'id',
            $this->params()->fromQuery('id')
        );

        if ($this->formWasSubmitted()) {
            $recordId = $recordIdPart;
        } else {
            $recordId = $this->sourceId . '|' . $recordIdPart;
        }

        return $this->redirect()->toRoute(
            'feedback-form',
            ['id' => $id],
            ['query' => [
                'layout' => $this->getRequest()->getQuery('layout', false),
                'record_id'
                    => $recordId,
            ]]
        );
    }
}
