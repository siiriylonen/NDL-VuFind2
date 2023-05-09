<?php

namespace Finna\Controller;

use Finna\Form\Form;

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
        $userLang = $this->params()->fromRoute(
            'user_lang',
            $this->params()->fromQuery('user_lang')
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
                'user_lang' => $userLang,
            ]]
        );
    }
}
