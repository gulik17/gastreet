<?php

/**
 * Created by PhpStorm.
 * User: tim
 * Date: 15.02.17
 * Time: 12:38
 */
class ManageCustomBroadcastControl extends BaseAdminkaControl {
    public function render() {
        $cbm = new CustomBroadcastManager();
        $customBroadcastList = $cbm->getAll();
        $stat = array();
        /** @var CustomBroadcast $customBroadcast */
        if (is_array($customBroadcastList) && count($customBroadcastList)) {
            foreach ($customBroadcastList as $customBroadcast) {
                $stat[$customBroadcast->id] = array($cbm->getQueueSize($customBroadcast), $cbm->getNewCount($customBroadcast),
                    $cbm->getSendCount($customBroadcast), $cbm->getNotSendCount($customBroadcast));
            }
        }
        $this->addData('customBroadcastList', $customBroadcastList);
        $this->addData('statusDesc', CustomBroadcast::getStatusDesc());
        $this->addData('typeDesc', CustomBroadcast::getTypeDesc());
        $this->addData('stat', $stat);
    }
}