<?php

class Codecia_SalesRepresentative_Adminhtml_ReportController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('codecia_salesrepresentative/report');
    }

    public function indexAction()
    {
        $this->_title($this->__('Relatório de Representantes'));
        $this->loadLayout();
        $this->_setActiveMenu('codecia_salesrepresentative/report');
        $this->_addBreadcrumb('Relatório de Representantes', 'Relatório de Representantes');
        $this->renderLayout();
    }

    /**
     * Export customer grid to CSV format
     */
    public function exportCsvAction(){
        $fileName   = 'relatorio_representantes.csv';
        $content    = $this->getLayout()->createBlock('codecia_salesrepresentative/adminhtml_report_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Export customer grid to XML format
     */
    public function exportXmlAction()
    {
        $fileName   = 'relatorio_representantes.xml';
        $content    = $this->getLayout()->createBlock('codecia_salesrepresentative/adminhtml_report_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

}
