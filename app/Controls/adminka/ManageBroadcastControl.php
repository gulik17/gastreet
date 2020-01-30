<?php
/**
 *
 */
class ManageBroadcastControl extends BaseAdminkaControl
{
	public function render()
	{
        $bctm = new BroadcastTemplateManager();
        $allTemplates = $bctm->getAll();

        $this->addData("allTemplates", $allTemplates);

        // статусы и типы
        $this->addData("statusDesc", BroadcastTemplate::getStatusDesc());
        $this->addData("editTypeDesc", BroadcastTemplate::getEditTypeDesc());
        $this->addData("sendTypeDesc", BroadcastTemplate::getSendTypeDesc());
        $this->addData("triggerTypeDesc", BroadcastTemplate::getTriggerTypeDesc());

	}

}
