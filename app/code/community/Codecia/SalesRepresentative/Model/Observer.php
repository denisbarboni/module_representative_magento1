<?php

class Codecia_SalesRepresentative_Model_Observer{

    public function checkoutSubmitAllAfter($observer)
    {
        /** @var Codecia_SalesRepresentative_Helper_Data $helperCodecia */
        $helperCodecia = Mage::helper('codecia_salesrepresentative');
        if ($helperCodecia && $helperCodecia->isActive() && Mage::app()->getStore()->isAdmin())
        {
            /** @var Mage_Sales_Model_Order $order */
            $order = $observer->getEvent()->getOrder();
            if ($order && $order->getId())
            {
                $modelUser = Mage::getSingleton('admin/session')->getUser();
                if ($modelUser && $modelUser->getId())
                {
                    $userId = $modelUser->getId();
                    $userIsGroupRepresentative = $helperCodecia->verifyUserIsSalesRepresentative($userId);
                    if ($userIsGroupRepresentative)
                    {
                        try{
                            //Vincular o Representante Id no pedido.
                            $order->setData('sales_representative_id', $modelUser->getId());
                            $order->save();

                            //Salvar o relatório
                            $modelReport = Mage::getModel('codecia_salesrepresentative/report');
                            $modelReport->setData('representative_id', $modelUser->getId());
                            $modelReport->setData('representative_name', $modelUser->getFirstname().' '.$modelUser->getLastname());
                            $modelReport->setData('representative_email', $modelUser->getEmail());
                            $modelReport->setData('order_increment_id', $order->getIncrementId());
                            $modelReport->setData('customer_id', $order->getCustomerId());
                            $modelReport->setData('customer_name', $order->getCustomerName());
                            $modelReport->setData('customer_email', $order->getCustomerEmail());
                            $modelReport->setData('created_at', Mage::getModel('core/date')->gmtDate('Y-m-d H:i:s'));
                            $modelReport->save();
                        }catch (Exception $e){

                        }
                    }
                }
            }
        }

        return $this;
    }


    public function salesOrderGridCollectionLoadBefore($observer)
    {
        /** @var Codecia_SalesRepresentative_Helper_Data $helperCodecia */
        $helperCodecia = Mage::helper('codecia_salesrepresentative');
        if ($helperCodecia && $helperCodecia->isActive() && Mage::app()->getStore()->isAdmin())
        {
            $orderGridCollection = $observer->getOrderGridCollection();
            if ($orderGridCollection && $orderGridCollection instanceof Mage_Sales_Model_Resource_Order_Grid_Collection)
            {
                $modelUser = Mage::getSingleton('admin/session')->getUser();
                if ($modelUser && $modelUser->getId())
                {
                    $userId = $modelUser->getId();
                    $userIsGroupRepresentative = $helperCodecia->verifyUserIsSalesRepresentative($userId);
                    if ($userIsGroupRepresentative)
                    {
                        $orderGridCollection
                            ->getSelect()
                            ->joinLeft(array('sfo' => 'sales_flat_order'),
                                'main_table.entity_id  = sfo.entity_id',
                                array('representative_id' => 'sales_representative_id'))
                            ->where("sfo.sales_representative_id = {$userId}");
                    }
                }
            }
        }

        return $this;
    }

    public function controllerActionAdminhtmlSalesOrderView($observer)
    {
        /** @var Codecia_SalesRepresentative_Helper_Data $helperCodecia */
        $helperCodecia = Mage::helper('codecia_salesrepresentative');
        if ($helperCodecia && $helperCodecia->isActive() && Mage::app()->getStore()->isAdmin())
        {
            $orderController = $observer->getControllerAction();
            if ($orderController && $orderController instanceof Mage_Adminhtml_Sales_OrderController)
            {
                $modelUser = Mage::getSingleton('admin/session')->getUser();
                if ($modelUser && $modelUser->getId())
                {
                    $userId = $modelUser->getId();
                    $userIsGroupRepresentative = $helperCodecia->verifyUserIsSalesRepresentative($userId);
                    if ($userIsGroupRepresentative)
                    {
                        $orderId =  $orderController->getRequest()->getParam('order_id');
                        if ($orderId)
                        {
                            $collectionOrder = Mage::getModel('sales/order')->getCollection();
                            $collectionOrder->getSelect()->where("main_table.entity_id = {$orderId}");
                            $collectionOrder->getSelect()->limit(1);
                            if ($collectionOrder->count())
                            {
                                $modelOrder = $collectionOrder->getFirstItem();
                                if ($modelOrder && $modelOrder->getId())
                                {
                                    $sales_representative_id = $modelOrder->getData('sales_representative_id');
                                    if($sales_representative_id !== $userId)
                                    {
                                        //Bloquear url
                                        $urlRedirect = Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/index");
                                        Mage::getSingleton('core/session')->addError('Você não tem acesso a esse pedido!');
                                        Mage::app()->getFrontController()->getResponse()->setRedirect($urlRedirect);
                                        Mage::app()->getResponse()->sendResponse();
                                        exit;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this;
    }
}