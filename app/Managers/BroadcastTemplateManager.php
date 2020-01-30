<?php

/**
 */
class BroadcastTemplateManager extends BaseEntityManager {
    public function getBySendAndTriggerType($sendType, $triggerType) {
        $cond = "sendType = '{$sendType}' AND triggerType = '{$triggerType}' AND status = '" . BroadcastTemplate::STATUS_ACTIVE . "'";
        return $this->getOne(new SQLCondition($cond));
    }

    public function getAll() {
        return $this->get();
    }
}