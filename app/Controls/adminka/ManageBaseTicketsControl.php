<?php
/**
 *
 */
class ManageBaseTicketsControl extends BaseAdminkaControl
{
	public function render()
	{
        $btm = new BaseTicketManager();
        $ticketsList = $btm->getAll();
        $this->addData("ticketsList", $ticketsList);
        $this->addData("statusDesc", BaseTicket::getStatusDesc());
	}

}
